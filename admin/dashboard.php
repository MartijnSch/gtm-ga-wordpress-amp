<?php
/**
 * Register settings, sections, and fields.
 *
 * @since 0.0.1
 */
function gtm_ga_amp_page_html() {
  // Check the users capabilities
  if ( !current_user_can( 'manage_options' ) ) {
    return;
  }

  if($_POST) {
    if (!isset($_POST['gtm_ga_amp_dashboard_nonce']) || !wp_verify_nonce($_POST['gtm_ga_amp_dashboard_nonce'], plugin_basename(__FILE__))) {
      return;
    }

  	// Google Tag Manager
    // Save the current options - needs work to use the Settings API
    if ($_POST['gtm_ga_amp_gtm_enabled']) {
      update_option('gtm_ga_amp_gtm_enabled', $_POST['gtm_ga_amp_gtm_enabled']);
    } else {
    	update_option('gtm_ga_amp_gtm_enabled', "off");
    }

    if (isset($_POST['gtm_ga_amp_gtm_container_id'])) {
      update_option('gtm_ga_amp_gtm_container_id', sanitize_text_field($_POST['gtm_ga_amp_gtm_container_id']));
    }

    if ($_POST['gtm_ga_amp_gtm_amp_variables']) {
      update_option('gtm_ga_amp_gtm_amp_variables', $_POST['gtm_ga_amp_gtm_amp_variables']);
    } else {
    	update_option('gtm_ga_amp_gtm_amp_variables', "off");
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

  $gtm_ga_amp_gtm_enabled = get_option('gtm_ga_amp_gtm_enabled');
  $gtm_ga_amp_gtm_container_id = get_option('gtm_ga_amp_gtm_container_id');
	$gtm_ga_amp_gtm_amp_variables = get_option('gtm_ga_amp_gtm_amp_variables');

  $gtm_ga_amp_ga_enabled = get_option('gtm_ga_amp_ga_enabled');
  $gtm_ga_amp_ga_tracking_id = get_option('gtm_ga_amp_ga_tracking_id');
?>

  <div class="wrap">
    <h1>Google Tag Manager &amp; Google Analytics for AMP</h2>
    <p>This plugin will support adding Google Tag Manager and/or Google Analytics
    	 to your AMP pages in WordPress, configure the settings for both tools here.</p>
    <hr>
  	<form method="post">
		<?php wp_nonce_field(plugin_basename(__FILE__), 'gtm_ga_amp_dashboard_nonce'); ?>
    <h2>Google Tag Manager: Settings</h2>
    <table class="form-table">
    	<tr>
		    <th scope="row">
		        <label for="gtm_ga_amp_gtm_enabled">Enable Google Tag Manager</label>
		    </th>
		    <td>
		        <input type="checkbox" name="gtm_ga_amp_gtm_enabled" id="gtm_ga_amp_gtm_enabled" <?php if($gtm_ga_amp_gtm_enabled == "on") { echo " checked"; } ?>>
		    </td>
			</tr>
			<tr>
		    <th scope="row">
		        <label for="gtm_ga_amp_gtm_container_id">Container ID</label>
		    </th>
		    <td>
		        <input type="text" name="gtm_ga_amp_gtm_container_id" id="gtm_ga_amp_gtm_container_id" placeholder="GTM-XXXXXX" value="<?php echo $gtm_ga_amp_gtm_container_id; ?>">
		        <p class="description">Your Container ID, starting with: GTM-XXXXXX.</p>
		    </td>
			</tr>
			<tr>
		    <th scope="row">
		        <label for="gtm_ga_amp_gtm_amp_variables">Enable AMP Variables</label>
		    </th>
		    <td>
		        <input type="checkbox" name="gtm_ga_amp_gtm_amp_variables" id="gtm_ga_amp_gtm_amp_variables" <?php if($gtm_ga_amp_gtm_amp_variables == "on") { echo " checked"; } ?>>
		        <p class="description">The plugin will be adding AMP variables to the page, you'll be able to use them with Google Tag Manager.
		        <br /><a href="#">Learn more about that here</a>.</p>
		    </td>
			</tr>
    </table>
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