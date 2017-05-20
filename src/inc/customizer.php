<?php
add_action('customize_register', 'jeffrise_theme_customizer');
function jeffrise_theme_customizer($wp_customize) {
    $wp_customize->add_section('social', [
        'title' => __('Social Links')
    ]);

    foreach (['Twitter', 'Facebook', 'Instagram', 'YouTube'] as $link) {
        $setting = strtolower($link) . '_link';

        $wp_customize->add_setting($setting);
        $wp_customize->add_control($setting, [
            'label' => $link . ' Link',
            'type' => 'text',
            'section' => 'social',
            'settings' => $setting
        ]);
    }
}