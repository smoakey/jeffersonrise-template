<?php
// $_SERVER['SERVER_NAME'] = 'test';

require_once __DIR__ . '/inc/assets.php';
require_once __DIR__ . '/inc/admin.php';
require_once __DIR__ . '/inc/customizer.php';
require_once __DIR__ . '/inc/menus.php';
require_once __DIR__ . '/inc/roles.php';
require_once __DIR__ . '/inc/woocommerce.php';

// Custom Post Types
require_once __DIR__ . '/inc/post-types/news.php';
require_once __DIR__ . '/inc/post-types/student-app.php';
require_once __DIR__ . '/inc/post-types/team.php';
require_once __DIR__ . '/inc/post-types/announcements.php';
require_once __DIR__ . '/inc/post-types/teachers.php';

// Portal Related functionality
require_once __DIR__ . '/inc/login.php';
require_once __DIR__ . '/inc/portal.php';

function get_current_user_role($allowOverride = false) {
    $current_user = wp_get_current_user();
    $user_data = get_userdata($current_user->ID);

    if ($allowOverride && isset($_GET['student']) && $_GET['student'] == 1) {
        return 'student';
    }

    return current($user_data->roles);
}

function get_current_page_url() {
    global $wp;
    return home_url(add_query_arg(array(),$wp->request));
}

function get_portal_menu() {
    $scheme = $_SERVER['REQUEST_SCHEME'] ?: 'http';
    $address = $_SERVER['SERVER_NAME'] == 'localhost' ? $_SERVER['SERVER_ADDR'] : $_SERVER['SERVER_NAME'];
    $host = $scheme . '://' . $address;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $host . '/wp-json/wp-api-menus/v2/menus/17/');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    curl_close($ch);

    return $data ? json_decode($data, true) : [];
}

function getMondays() {
    $start = date('Y-m-d', strtotime('-6 months'));
    $end = date('Y-m-d', strtotime('+1 years'));

    $mondays = array();
    for ($i = strtotime($start); $i <= strtotime($end); $i = strtotime('+1 day', $i)) {
        if (date('N', $i) == 1) {
            $mondays[] = date('m/d/Y', $i);
        }
    }

    return $mondays;
}

function getCurrentMonday() {
    $mondays = getMondays();
    $today = strtotime(date('Y-m-d'));

    $currentMonday = null;
    foreach ($mondays as $i => $monday) {
        $nextMonday = $mondays[$i + 1];
        if ($today >= strtotime($monday) && $today <= strtotime($nextMonday)) {
            $currentMonday = $monday;
        }
    }

    return $currentMonday;
}

function getUserGoogleGroups() {
    global $wpdb;

    $role = get_current_user_role();

    if ($role == 'administrator') {
        $query = 'SELECT DISTINCT group_name FROM ' . $wpdb->prefix . 'user_googlegroups';
    } else {
        $current_user = wp_get_current_user();
        $userId = $current_user->ID;
        $query = 'SELECT group_name FROM ' . $wpdb->prefix . 'user_googlegroups WHERE userid = ' . $userId;
    }

    return $wpdb->get_col($query);
}

function getGradeLevelsFromGoogleGroups() {
    $groups = getUserGoogleGroups();

    $gradeLevels = array();
    foreach ($groups as $group) {
        $pieces = explode('@', $group);
        if (is_numeric($pieces[0])) {
            $gradeLevels[] = $pieces[0];
        }
    }

    return $gradeLevels;
}

function getSubjectsFromGoogleGroups() {
    $groups = getUserGoogleGroups();

    $subjects = array();
    foreach ($groups as $group) {
        $pieces = explode('@', $group);
        if (!is_numeric($pieces[0]) && $pieces[0] != 'teachers') {
            $subjects[] = ucwords($pieces[0]);
        }
    }

    return $subjects;
}

// save homework
// jank but had to put here in order to redirect
if (isset($_POST['submit_homework'])) {
    saveHomework($_POST, $_FILES);
    $returnWeek = isset($_POST['week']) ? '&week=' . $_POST['week'] : '';
    header('Location: /portal/homework?saved=1' . $returnWeek);
    exit;
}

function saveHomework($data, $files) {
    global $wpdb;
    require_once 'wp-admin/includes/file.php';

    $wpUploadData = [];
    foreach ($files as $field => $upload) {
        $uploads = reArrayFiles($files[$field]);
        $urls = [];
        foreach ($uploads as $upload) {
            if ($upload['error'] != 0) {
                $wpUploadData[$field] = isset($data[$field]) ? $data[$field] : '';
                continue 2;
            }

            // upload file
            $upload_overrides = array('test_form' => false);
            $uploaded = wp_handle_upload($upload, $upload_overrides);
            $urls[] = $uploaded['url'];
        }
        $wpUploadData[$field] = join($urls, ',');
    }

    $current_user = wp_get_current_user();
    $userId = $current_user->ID;

    $wpData = array_merge([
        'userid' => $userId,
        'week' => $data['week'],
        'grade' => $data['grade'],
        'subject' => $data['subject'],
        'monday' => $data['monday'],
        'tuesday' => $data['tuesday'],
        'wednesday' => $data['wednesday'],
        'thursday' => $data['thursday'],
        'friday' => $data['friday'],
        'assessments' => $data['assessments']
    ], $wpUploadData);

    if (isset($data['id']) && $data['id']) {
        return $wpdb->update($wpdb->prefix . 'homework', $wpData, ['id' => $data['id']]);
    }

    return $wpdb->insert($wpdb->prefix . 'homework', $wpData);
}

function reArrayFiles(&$file_post) {
    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}

if (isset($_POST['delete_homework'])) {
    $id = $_POST['id'];
    deleteHomework($id);

    $returnWeek = isset($_POST['week']) && $_POST['week'] ? '&week=' . $_GET['week'] : '';
    header('Location: /portal/homework?deleted=1' . $returnWeek);
    exit;
}

function deleteHomework($id) {
    global $wpdb;

    return $wpdb->delete($wpdb->prefix . 'homework', ['id' => $id]);
}

function getHomeworkForGradeLevelAndCurrentMonday($gradeLevel, $currentMonday) {
    global $wpdb;

    $results = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'homework WHERE grade=' . $gradeLevel . ' AND week="' . $currentMonday . '"');

    $data = array();
    foreach ($results as $result) {
        $data[] = json_decode(json_encode($result), true);
    }

    return $data;
}