<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    GTM_GA_AMP
 */

if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

$option_name = 'wporg_option';
 
delete_option($option_name);

?>