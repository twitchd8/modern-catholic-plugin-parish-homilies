<?php
/**
 * Plugin Name: Modern Catholic – Parish Homilies
 * Plugin URI: https://github.com/twitchd8/modern-catholic-plugin-parish-homilies
 * Description: Parish homilies for Modern Catholic websites as a custom post type with audio, video, and document support.
 * Version: 0.2.2
 * Author: Andrew Schmitt
 * License: GPL-3.0-only
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: parishpress-homilies
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Legacy PARISHPRESS_* constants remain part of the plugin's compatibility surface.
define( 'PARISHPRESS_HOMILIES_VERSION', '0.2.2' );
define( 'PARISHPRESS_HOMILIES_PATH', plugin_dir_path( __FILE__ ) );
define( 'PARISHPRESS_HOMILIES_URL', plugin_dir_url( __FILE__ ) );

/**
 * Migrates existing homily posts to the Modern Catholic post type key.
 */
function modern_catholic_homilies_maybe_migrate_post_type() {
    global $wpdb;

    if ( '1.0.0' === get_option( 'modern_catholic_homilies_schema_version' ) ) {
        return;
    }

    $wpdb->update(
        $wpdb->posts,
        array( 'post_type' => 'mc_homily' ),
        array( 'post_type' => 'pp_homily' ),
        array( '%s' ),
        array( '%s' )
    );

    update_option( 'modern_catholic_homilies_schema_version', '1.0.0', false );
    update_option( 'modern_catholic_homilies_flush_rewrite', 1, false );
}
add_action( 'plugins_loaded', 'modern_catholic_homilies_maybe_migrate_post_type', 5 );

/**
 * Refreshes rewrite rules once after the post type migration.
 */
function modern_catholic_homilies_maybe_flush_rewrite_rules() {
    if ( get_option( 'modern_catholic_homilies_flush_rewrite' ) ) {
        flush_rewrite_rules( false );
        delete_option( 'modern_catholic_homilies_flush_rewrite' );
    }
}
add_action( 'init', 'modern_catholic_homilies_maybe_flush_rewrite_rules', 99 );

require PARISHPRESS_HOMILIES_PATH . 'includes/cpt.php';
require PARISHPRESS_HOMILIES_PATH . 'includes/meta.php';
require PARISHPRESS_HOMILIES_PATH . 'includes/shortcode.php';
require PARISHPRESS_HOMILIES_PATH . 'includes/assets.php';
require PARISHPRESS_HOMILIES_PATH . 'includes/block.php';
require PARISHPRESS_HOMILIES_PATH . 'includes/template.php';
