<?php

/**
* Plugin Name: Google Tag Manager & Google Analytics for AMP
* Plugin URI:  https://developer.wordpress.org/plugins/gtm-ga-wordpress-amp/
* Description: Provide support for Google Analytics & Google Tag Manager on pages supported by the AMP Project (Accelerated Mobile Pages).
* Version:     1.0.0
* Author:      Martijn Scheijbeler
* Author URI:  http://www.martijnscheijbeler.com
* License:       GPL v3
* License URI: https://opensource.org/licenses/GPL-3.0
* 
* Google Tag Manager & Google Analytics for AMP is free software: you can
* redistribute it and/or modify it under the terms of the GNU General Public
* License as published by the Free Software Foundation, either version 3 of
* the License, or any later version.
*  
* Google Tag Manager & Google Analytics for AMP is distributed in the hope
* that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
* warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
* 
* You should have received a copy of the GNU General Public License
* along with Google Tag Manager & Google Analytics for AMP. If not,
* see https://opensource.org/licenses/GPL-3.0.
*/

// DO MORE WITH THIS:
// https://github.com/Automattic/amp-wp/wiki/Analytics
// https://codex.wordpress.org/Function_Reference/add_settings_field

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
  die;
}

require plugin_dir_path( __FILE__ ) . 'admin/dashboard.php';
require plugin_dir_path( __FILE__ ) . 'admin/ga.php';
require plugin_dir_path( __FILE__ ) . 'admin/gtm.php';

require plugin_dir_path( __FILE__ ) . 'public/ga.php';
require plugin_dir_path( __FILE__ ) . 'public/gtm.php';
require plugin_dir_path( __FILE__ ) . 'public/misc.php';

/**
 * Create the menu + sublevel menus for the plugin.
 *
 * @since 1.0.0
 */
function gtm_ga_amp_menu() {
  add_menu_page(
    'Google Tag Manager & Google Analytics for AMP',
    'GTM & GA - AMP',
    'manage_options',
    'gtm-ga-amp',
    'gtm_ga_amp_page_html',
    '',
    999
  );

  add_submenu_page(
    'gtm-ga-amp',
    'Google Tag Manager & Google Analytics for AMP - Settings',
    'Dashboard',
    'manage_options',
    'gtm-ga-amp',
    'gtm_ga_amp_page_html'
  );

  add_submenu_page(
    'gtm-ga-amp',
    'Google Analytics for AMP - Settings',
    'Google Analytics',
    'manage_options',
    'google-analytics',
    'gtm_ga_amp_page_ga_html'
  );

  add_submenu_page(
    'gtm-ga-amp',
    'Google Tag Manager for AMP - Settings',
    'Google Tag Manager',
    'manage_options',
    'google-tag-manager',
    'gtm_ga_amp_page_gtm_html'
  );
}
add_action('admin_menu', 'gtm_ga_amp_menu');