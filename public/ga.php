<?php
	/**
	 * Return if Google Analytics is enabled for the plugin.
	 *
	 * @since 1.0.0
	 */
	function ga_enabled() {
		$options = get_option('gtm_ga_amp_ga');
		$enabled = $options['enabled'];
		$tracking_id = $options['tracking_id'];

		if(isset($enabled) && !empty($tracking_id)) {
			$enabled = ($enabled == "1" ? true : false);
			return $enabled;
		} else {
			return false;
		}
	}

	/**
	 * Return the Page Tracking object for Google Analytics for the public interface.
	 *
	 * @since 1.0.0
	 * @param $tracking_id: the tracking id for the Google Analytics object
	 */
	function page_tracking($tracking_id) {

		$trackPageview =
			['trackPageview' => [
				'on' => 'visible',
				'request' => 'pageview'
			]];

		$triggers = array_merge($trackPageview, outbound_link_tracking());

		$page_tracking = [
			'vars' => [
				'account' =>
					$tracking_id
			],
			'extraUrlParams' =>
				printCustomDimensions()
			,
			'triggers' =>
				$triggers
		];

		return $page_tracking;
	}

	/**
	 * Return if you want to add Outbound Link Tracking to the Google Analytics object.
	 *
	 * @since 1.0.0
	 */
	function outbound_link_tracking() {
		$options = get_option('gtm_ga_amp_ga');
		$enabled = $options['outbound_enabled'];

		if(isset($enabled) && $enabled === "1") {
			$outbound_link_tracking = [
			'outboundLinks' => [
					'on' => 'click',
					'request' => 'event',
					'selector' => 'a',
					'vars' => [
						'eventCategory' => 'Outbound Links',
						'eventAction' => 'Click',
						'eventValue' => '${outboundLink}'
					]
				]];
			return $outbound_link_tracking;
		}
		return array();
	}

	/**
	 * Return the Index value of a Custom Dimension.
	 *
	 * @since 1.0.0
	 * @param $index: the custom dimension index value
	 */
	function getCustomDimensionIndex($index) {
		if($index) {
			$options = get_option('gtm_ga_amp_ga');
			$value = $options['cd_'.$index];

			if(!empty($value)) {
				return $value;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	/**
	 * Return the value of a Custom Dimension Index.
	 *
	 * @since 1.0.0
	 * @param $index: the custom dimension index value
	 */
	function getCustomDimensionValue($index) {
		global $post;

		switch ($index) {
			case "1":
				return $post->ID;
				break;
			case "2":
				return date('Y-m-d H:i', strtotime($post->post_date));
				break;
			case "3":
				return get_post_author();
				break;
			case "4":
				return get_post_tags();
				break;
			case "5":
				return get_post_categories();
				break;
			case "6":
				return $post->post_type;
				break;
			case "7":
				return get_comments_number($post->ID);
				break;
			case "8":
				return is_user_logged_in();
				break;
			case "9":
				return str_word_count($post->post_content);
				break;
			case "10":
				return get_content_length_bucket();
				break;
		}
	}

	/**
	 * Return an array of Custom Dimensions for the Google Analytics Object.
	 *
	 * @since 1.0.0
	 */
	function printCustomDimensions() {
		$dimensions = array();

		for ($x = 1; $x <= 10; $x++) {
	    if(getCustomDimensionIndex($x)) {
	    	$dimensions['cd'.getCustomDimensionIndex($x)] = getCustomDimensionValue($x);
	    }
		}

		return $dimensions;
	}

	/**
	 * Print Google's AMP Analytics (required) script in the HEAD.
	 * Documentation: https://developers.google.com/analytics/devguides/collection/amp-analytics/
	 *
	 * @since 1.0.0
	 */
	function amp_analytics_print_ga_scripts_head(){
	    if(ga_enabled()) {
	?>
	    <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
	<?php
	}}
	add_action( 'amp_post_template_head', 'amp_analytics_print_ga_scripts_head' );

	/**
	 * Print Google's AMP Analytics (required) script at the end of the BODY.
	 * Documentation: https://developers.google.com/analytics/devguides/collection/amp-analytics/
	 *
	 * @since 1.0.0
	 */
	function amp_analytics_print_ga_scripts_body() {
	    if(ga_enabled()) {

	    		$options = get_option('gtm_ga_amp_ga');
	    		$tracking_id = $options['tracking_id'];

	        printf('<amp-analytics type="googleanalytics">
	                <script type="application/json">
	                    %s
	                </script>
	            </amp-analytics>', json_encode(page_tracking($tracking_id)));
	    }
	}
	add_action( 'amp_post_template_footer', 'amp_analytics_print_ga_scripts_body' );
?>