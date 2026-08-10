<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Shortcode: [parishpress_homilies limit="5"]
 */
function parishpress_homilies_shortcode( $atts ) {
    $atts = shortcode_atts(
        array(
            'limit' => 5,
        ),
        $atts,
        'parishpress_homilies'
    );

    $q = new WP_Query(
        array(
            'post_type'      => 'mc_homily',
            'posts_per_page' => (int) $atts['limit'],
            'meta_key'       => '_pp_homily_date',
            'orderby'        => 'meta_value',
            'order'          => 'DESC',
        )
    );

    ob_start();

    if ( $q->have_posts() ) {
        echo '<ul class="parishpress-homilies-list">';
        while ( $q->have_posts() ) {
            $q->the_post();
            $date     = get_post_meta( get_the_ID(), '_pp_homily_date', true );
            $preacher = get_post_meta( get_the_ID(), '_pp_homily_preacher', true );
            $audio    = get_post_meta( get_the_ID(), '_pp_homily_audio', true );
            $video    = get_post_meta( get_the_ID(), '_pp_homily_video', true );
            $doc      = get_post_meta( get_the_ID(), '_pp_homily_doc', true );

            echo '<li class="parishpress-homilies-item">';
            echo '<div class="pp-homily-header">';
            echo '<strong class="pp-homily-title">' . esc_html( get_the_title() ) . '</strong>';
            if ( $date ) {
                echo ' <span class="pp-homily-date">(' . esc_html( $date ) . ')</span>';
            }
            if ( $preacher ) {
                echo ' – <span class="pp-homily-preacher">' . esc_html( $preacher ) . '</span>';
            }
            echo '</div>';

            if ( $audio ) {
                echo '<div class="pp-homily-audio"><audio controls src="' . esc_url( $audio ) . '"></audio></div>';
            }

            if ( $video ) {
                $embedded = wp_oembed_get( $video );
                if ( $embedded ) {
                    echo '<div class="pp-homily-video">' . $embedded . '</div>';
                } else {
                    echo '<div class="pp-homily-video"><video controls src="' . esc_url( $video ) . '" style="max-width:100%;height:auto;"></video></div>';
                }
            }

            if ( $doc ) {
                echo '<div class="pp-homily-doc"><a class="pp-homily-doc-link" href="' . esc_url( $doc ) . '" target="_blank" rel="noopener">';
                esc_html_e( 'View Homily Notes', 'parishpress-homilies' );
                echo '</a></div>';
            }

            echo '</li>';
        }
        echo '</ul>';
    } else {
        esc_html_e( 'No homilies found.', 'parishpress-homilies' );
    }

    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode( 'parishpress_homilies', 'parishpress_homilies_shortcode' );
