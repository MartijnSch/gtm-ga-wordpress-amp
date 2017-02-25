<?php
	/**
	 * Return if Google Tag Manager is enabled for the plugin.
	 *
	 * @since 1.0.0
	 */
	function gtm_ga_amp_gtm_enabled() {
		$options = get_option('gtm_ga_amp_gtm');
		$enabled = $options['enabled'];
		$container_id = $options['container_id'];

		if(isset($enabled) && !empty($container_id)) {
			$enabled = ($enabled == "1" ? true : false);
			return $enabled;
		} else {
			return false;
		}
	}

	/**
	 * Print Google's AMP Analytics (required) script in the HEAD.
	 * Documentation: https://developers.google.com/analytics/devguides/collection/amp-analytics/
	 *
	 * @since 1.0.0
	 */
	function gtm_ga_amp_print_gtm_scripts_head(){
    if(gtm_ga_amp_gtm_enabled()) {
?>
	    <!-- AMP Analytics --><script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
<?php
	}}
	add_action( 'amp_post_template_head', 'gtm_ga_amp_print_gtm_scripts_head' );

	/**
	 * Print Google's AMP Analytics (required) script at the end of the BODY.
	 * Documentation: https://developers.google.com/analytics/devguides/collection/amp-analytics/
	 *
	 * @since 1.0.0
	 */
	function gtm_ga_amp_print_gtm_scripts_body() {
		$options = get_option('gtm_ga_amp_gtm');
		$container_id = $options['container_id'];
    if(gtm_enabled()) {
      echo '<!-- Google Tag Manager --><amp-analytics config="https://www.googletagmanager.com/amp.json?id='.$container_id.'&gtm.url=SOURCE_URL" data-credentials="include">'.amp_analytics_amp_variables().'</amp-analytics>';
    }
	}
	add_action( 'amp_post_template_footer', 'gtm_ga_amp_print_gtm_scripts_body' );


	function gtm_ga_amp_variables() {
		global $post;
		$options = get_option('gtm_ga_amp_gtm');
		$amp_variables_enabled = $options['variables'];

		if(isset($amp_variables_enabled) && $amp_variables_enabled === "1") {

			$amp_variables = [
				'vars' => [
					'post_id' 							=> $post->ID,
					'post_published_date' 	=> date('Y-m-d H:i', strtotime($post->post_date)),
					'post_author' 					=> gtm_ga_amp_get_post_author(),
					'post_tags' 						=> gtm_ga_amp_get_post_tags(),
					'post_categories' 			=> gtm_ga_amp_get_post_categories(),
					'post_type' 						=> $post->post_type,
					'post_comments' 				=> get_comments_number($post->ID),
					'logged_in' 						=> is_user_logged_in(),
					'content_length_words' 	=> str_word_count($post->post_content),
					'content_length_bucket' => gtm_ga_amp_get_content_length_bucket()
				]
			];

			$variables_code = '<script type="application/json">'.json_encode($amp_variables).'</script>';

			return $variables_code;
		}
	}
?>