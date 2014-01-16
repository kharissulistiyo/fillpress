<?php

add_action( 'admin_enqueue_scripts', 'fillpress_enqueue_color_picker' );
function fillpress_enqueue_color_picker() {
    // first check that $hook_suffix is appropriate for your admin page
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script(
        'iris',
        admin_url( 'js/iris.min.js' ),
        array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ),
        false,
        1
    );
    wp_enqueue_script(
        'wp-color-picker',
        admin_url( 'js/color-picker.min.js' ),
        array( 'iris' ),
        false,
        1
    );
    wp_enqueue_script( 'fillpress-color-picker', plugins_url('inc/js/fillpress-color-picker.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
	
}