<?php
	/**
	 * Return if Google Tag Manager is enabled for the plugin.
	 *
	 * @since 1.0.0
	 */
	function gtm_enabled() {
		$enabled = get_option('gtm_ga_amp_gtm_enabled');
		$container_id = get_option('gtm_ga_amp_gtm_container_id');

		if(isset($enabled)) {
			if(empty($container_id)) {
				return false;
			} else {
				$enabled = ($enabled == "on" ? true : false);
				return $enabled;
			}
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
	function amp_analytics_print_gtm_scripts_head(){
    if(gtm_enabled()) {
?>
	    <!-- AMP Analytics --><script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
<?php
	}}
	add_action( 'amp_post_template_head', 'amp_analytics_print_gtm_scripts_head' );


	/**
	 * Print Google's AMP Analytics (required) script at the end of the BODY.
	 * Documentation: https://developers.google.com/analytics/devguides/collection/amp-analytics/
	 *
	 * @since 1.0.0
	 */
	function amp_analytics_print_gtm_scripts_body() {
		$gtm_tracking_id = get_option('gtm_ga_amp_gtm_container_id');
    if(gtm_enabled()) {
      echo '<!-- Google Tag Manager --><amp-analytics config="https://www.googletagmanager.com/amp.json?id='.$gtm_tracking_id.'&gtm.url=SOURCE_URL" data-credentials="include">'.amp_analytics_amp_variables().'</amp-analytics>';
    }
	}
	add_action( 'amp_post_template_footer', 'amp_analytics_print_gtm_scripts_body' );


	function amp_analytics_amp_variables() {
		global $post;
		$amp_variables_enabled = get_option('gtm_ga_amp_gtm_amp_variables');

		if(isset($amp_variables_enabled) && $amp_variables_enabled === "on") {

			$amp_variables = [
				'vars' => [
					'post_id' 							=> $post->ID,
					'post_published_date' 	=> date('Y-m-d H:i', strtotime($post->post_date)),
					'post_author' 					=> get_post_author(),
					'post_tags' 						=> get_post_tags(),
					'post_categories' 			=> get_post_categories(),
					'post_type' 						=> $post->post_type,
					'post_comments' 				=> get_comments_number($post->ID),
					'logged_in' 						=> is_user_logged_in(),
					'content_length_words' 	=> str_word_count($post->post_content),
					'content_length_bucket' => get_content_length_bucket()
				]
			];

			$variables_code = '<script type="application/json">'.json_encode($amp_variables).'</script>';

			return $variables_code;
		}
	}
?>