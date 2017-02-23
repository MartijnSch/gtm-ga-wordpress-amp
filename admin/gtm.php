<?php
/**
 * custom option and settings
 */
function gtm_ga_amp_gtm_settings_init() {
  register_setting( 'gtm_ga_amp', 'gtm_ga_amp_gtm' );

  add_settings_section('gtm_ga_amp_gtm_section', __( 'Google Tag Manager: Settings', 'gtm_ga_amp' ), 'gtm_ga_amp_gtm_section_cb', 'gtm_ga_amp');
  add_settings_field('enabled', __( 'Enable Google Tag Manager', 'gtm_ga_amp' ), 'gtm_ga_amp_field_enabled_cb', 'gtm_ga_amp', 'gtm_ga_amp_gtm_section', ['label_for' => 'enabled']);
  add_settings_field('container_id', __( 'Container ID', 'gtm_ga_amp' ), 'gtm_ga_amp_field_container_id_cb', 'gtm_ga_amp', 'gtm_ga_amp_gtm_section', [ 'label_for' => 'container_id' ]);
  add_settings_field('variables', __( 'Enable AMP Variables', 'gtm_ga_amp' ), 'gtm_ga_amp_field_variables_cb', 'gtm_ga_amp', 'gtm_ga_amp_gtm_section', [ 'label_for' => 'variables' ]);
}
add_action( 'admin_init', 'gtm_ga_amp_gtm_settings_init' );
 
/**
 * custom option and settings:
 * callback functions
 */
 
// developers section cb
function gtm_ga_amp_gtm_section_cb( $args ) {
}

function gtm_ga_amp_field_enabled_cb( $args ) {
 $options = get_option( 'gtm_ga_amp_gtm' );
 ?>
 <input type="checkbox" name="gtm_ga_amp_gtm[<?php echo esc_attr( $args['label_for'] ); ?>]" value="1" <?php checked( $options[$args['label_for']], 1 ); ?>>
 <?php
}

function gtm_ga_amp_field_variables_cb( $args ) {
 $options = get_option( 'gtm_ga_amp_gtm' );
 ?>
 <input type="checkbox" name="gtm_ga_amp_gtm[<?php echo esc_attr( $args['label_for'] ); ?>]" value="1" <?php checked( $options[$args['label_for']], 1 ); ?>>
 <p class="description"><?php esc_html_e( 'The plugin will be adding AMP variables to the page, you\'ll be able to use them with Google Tag Manager.', 'gtm_ga_amp' ); ?>
    <br /><a href="#"><?php esc_html_e('Learn more about that here', 'gtm_ga_amp'); ?></a>.</p>
 <?php
}

function gtm_ga_amp_field_container_id_cb( $args ) {
 $options = get_option( 'gtm_ga_amp_gtm' );
 ?>
 <input type="text" name="gtm_ga_amp_gtm[<?php echo esc_attr( $args['label_for'] ); ?>]" value="<?= isset($options[$args['label_for']] ) ? esc_attr($options[$args['label_for']] ) : ''; ?>">
 <p class="description">
 <?php esc_html_e( 'Your Container ID, starting with: GTM-XXXXXX.', 'gtm_ga_amp' ); ?>
 </p>
 <?php
}

function gtm_ga_amp_page_gtm_html() {
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
   <h1>Google Tag Manager Settings</h1>
   <p>This plugin will support adding Google Tag Manager to your AMP pages in
    WordPres, configure the settings here.</p><hr>
   <form action="options.php" method="post">
     <?php
     // output security fields for the registered setting "gtm_ga_amp"
     settings_fields( 'gtm_ga_amp' );
     // output setting sections and their fields
     // (sections are registered for "gtm_ga_amp", each field is registered to a specific section)
     do_settings_sections( 'gtm_ga_amp' );
     submit_button( 'Save Changes' );
     ?>
   </form>
 </div>
 <?php
}