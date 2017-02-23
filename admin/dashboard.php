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

  if($_POST) {
    if (!isset($_POST['gtm_ga_amp_dashboard_nonce']) || !wp_verify_nonce($_POST['gtm_ga_amp_dashboard_nonce'], plugin_basename(__FILE__))) {
      return;
    }

	  // Google Analytics
	  if ($_POST['gtm_ga_amp_ga_enabled']) {
	    update_option('gtm_ga_amp_ga_enabled', $_POST['gtm_ga_amp_ga_enabled']);
	  } else {
	  	update_option('gtm_ga_amp_ga_enabled', "off");
	  }

	  if (isset($_POST['gtm_ga_amp_ga_tracking_id'])) {
	    update_option('gtm_ga_amp_ga_tracking_id', sanitize_text_field($_POST['gtm_ga_amp_ga_tracking_id']));
	  }
  }

  $gtm_ga_amp_ga_enabled = get_option('gtm_ga_amp_ga_enabled');
  $gtm_ga_amp_ga_tracking_id = get_option('gtm_ga_amp_ga_tracking_id');
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
	     // output setting sections and their fields
	     // (sections are registered for "gtm_ga_amp", each field is registered to a specific section)
	     do_settings_sections( 'gtm_ga_amp' );
     ?>
    <hr>
    <h2>Google Analytics: Settings</h2>
    <table class="form-table">
    	<tr>
		    <th scope="row">
		        <label for="gtm_ga_amp_ga_enabled">Enable Google Analytics</label>
		    </th>
		    <td>
		        <input type="checkbox" name="gtm_ga_amp_ga_enabled" id="gtm_ga_amp_ga_enabled" <?php if($gtm_ga_amp_ga_enabled == "on") { echo " checked"; } ?>>
		    </td>
			</tr>
			<tr>
		    <th scope="row">
		        <label for="gtm_ga_amp_ga_tracking_id">Tracking ID</label>
		    </th>
		    <td>
		        <input type="text" name="gtm_ga_amp_ga_tracking_id" id="gtm_ga_amp_ga_tracking_id" placeholder="UA-XXXXXX-X" value="<?php echo $gtm_ga_amp_ga_tracking_id; ?>">
		        <p class="description">Your Google Analytics Tracking ID, starting with: UA-XXXXXX-X.</p>
		    </td>
			</tr>
		</table>
		<p>If you'd like to add/change the advanced settings for improved tracking in Google Analytics, <a href="admin.php?page=google-analytics">go here</a>.</p>
    <?php
      // output save settings button
      submit_button('Save Changes');
    ?>
    </form>
  </div>
  <?php
}