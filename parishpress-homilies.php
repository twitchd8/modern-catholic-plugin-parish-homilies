<?php
/**
 * Plugin Name: ParishPress Homilies
 * Description: Homilies (sermons) as a custom post type with audio support.
 * Version: 0.2.0
 * Author: Andrew Schmitt
 * Text Domain: parishpress-homilies
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'PARISHPRESS_HOMILIES_VERSION', '0.2.0' );
define( 'PARISHPRESS_HOMILIES_PATH', plugin_dir_path( __FILE__ ) );
define( 'PARISHPRESS_HOMILIES_URL', plugin_dir_url( __FILE__ ) );

require PARISHPRESS_HOMILIES_PATH . 'includes/cpt.php';
require PARISHPRESS_HOMILIES_PATH . 'includes/meta.php';
require PARISHPRESS_HOMILIES_PATH . 'includes/shortcode.php';
require PARISHPRESS_HOMILIES_PATH . 'includes/assets.php';
require PARISHPRESS_HOMILIES_PATH . 'includes/block.php';
require PARISHPRESS_HOMILIES_PATH . 'includes/template.php';
