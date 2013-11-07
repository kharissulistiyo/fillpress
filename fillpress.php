<?php

/*
Plugin Name: FillPress
Plugin URI: https://github.com/kharissulistiyo/fillpress
Description: FillPress is a simple settings page for theme or plugin.
Author: Kharis Sulistiyono
Version: 0.1
Author URI: http://kharisulistiyo.github.io
*/


/* Create Settings Menu */

add_action( 'admin_menu', 'my_admin_menu' );
function my_admin_menu() {
    add_options_page( 'FillPress', 'FillPress', 'manage_options', 'fillpress', 'fillpress_options_page' );
}


/* Create Sections and Fields */

add_action( 'admin_init', 'fillpress_admin_init' );
function fillpress_admin_init() {

	/* Register setting */
    register_setting( 'fillpress-group-1', 'fp-setting1' );
	register_setting( 'fillpress-group-1', 'fp-setting2' );
	register_setting( 'fillpress-group-1', 'fp-setting3' ); // Checkbox
	register_setting( 'fillpress-group-1', 'fp-setting4' ); // Dropdown
	
	/* Create setting section */ 
    add_settings_section( 'fillpress-section-one', 'Group 1', 'section_one_callback', 'fillpress-section-1' );
	
	/* Create fields */
    add_settings_field( 'field-one', 'Field One', 'field_one_callback', 'fillpress-section-1', 'fillpress-section-one' );
    add_settings_field( 'field-two', 'Field Two', 'field_two_callback', 'fillpress-section-1', 'fillpress-section-one' );
    add_settings_field( 'field-three', 'Field Three', 'field_three_callback', 'fillpress-section-1', 'fillpress-section-one' );
    add_settings_field( 'field-four', 'Field Four', 'field_four_callback', 'fillpress-section-1', 'fillpress-section-one' );
}


/* 
* Callback 
* Contains front end fileds and descriptions
*/
	function section_one_callback() {
		echo 'Help text of group 1.';
	}


	function field_one_callback() {
		$setting = esc_attr( get_option( 'fp-setting1' ) );
		echo "<input size='40' type='text' name='fp-setting1' value='$setting' />";
		echo "<p class='description'>Description goes here.</p>";
	}

	function field_two_callback() {
		$setting = esc_attr( get_option( 'fp-setting2' ) );
		echo "<input size='40' type='text' name='fp-setting2' value='$setting' />";
		echo "<p class='description'>Description goes here.</p>";		
	}
	
	function field_three_callback() {
		$setting = esc_attr( get_option( 'fp-setting3' ) ); ?>
		<input type="checkbox" name="fp-setting3" value="1" <?php checked('1', get_option('my-setting3')); ?> /> Description goes here.
	<?php }
	
	
	function field_four_callback() {
	
		$option_items = array(
			'one' => 'One',
			'two' => 'Two',
			'three' => 'Three',
		);
		
		$setting = esc_attr( get_option( 'fp-setting4' ) ); ?>
		
		<select name="fp-setting4">
		
			<?php foreach($option_items as $key => $value): ?>
				<option value="<?php echo $key; ?>"<?php selected( $setting, $key ); ?>><?php echo $value; ?></option>	
			<?php endforeach; ?>
		
		</select>
		
	<?php } 
	
/* Settings callback */
function fillpress_options_page() {
    ?>
    <div class="wrap">
        <h2>FillPress Settings</h2>
        <form action="options.php" method="POST">
            <?php settings_fields( 'fillpress-group-1' ); ?>
            <?php do_settings_sections( 'fillpress-section-1' ); ?>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}	



?>