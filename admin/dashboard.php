<?php
/**
 * Register settings, sections, and fields.
 *
 * @since 0.0.1
 */
function gtm_ga_amp_page_html() {
  // Check user capabilities
  if ( ! current_user_can( 'manage_options' ) ) {
    return;
  }

  // Add error/update messages
  // Check if the user have submitted the settings
   if ( isset( $_GET['settings-updated'] ) ) {
     add_settings_error( 'gtm_ga_amp_messages', 'gtm_ga_amp_message', __( 'Settings Saved', 'gtm_ga_amp' ), 'updated' );
   }
 
  settings_errors( 'gtm_ga_amp_messages' );
?>

  <div class="wrap">
    <h1>Google Tag Manager &amp; Google Analytics for AMP</h2>
    <p>This plugin will support adding Google Tag Manager and/or Google Analytics
    	 to your AMP pages in WordPress, configure the settings for both tools here.</p>
    <hr>
  	<form action="options.php" method="post">
		<?php
			// output security fields for the registered setting "gtm_ga_amp"
			settings_fields( 'gtm_ga_amp' );
			do_settings_sections( 'gtm_ga_amp_ga_basic' );
		?>
		<hr>
		<?php
			do_settings_sections( 'gtm_ga_amp_gtm' );
      // output save settings button
      submit_button('Save Changes');
    ?>
    </form>
  </div>
  <?php
}