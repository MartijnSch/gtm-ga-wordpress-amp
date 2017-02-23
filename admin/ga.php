<?php
  function gtm_ga_amp_ga_settings_init() {
    register_setting( 'gtm_ga_amp_ga', 'gtm_ga_amp_ga' );

    add_settings_section('gtm_ga_amp_ga_section_basic', __( 'Google Analytics: Settings', 'gtm_ga_amp' ), 'gtm_ga_amp_ga_section_basic_cb', 'gtm_ga_amp_ga_basic');
    add_settings_field('enabled', __( 'Enable Google Analytics', 'gtm_ga_amp' ), 'gtm_ga_amp_ga_field_enabled_cb', 'gtm_ga_amp_ga_basic', 'gtm_ga_amp_ga_section_basic', ['label_for' => 'enabled']);
    add_settings_field('tracking_id', __( 'Tracking ID', 'gtm_ga_amp' ), 'gtm_ga_amp_field_tracking_id_cb', 'gtm_ga_amp_ga_basic', 'gtm_ga_amp_ga_section_basic', [ 'label_for' => 'tracking_id' ]);

    add_settings_section('gtm_ga_amp_ga_section_outbound', __( 'Advanced', 'gtm_ga_amp' ), 'gtm_ga_amp_ga_section_outbound_cb', 'gtm_ga_amp_ga');
    add_settings_field('outbound_enabled', __( 'Enable Outbound Click Tracking', 'gtm_ga_amp' ), 'gtm_ga_amp_ga_field_outbound_enabled_cb', 'gtm_ga_amp_ga', 'gtm_ga_amp_ga_section_outbound', ['label_for' => 'outbound_enabled']);

    add_settings_section('gtm_ga_amp_ga_section_cd', __( 'Custom dimensions', 'gtm_ga_amp' ), 'gtm_ga_amp_ga_section_cd_cb', 'gtm_ga_amp_ga');
	  add_settings_field('cd_1', __( 'Post ID', 'gtm_ga_amp' ), 'gtm_ga_amp_ga_field_cd_cb', 'gtm_ga_amp_ga', 'gtm_ga_amp_ga_section_cd', ['label_for' => 'cd_1', 'placeholder' => 1]);
	  add_settings_field('cd_2', __( 'Post Published Date', 'gtm_ga_amp' ), 'gtm_ga_amp_ga_field_cd_cb', 'gtm_ga_amp_ga', 'gtm_ga_amp_ga_section_cd', ['label_for' => 'cd_2', 'placeholder' => 2]);
	  add_settings_field('cd_3', __( 'Post Author', 'gtm_ga_amp' ), 'gtm_ga_amp_ga_field_cd_cb', 'gtm_ga_amp_ga', 'gtm_ga_amp_ga_section_cd', ['label_for' => 'cd_3', 'placeholder' => 3]);
	  add_settings_field('cd_4', __( 'Post Tags', 'gtm_ga_amp' ), 'gtm_ga_amp_ga_field_cd_cb', 'gtm_ga_amp_ga', 'gtm_ga_amp_ga_section_cd', ['label_for' => 'cd_4', 'placeholder' => 4]);
	  add_settings_field('cd_5', __( 'Post Categories', 'gtm_ga_amp' ), 'gtm_ga_amp_ga_field_cd_cb', 'gtm_ga_amp_ga', 'gtm_ga_amp_ga_section_cd', ['label_for' => 'cd_5', 'placeholder' => 5]);
	  add_settings_field('cd_6', __( 'Post Types', 'gtm_ga_amp' ), 'gtm_ga_amp_ga_field_cd_cb', 'gtm_ga_amp_ga', 'gtm_ga_amp_ga_section_cd', ['label_for' => 'cd_6', 'placeholder' => 6]);
	  add_settings_field('cd_7', __( 'Post Comments', 'gtm_ga_amp' ), 'gtm_ga_amp_ga_field_cd_cb', 'gtm_ga_amp_ga', 'gtm_ga_amp_ga_section_cd', ['label_for' => 'cd_7', 'placeholder' => 7]);
	  add_settings_field('cd_8', __( 'Logged In', 'gtm_ga_amp' ), 'gtm_ga_amp_ga_field_cd_cb', 'gtm_ga_amp_ga', 'gtm_ga_amp_ga_section_cd', ['label_for' => 'cd_8', 'placeholder' => 8]);
		add_settings_field('cd_9', __( 'Content Length: Words', 'gtm_ga_amp' ), 'gtm_ga_amp_ga_field_cd_cb', 'gtm_ga_amp_ga', 'gtm_ga_amp_ga_section_cd', ['label_for' => 'cd_9', 'placeholder' => 9]);
		add_settings_field('cd_10', __( 'Content Length: Bucket', 'gtm_ga_amp' ), 'gtm_ga_amp_ga_field_cd_cb', 'gtm_ga_amp_ga', 'gtm_ga_amp_ga_section_cd', ['label_for' => 'cd_10', 'placeholder' => 10]);
  }
  add_action( 'admin_init', 'gtm_ga_amp_ga_settings_init' );

  // Define Sections
	function gtm_ga_amp_ga_section_basic_cb($args) {
  }

	function gtm_ga_amp_ga_section_outbound_cb($args) {
		esc_html_e('More settings to start measuring: clicks on outbound links.');
  }

	function gtm_ga_amp_ga_section_custom_dimensions_cb($args) {
		esc_html_e('What custom dimensions do you want to send along to Google Analytics, configure them here:');
  }

  function gtm_ga_amp_ga_field_enabled_cb($args) {
   $options = get_option( 'gtm_ga_amp_ga' );
   ?>
   <input type="checkbox" name="gtm_ga_amp_ga[<?php echo esc_attr( $args['label_for'] ); ?>]" value="1" <?php checked( $options[$args['label_for']], 1 ); ?>>
   <?php
  }

  function gtm_ga_amp_ga_field_outbound_enabled_cb($args) {
   $options = get_option( 'gtm_ga_amp_ga' );
   ?>
   <input type="checkbox" name="gtm_ga_amp_ga[<?php echo esc_attr( $args['label_for'] ); ?>]" value="1" <?php checked( $options[$args['label_for']], 1 ); ?>>
   <p class="description">You'll find information around sharing tracking in your Event Tracking reports as: Outbound Links, Click, <a href="https://developers.google.com/analytics/devguides/collection/amp-analytics/#outbound_link_tracking">${outboundLink}</a></p>
   <?php
  }

  function gtm_ga_amp_field_tracking_id_cb($args) {
   $options = get_option( 'gtm_ga_amp_ga' );
   ?>
   <input type="text" name="gtm_ga_amp_ga[<?php echo esc_attr( $args['label_for'] ); ?>]" value="<?= isset($options[$args['label_for']]) ? esc_attr($options[$args['label_for']] ) : ''; ?>">
   <p class="description">
   <?php esc_html_e( 'Your Google Analytics Tracking ID, starting with: UA-XXXXXX-X.', 'gtm_ga_amp' ); ?>
   </p>
   <?php
  }

  function gtm_ga_amp_ga_field_cd_cb($args) {
   $options = get_option( 'gtm_ga_amp_ga' );
   ?>
   <input type="text" size="4" placeholder="<?php echo esc_attr( $args['placeholder'] ); ?>" name="gtm_ga_amp_ga[<?php echo esc_attr( $args['label_for'] ); ?>]" value="<?= isset($options[$args['label_for']]) ? esc_attr($options[$args['label_for']] ) : ''; ?>">
   <?php
  }

/**
 * Register settings, sections, and fields.
 *
 * @since 0.0.1
 */
function gtm_ga_amp_page_ga_html() {
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
		<h1>Google Analytics for AMP</h2>
		<p>This plugin will support adding Google Analytics to your AMP pages in
		WordPress, configure the settings here and add more information to your
		tracking code if needed.</p>
		<hr>
		<form action="options.php" method="post">
			<?php
			// output security fields for the registered setting "gtm_ga_amp"
			settings_fields( 'gtm_ga_amp_ga' );
			// output setting sections and their fields
			// (sections are registered for "gtm_ga_amp", each field is registered to a specific section)
			do_settings_sections( 'gtm_ga_amp_ga_basic' );
			?>
			<hr>
			<?php
			do_settings_sections( 'gtm_ga_amp_ga' );
			submit_button( 'Save Changes' );
			?>
		</form>
  </div>
  <?php
}