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

add_action( 'admin_menu', 'fillpress_admin_menu' );
function fillpress_admin_menu() {
    add_menu_page( 'FillPress', 'FillPress', 'manage_options', 'fillpress', 'fillpress_options_page' );
}


/* Create Sections and Fields */

add_action( 'admin_init', 'fillpress_admin_init' );
function fillpress_admin_init() {

	/* Register setting */
    register_setting( 'fillpress-group-1', 'fp-setting1' );
	register_setting( 'fillpress-group-1', 'fp-setting2' );
	register_setting( 'fillpress-group-1', 'fp-setting3' ); // Checkbox
	register_setting( 'fillpress-group-1', 'fp-setting4' ); // Dropdown
	register_setting( 'fillpress-group-1', 'fp-setting5' ); // Post Types Checkbox
	register_setting( 'fillpress-group-1', 'fp-setting6' ); // Textarea
	register_setting( 'fillpress-group-1', 'fp-setting7' ); // Radio
	register_setting( 'fillpress-group-1', 'fp-setting8' ); // Group Checkbox
	register_setting( 'fillpress-group-1', 'fp-setting9' ); // Group Checkbox post types
	
	/* Create setting section */ 
    add_settings_section( 'fillpress-section-one', 'Group 1', 'section_one_callback', 'fillpress-section-1' );
	
	/* Create fields */
    add_settings_field( 'field-one', 'Text Field 1', 'field_one_callback', 'fillpress-section-1', 'fillpress-section-one' );
    add_settings_field( 'field-two', 'Text Field 2', 'field_two_callback', 'fillpress-section-1', 'fillpress-section-one' );
    add_settings_field( 'field-three', 'Single Checkbox', 'field_three_callback', 'fillpress-section-1', 'fillpress-section-one' );
    add_settings_field( 'field-four', 'Custom Dropdown', 'field_four_callback', 'fillpress-section-1', 'fillpress-section-one' );
    add_settings_field( 'field-five', 'Post Types Dropdown', 'field_five_callback', 'fillpress-section-1', 'fillpress-section-one' );
    add_settings_field( 'field-six', 'Textarea', 'field_six_callback', 'fillpress-section-1', 'fillpress-section-one' );
    add_settings_field( 'field-seven', 'Radio', 'field_seven_callback', 'fillpress-section-1', 'fillpress-section-one' );
    add_settings_field( 'field-eight', 'Custom Multi Checkbox', 'field_eight_callback', 'fillpress-section-1', 'fillpress-section-one' );
    add_settings_field( 'field-nine', 'Post Types Checkbox', 'field_nine_callback', 'fillpress-section-1', 'fillpress-section-one' );
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
	
	
	function field_five_callback(){ 
		$setting = esc_attr( get_option( 'fp-setting5' ) ); ?>
	
	
	
		<select name="fp-setting5">
		<?php
		$args = array(
		   'public'   => true,
		   '_builtin' => true
		);

		$output = 'names'; // names or objects, note names is the default
		$operator = 'and'; // 'and' or 'or'

		$post_types = get_post_types( $args, $output, $operator ); 

		foreach ( $post_types  as $post_type ) { ?>

		   <option value="<?php echo $post_type; ?>"<?php selected( $setting, $post_type ); ?>><?php echo $post_type; ?></option>	
		
		<?php	
		}
		?>
		</select>
		<p class='description'>Public post types.</p>
	
	<?php }
	
	
	function field_six_callback(){
		$setting = esc_attr( get_option( 'fp-setting6' ) ); ?>
	
		<textarea name="fp-setting6" rows="8" cols="60" id="fp-setting6" class="code"><?php echo esc_textarea( get_option( 'fp-setting6' ) ); ?></textarea>
	
	<?php }
	
	
	
	function field_seven_callback(){
		$radio_items = array(
			'one' => 'One',
			'two' => 'Two',
			'three' => 'Three',
			'four' => 'Four',
		);
	
		foreach($radio_items as $key => $value):
		
			$selected = (get_option('fp-setting7') == $key) ? 'checked="checked"' : '';
			echo "\n\t<label><input type='radio' name='fp-setting7' value='" . esc_attr($key) . "' $selected/> $value</label><br />";
			
		endforeach;
		
	}
	
	
	
	
	function field_eight_callback(){
		$setting = esc_attr( get_option( 'fp-setting8' ) );	
		$checkbox_group_items = array(
			'one' => 'One',
			'two' => 'Two',
			'three' => 'Three',
			'four' => 'Four',
		);
	
		foreach($checkbox_group_items as $key => $value) : 
		
			$checked = in_array($key, (array) get_option( 'fp-setting8' )) ? 'checked="checked"' : '';		
		
		?>
			<p>	
				<label for="fp-setting8-<?php echo $key; ?>">
					<input id="fp-setting8-<?php echo $key; ?>" type="checkbox" <?php echo $checked; ?> name="fp-setting8[]" value="<?php echo esc_attr($key); ?>" /> <?php echo esc_attr($value); ?>  
				</label>
			</p>
			
		<?php endforeach;
	
	}
	
	
	
	
	function field_nine_callback(){
	
		$setting = esc_attr( get_option( 'fp-setting9' ) );
	
		$args = array(
		   'public'   => true,
		   '_builtin' => true
		);

		$output = 'names'; // names or objects, note names is the default
		$operator = 'and'; // 'and' or 'or'

		$post_types = get_post_types( $args, $output, $operator );
	
		foreach ($post_types as $post_type) :
		
			// $checked = in_array($post_type, get_option( 'fp-setting9' )) ? 'checked="checked"' : ''; 
			
			if(in_array($post_type, (array) get_option( 'fp-setting9' ))) {
				$checked = 'checked="checked"';
			} else {
				$checked = '';
			}
			
			?>
		
			<p>	
				<label for="fp-setting9-<?php echo $post_type; ?>">
					<input id="fp-setting9-<?php echo $post_type; ?>" type="checkbox" <?php echo $checked; ?> name="fp-setting9[]" value="<?php echo esc_attr($post_type); ?>" /> <?php echo esc_attr($post_type); ?>  
				</label>
			</p>		
	
		<?php endforeach;
	
	}
	
	
	
	
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