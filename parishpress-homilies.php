<?php
/**
 * Plugin Name: Modern Catholic – Parish Homilies
 * Plugin URI: https://github.com/twitchd8/modern-catholic-plugin-parish-homilies
 * Description: Parish homilies for Modern Catholic websites as a custom post type with audio, video, and document support.
 * Version: 0.2.0
 * Author: Andrew Schmitt
 * License: GPL-3.0-only
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: parishpress-homilies
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Legacy PARISHPRESS_* constants remain part of the plugin's compatibility surface.
define( 'PARISHPRESS_HOMILIES_VERSION', '0.2.0' );
define( 'PARISHPRESS_HOMILIES_PATH', plugin_dir_path( __FILE__ ) );
define( 'PARISHPRESS_HOMILIES_URL', plugin_dir_url( __FILE__ ) );

require PARISHPRESS_HOMILIES_PATH . 'includes/cpt.php';
require PARISHPRESS_HOMILIES_PATH . 'includes/meta.php';
require PARISHPRESS_HOMILIES_PATH . 'includes/shortcode.php';
require PARISHPRESS_HOMILIES_PATH . 'includes/assets.php';
require PARISHPRESS_HOMILIES_PATH . 'includes/block.php';
require PARISHPRESS_HOMILIES_PATH . 'includes/template.php';
