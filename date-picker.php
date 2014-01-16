<?php


add_action( 'admin_enqueue_scripts', 'fillpress_enqueue_date_picker' );
function fillpress_enqueue_date_picker() {

	wp_enqueue_style('jquery-ui-custom', plugins_url( 'inc/jquery-ui/jquery-ui-1.10.3.custom.min.css' , __FILE__ ), false, '1.10.3');

	wp_enqueue_script('jquery-ui-datepicker');
	
	wp_enqueue_script( 'fillpress-date-picker', plugins_url('inc/js/fillpress-date-picker.js', __FILE__ ), array( 'jquery-ui-datepicker' ), false, true );
	
}