<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://wowthemes.net/
 * @since             1.0.0
 * @package           Wp_Claps_Applause
 *
 * @wordpress-plugin
 * Plugin Name:       WP Applause Button
 * Plugin URI:        https://www.wowthemes.net/wowplugins/wp-applause-button/
 * Description:       This plugin enables you to add an ajax Applause button to your WordPress post. Just activate it and it works, no options. It also includes a shortcode to let you manually add the button to the post.
 * Version:           1.0.0
 * Author:            WowThemesNet
 * Author URI:        https://wowthemes.net/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       wp-claps-applause
 * Domain Path:       /languages
 */

require 'class-claps-applause.php';
$ClapsApplause = new WPClapsApplause();

// Sample code to display the button below post content. 
// If return value is "none" then button won't automatically appear.
// add_filter( 'wpli/position', function() {return 'bottom';} );
