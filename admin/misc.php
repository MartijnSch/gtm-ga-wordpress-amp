<?php
  /**
   * Return the categories for a post.
   *
   * @since 1.0.0
   */
  function both_enabled() {
    $options_ga = get_option('gtm_ga_amp_ga');
    $options_gtm = get_option('gtm_ga_amp_gtm');

    if(($options_ga['enabled'] === "1") && ($options_gtm['enabled'] === "1")) {
    	add_action( 'admin_notices', 'show_enabled_notice' );
    }
  }

  both_enabled();

  function show_enabled_notice() {
	?>
  	<div class="error notice">
      <p><strong><a href="<?php plugins_url(); ?>"><?php _e( 'GTM &amp; GA - AMP:'); ?></a></strong> <?php _e( 'You\'ve enabled Google Tag Manager and Google Analytics, disable one to make AMP validation successful!', 'gtm_ga_amp' ); ?></p>
  </div>
<?php
  }
?>