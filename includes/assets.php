<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function parishpress_homilies_enqueue_assets() {
    wp_enqueue_style(
        'parishpress-homilies-frontend',
        PARISHPRESS_HOMILIES_URL . 'assets/css/frontend.css',
        array(),
        PARISHPRESS_HOMILIES_VERSION
    );
}
add_action( 'wp_enqueue_scripts', 'parishpress_homilies_enqueue_assets' );

/**
 * Admin assets (media pickers for document/audio/video).
 */
function parishpress_homilies_enqueue_admin_assets( $hook ) {
    global $post;

    if ( ! isset( $post->post_type ) || 'mc_homily' !== $post->post_type ) {
        return;
    }

    wp_enqueue_media();

    wp_enqueue_script(
        'parishpress-homilies-admin',
        PARISHPRESS_HOMILIES_URL . 'assets/js/admin.js',
        array( 'jquery', 'media-editor', 'media-views' ),
        PARISHPRESS_HOMILIES_VERSION,
        true
    );

    wp_localize_script(
        'parishpress-homilies-admin',
        'homiliesAdmin',
        array(
            'chooserDoc'   => __( 'Select Homily Document', 'parishpress-homilies' ),
            'buttonDoc'    => __( 'Use this file', 'parishpress-homilies' ),
            'chooserAudio' => __( 'Select Audio', 'parishpress-homilies' ),
            'buttonAudio'  => __( 'Use this audio', 'parishpress-homilies' ),
            'chooserVideo' => __( 'Select Video', 'parishpress-homilies' ),
            'buttonVideo'  => __( 'Use this video', 'parishpress-homilies' ),
        )
    );
}
add_action( 'admin_enqueue_scripts', 'parishpress_homilies_enqueue_admin_assets' );
