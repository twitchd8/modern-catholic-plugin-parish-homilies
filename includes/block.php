<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function parishpress_homilies_register_block() {
    $script_path = PARISHPRESS_HOMILIES_PATH . 'assets/js/block.js';

    wp_register_script(
        'parishpress-homilies-block-editor',
        PARISHPRESS_HOMILIES_URL . 'assets/js/block.js',
        array( 'wp-blocks', 'wp-element', 'wp-components', 'wp-i18n', 'wp-block-editor' ),
        file_exists( $script_path ) ? filemtime( $script_path ) : PARISHPRESS_HOMILIES_VERSION
    );

    if ( ! wp_style_is( 'parishpress-homilies-frontend', 'registered' ) ) {
        wp_register_style(
            'parishpress-homilies-frontend',
            PARISHPRESS_HOMILIES_URL . 'assets/css/frontend.css',
            array(),
            PARISHPRESS_HOMILIES_VERSION
        );
    }

    register_block_type(
        'parishpress/homilies',
        array(
            'editor_script'   => 'parishpress-homilies-block-editor',
            'style'           => 'parishpress-homilies-frontend',
            'render_callback' => 'parishpress_homilies_block_render',
            'attributes'      => array(
                'limit' => array( 'type' => 'number', 'default' => 5 ),
            ),
        )
    );
}
add_action( 'init', 'parishpress_homilies_register_block' );

function parishpress_homilies_block_render( $attributes ) {
    $limit = isset( $attributes['limit'] ) ? (int) $attributes['limit'] : 5;
    if ( $limit < 1 ) {
        $limit = 5;
    }

    $shortcode = sprintf( '[parishpress_homilies limit="%d"]', $limit );

    return do_shortcode( $shortcode );
}
