<?php
/**
 * Register settings, sections, and fields.
 *
 * @since 0.0.1
 */
function gtm_ga_amp_page_ga_html() {
  // Check the users capabilities
  if ( !current_user_can( 'manage_options' ) ) {
    return;
  }

  // POST the details
  if($_POST) {

    if (!isset($_POST['gtm_ga_amp_ga_nonce']) || !wp_verify_nonce($_POST['gtm_ga_amp_ga_nonce'], plugin_basename(__FILE__))) {
      return;
    }

	  // Save the current options - needs work to use the Settings API
	  if ($_POST['gtm_ga_amp_ga_enabled']) {
	    update_option('gtm_ga_amp_ga_enabled', $_POST['gtm_ga_amp_ga_enabled']);
	  } else {
	  	update_option('gtm_ga_amp_ga_enabled', "off");
	  }

	  if ($_POST['gtm_ga_amp_ga_outbound_tracking']) {
	    update_option('gtm_ga_amp_ga_outbound_tracking', $_POST['gtm_ga_amp_ga_outbound_tracking']);
	  } else {
	  	update_option('gtm_ga_amp_ga_outbound_tracking', "off");
	  }

	  if (isset($_POST['gtm_ga_amp_ga_tracking_id'])) {
	    update_option('gtm_ga_amp_ga_tracking_id', $_POST['gtm_ga_amp_ga_tracking_id']);
	  }

	  if (isset($_POST['gtm_ga_amp_ga_cd_1'])) {
	    update_option('gtm_ga_amp_ga_cd_1', $_POST['gtm_ga_amp_ga_cd_1']);
	  }
	  if (isset($_POST['gtm_ga_amp_ga_cd_2'])) {
	    update_option('gtm_ga_amp_ga_cd_2', $_POST['gtm_ga_amp_ga_cd_2']);
	  }
	  if (isset($_POST['gtm_ga_amp_ga_cd_3'])) {
	    update_option('gtm_ga_amp_ga_cd_3', $_POST['gtm_ga_amp_ga_cd_3']);
	  }
	  if (isset($_POST['gtm_ga_amp_ga_cd_4'])) {
	    update_option('gtm_ga_amp_ga_cd_4', $_POST['gtm_ga_amp_ga_cd_4']);
	  }
	  if (isset($_POST['gtm_ga_amp_ga_cd_5'])) {
	    update_option('gtm_ga_amp_ga_cd_5', $_POST['gtm_ga_amp_ga_cd_5']);
	  }
	  if (isset($_POST['gtm_ga_amp_ga_cd_6'])) {
	    update_option('gtm_ga_amp_ga_cd_6', $_POST['gtm_ga_amp_ga_cd_6']);
	  }
	  if (isset($_POST['gtm_ga_amp_ga_cd_7'])) {
	    update_option('gtm_ga_amp_ga_cd_7', $_POST['gtm_ga_amp_ga_cd_7']);
	  }
	  if (isset($_POST['gtm_ga_amp_ga_cd_8'])) {
	    update_option('gtm_ga_amp_ga_cd_8', $_POST['gtm_ga_amp_ga_cd_8']);
	  }
	  if (isset($_POST['gtm_ga_amp_ga_cd_9'])) {
	    update_option('gtm_ga_amp_ga_cd_9', $_POST['gtm_ga_amp_ga_cd_9']);
	  }
	  if (isset($_POST['gtm_ga_amp_ga_cd_10'])) {
	    update_option('gtm_ga_amp_ga_cd_10', $_POST['gtm_ga_amp_ga_cd_10']);
	  }
  }

  $gtm_ga_amp_ga_enabled = get_option('gtm_ga_amp_ga_enabled');
  $gtm_ga_amp_ga_tracking_id = get_option('gtm_ga_amp_ga_tracking_id');

  $gtm_ga_amp_ga_outbound_tracking = get_option('gtm_ga_amp_ga_outbound_tracking');

  $gtm_ga_amp_ga_cd_1 = get_option('gtm_ga_amp_ga_cd_1');
  $gtm_ga_amp_ga_cd_2 = get_option('gtm_ga_amp_ga_cd_2');
  $gtm_ga_amp_ga_cd_3 = get_option('gtm_ga_amp_ga_cd_3');
  $gtm_ga_amp_ga_cd_4 = get_option('gtm_ga_amp_ga_cd_4');
  $gtm_ga_amp_ga_cd_5 = get_option('gtm_ga_amp_ga_cd_5');
  $gtm_ga_amp_ga_cd_6 = get_option('gtm_ga_amp_ga_cd_6');
  $gtm_ga_amp_ga_cd_7 = get_option('gtm_ga_amp_ga_cd_7');
  $gtm_ga_amp_ga_cd_8 = get_option('gtm_ga_amp_ga_cd_8');
  $gtm_ga_amp_ga_cd_9 = get_option('gtm_ga_amp_ga_cd_9');
  $gtm_ga_amp_ga_cd_10 = get_option('gtm_ga_amp_ga_cd_10');
?>

  <div class="wrap">
      <h1>Google Analytics for AMP</h2>
      <p>This plugin will support adding Google Analytics to your AMP pages in
      	WordPress, configure the settings here and add more information to your
      	tracking code if needed.</p>
      <hr>
    	<form method="post">
      <?php
        // output security fields for the registered setting "wporg_options"
        settings_fields('gtm_ga_amp_options');
        // output setting sections and their fields
        // (sections are registered for "wporg", each field is registered to a specific section)
        do_settings_sections('gtm_ga_amp');
        wp_nonce_field(plugin_basename(__FILE__), 'gtm_ga_amp_ga_nonce');
      ?>
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
			<hr>
			<h3>Advanced</h3>
			<p>More settings to start measuring: clicks on outbound links.</p>
			<table class="form-table">
				<tr>
			    <th scope="row">
			        <label for="gtm_ga_amp_ga_outbound_tracking">Enable Outbound Click Tracking</label>
			    </th>
			    <td>
			        <input type="checkbox" name="gtm_ga_amp_ga_outbound_tracking" id="gtm_ga_amp_ga_outbound_tracking" <?php if($gtm_ga_amp_ga_outbound_tracking == "on") { echo " checked"; } ?>>
			        <p class="description">You'll find information around sharing tracking in your Event Tracking reports as: Outbound Links, Click, <a href="https://developers.google.com/analytics/devguides/collection/amp-analytics/#outbound_link_tracking">${outboundLink}</a></p>
			    </td>
				</tr>
      </table>
      <hr>
      <h3>Custom dimensions</h3>
      <p>What custom dimensions do you want to send along to Google Analytics, configure them here:</p>
      <table class="form-table" style="width:350px;">
      	<tr>
      		<th scope="row">
      			<strong>Data Type</strong>
      		</th>
      		<th scope="row">
      			<strong>Custom Dimension ID</strong>
      		</th>
      	</tr>
				<tr>
			    <th scope="row">
			        <label for="gtm_ga_amp_ga_cd_1">Post ID</label>
			    </th>
			    <td>
			        <input type="text" size="3" name="gtm_ga_amp_ga_cd_1" id="gtm_ga_amp_ga_cd_1" placeholder="1" value="<?php echo $gtm_ga_amp_ga_cd_1; ?>">
			    </td>
				</tr>
				<tr>
			    <th scope="row">
			        <label for="gtm_ga_amp_ga_cd_2">Post Published Date</label>
			    </th>
			    <td>
			        <input type="text" size="3" name="gtm_ga_amp_ga_cd_2" id="gtm_ga_amp_ga_cd_2" placeholder="2" value="<?php echo $gtm_ga_amp_ga_cd_2; ?>">
			    </td>
				</tr>
				<tr>
			    <th scope="row">
			        <label for="gtm_ga_amp_ga_cd_3">Post Author</label>
			    </th>
			    <td>
			        <input type="text" size="3" name="gtm_ga_amp_ga_cd_3" id="gtm_ga_amp_ga_cd_3" placeholder="3" value="<?php echo $gtm_ga_amp_ga_cd_3; ?>">
			    </td>
				</tr>
				<tr>
			    <th scope="row">
			        <label for="gtm_ga_amp_ga_cd_4">Post Tags</label>
			    </th>
			    <td>
			        <input type="text" size="3" name="gtm_ga_amp_ga_cd_4" id="gtm_ga_amp_ga_cd_4" placeholder="4" value="<?php echo $gtm_ga_amp_ga_cd_4; ?>">
			    </td>
				</tr>
				<tr>
			    <th scope="row">
			        <label for="gtm_ga_amp_ga_cd_5">Post Categories</label>
			    </th>
			    <td>
			        <input type="text" size="3" name="gtm_ga_amp_ga_cd_5" id="gtm_ga_amp_ga_cd_5" placeholder="5" value="<?php echo $gtm_ga_amp_ga_cd_5; ?>">
			    </td>
				</tr>
				<tr>
			    <th scope="row">
			        <label for="gtm_ga_amp_ga_cd_6">Post Type</label>
			    </th>
			    <td>
			        <input type="text" size="3" name="gtm_ga_amp_ga_cd_6" id="gtm_ga_amp_ga_cd_6" placeholder="6" value="<?php echo $gtm_ga_amp_ga_cd_6; ?>">
			    </td>
				</tr>
				<tr>
			    <th scope="row">
			        <label for="gtm_ga_amp_ga_cd_7">Post Comments</label>
			    </th>
			    <td>
			        <input type="text" size="3" name="gtm_ga_amp_ga_cd_7" id="gtm_ga_amp_ga_cd_7" placeholder="7" value="<?php echo $gtm_ga_amp_ga_cd_7; ?>">
			    </td>
				</tr>
				<tr>
			    <th scope="row">
			        <label for="gtm_ga_amp_ga_cd_8">Logged in</label>
			    </th>
			    <td>
			        <input type="text" size="3" name="gtm_ga_amp_ga_cd_8" id="gtm_ga_amp_ga_cd_8" placeholder="8" value="<?php echo $gtm_ga_amp_ga_cd_8; ?>">
			    </td>
				</tr>
				<tr>
			    <th scope="row">
			        <label for="gtm_ga_amp_ga_cd_9">Content Length: Words</label>
			    </th>
			    <td>
			        <input type="text" size="3" name="gtm_ga_amp_ga_cd_9" id="gtm_ga_amp_ga_cd_9" placeholder="9" value="<?php echo $gtm_ga_amp_ga_cd_9; ?>">
			    </td>
				</tr>
				<tr>
			    <th scope="row">
			        <label for="gtm_ga_amp_ga_cd_10">Content Length: Bucket</label>
			    </th>
			    <td>
			        <input type="text" size="3" name="gtm_ga_amp_ga_cd_10" id="gtm_ga_amp_ga_cd_10" placeholder="10" value="<?php echo $gtm_ga_amp_ga_cd_10; ?>">
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