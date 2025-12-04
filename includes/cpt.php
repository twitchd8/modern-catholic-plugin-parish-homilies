<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function parishpress_homilies_register_cpt() {
    $labels = array(
        'name'          => __( 'Homilies', 'parishpress-homilies' ),
        'singular_name' => __( 'Homily', 'parishpress-homilies' ),
        'add_new_item'  => __( 'Add New Homily', 'parishpress-homilies' ),
        'edit_item'     => __( 'Edit Homily', 'parishpress-homilies' ),
        'menu_name'     => __( 'Homilies', 'parishpress-homilies' ),
    );

    $args = array(
        'labels'       => $labels,
        'public'       => true,
        'show_in_rest' => true,
        'has_archive'  => true,
        'rewrite'      => array( 'slug' => 'homilies' ),
        'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'menu_icon'    => 'dashicons-microphone',
    );

    register_post_type( 'pp_homily', $args );
}
add_action( 'init', 'parishpress_homilies_register_cpt' );
