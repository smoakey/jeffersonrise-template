<?php
add_action('after_setup_theme', 'woocommerce_support');
function woocommerce_support() {
    add_theme_support('woocommerce');
}

remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);