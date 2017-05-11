<?php
add_action('init', 'create_student_app_post_type');

function create_student_app_post_type() {
    register_post_type('student_app', [
        'labels' => [
            'name' => __('Student Apps'),
            'singular_name' => __('Student App'),
            'add_new_item' => __('Add New Student App'),
            'edit_item' => __('Edit Student App'),
            'not_found' => __('No Student Apps Found'),
        ],
        'description' => 'Student Apps',
        'public' => fakse,
        'has_archive' => false,
        'show_in_menu' => 'portal',
        'supports' => ['title']
    ]);
}