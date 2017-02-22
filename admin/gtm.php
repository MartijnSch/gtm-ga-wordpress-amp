<?php
/**
 * Register settings, sections, and fields.
 *
 * @since 0.0.1
 */
function gtm_ga_amp_page_gtm_html() {
  // Check the users capabilities
  if ( !current_user_can( 'manage_options' ) ) {
    return;
  }

  if($_POST) {
    if (!isset($_POST['gtm_ga_amp_gtm_nonce']) || !wp_verify_nonce($_POST['gtm_ga_amp_gtm_nonce'], plugin_basename(__FILE__))) {
      return;
    }

    // Save the current options - needs work to use the Settings API
    if ($_POST['gtm_ga_amp_gtm_enabled']) {
      update_option('gtm_ga_amp_gtm_enabled', trim($_POST['gtm_ga_amp_gtm_enabled']));
    } else {
    	update_option('gtm_ga_amp_gtm_enabled', "off");
    }

    if (isset($_POST['gtm_ga_amp_gtm_container_id'])) {
      update_option('gtm_ga_amp_gtm_container_id', trim($_POST['gtm_ga_amp_gtm_container_id']));
    }

    if ($_POST['gtm_ga_amp_gtm_amp_variables']) {
      update_option('gtm_ga_amp_gtm_amp_variables', trim($_POST['gtm_ga_amp_gtm_amp_variables']));
    } else {
    	update_option('gtm_ga_amp_gtm_amp_variables', "off");
    }
  }

  $gtm_ga_amp_gtm_enabled = get_option('gtm_ga_amp_gtm_enabled');
  $gtm_ga_amp_gtm_container_id = get_option('gtm_ga_amp_gtm_container_id');
	$gtm_ga_amp_gtm_amp_variables = get_option('gtm_ga_amp_gtm_amp_variables');
?>

  <div class="wrap">
    <h1>Google Tag Manager Settings</h2>
    <p>This plugin will support adding Google Tag Manager and/or Google Analytics
    	 to your AMP pages in WordPres, configure the settings for both tools here.</p>
    <hr>
    	<form method="post">
      <?php wp_nonce_field(plugin_basename(__FILE__), 'gtm_ga_amp_gtm_nonce'); ?>
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
			        <p class="description">The plugin will be adding AMP variables to the page, you'll be able to use them with Google Tag Manager.<br />
			        <a href="#">Learn more about that here</a>.</p>
			    </td>
				</tr>
      </table>
      <?php
        // output save settings button
        submit_button('Save Changes');
      ?>
      </form>
  </div>
  <?php
}