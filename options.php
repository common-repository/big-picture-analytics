<?php
add_action( 'admin_menu', 'tbp_add_admin_menu' );
add_action( 'admin_init', 'tbp_settings_init' );


function tbp_add_admin_menu(  ) {

	add_submenu_page( 'options-general.php', 'BigPicture.io', 'BigPicture.io', 'manage_options', 'the_big_picture', 'tbp_options_page' );

}


function tbp_settings_init(  ) {

	register_setting( 'pluginPage', 'tbp_settings' );

	add_settings_section(
		'tbp_pluginPage_section',
		__( 'Enter your BigPicture.io Project ID', 'wordpress' ),
		'tbp_settings_section_callback',
		'pluginPage'
	);

	add_settings_field(
		'tbp_project_id',
		__( 'Your Big Picture Project ID', 'wordpress' ),
		'tbp_project_id_render',
		'pluginPage',
		'tbp_pluginPage_section'
	);


}


function tbp_load_admin_style() {
  wp_register_style( 'tbp_admin_css', plugin_dir_url( __FILE__ ) . '/assets/tbp-style.css', false, '1.0.0' );
  wp_enqueue_style( 'tbp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'tbp_load_admin_style' );

function tbp_project_id_render(  ) {

	$options = get_option( 'tbp_settings' );
	?>
	<input type='text' name='tbp_settings[tbp_project_id]' value='<?php echo $options['tbp_project_id']; ?>'>
	<?php

}


function tbp_settings_section_callback(  ) {

	echo __( 'You can find your Project ID in the settings page of https://bigpicture.io', 'wordpress' );

}


function tbp_options_page(  ) {

	?>
	<form action='options.php' method='post'>

		<h2>Analytics by BigPicture.io</h2>
		<p>
			Enter your BigPicture.io Project ID for this project. You can locate your Project ID from the "Script Tag" settings menu in your BigPicture.io dashboard.
		</p>
		<p>
			Once you have saved your Project ID, you can manage all of your integrations and tracking from the <a href="https://thebigpicture.io/">BigPicture.io dashboard.</a>
		</p>


		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>
		<h2>Where to find your BigPicture.io Project ID</h2>

		<div class="tbp-flex-container">
			<div class="tbp-flex-item">
				<img src="<?php echo plugin_dir_url( __FILE__ ) . '/assets/tbp-guide-1.png' ?>">
			</div>
			<div class="tbp-flex-item">
				<h2>Click the gear icon</h2>
				<p>Choose the gear icon from the project page.</p>
			</div>
		</div>

		<div class="tbp-flex-container">
			<div class="tbp-flex-item">
				<img src="<?php echo plugin_dir_url( __FILE__ ) . '/assets/tbp-guide-2.png' ?>">
			</div>
			<div class="tbp-flex-item">
				<h2>Choose "General"</h2>
				<p>Choose "General" from the settings menu.</p>
			</div>
		</div>

		<div class="tbp-flex-container">
			<div class="tbp-flex-item">
				<img src="<?php echo plugin_dir_url( __FILE__ ) . '/assets/tbp-guide-3.png' ?>">
			</div>
			<div class="tbp-flex-item">
				<h2>Copy your Project ID</h2>
				<p>Copy your Project ID, and paste it in this plugin.</p>
			</div>
		</div>

	</form>
	<?php

}

?>
