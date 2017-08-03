<?php
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
// require_once __DIR__ . '/inc/post-types/homework.php';

// Portal Related functionality
require_once __DIR__ . '/inc/login.php';
require_once __DIR__ . '/inc/portal.php';

function get_current_user_role() {
    $current_user = wp_get_current_user();
    $user_data = get_userdata($current_user->ID);
    return current($user_data->roles);
}

function get_current_page_url() {
    global $wp;
    $current_url = home_url(add_query_arg(array(),$wp->request));
    return str_replace(get_site_url(), '', $current_url);
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

function saveHomework($data) {
    global $wpdb;

    $current_user = wp_get_current_user();
    $userId = $current_user->ID;

    return $wpdb->insert($wpdb->prefix . 'homework', array(
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
    ));
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