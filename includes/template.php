<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Append homily media (audio, video, document) to single homily pages.
 */
function parishpress_homilies_append_to_content( $content ) {
    if ( ! is_singular( 'pp_homily' ) || ! in_the_loop() || ! is_main_query() || is_feed() ) {
        return $content;
    }

    $audio = get_post_meta( get_the_ID(), '_pp_homily_audio', true );
    $video = get_post_meta( get_the_ID(), '_pp_homily_video', true );
    $doc   = get_post_meta( get_the_ID(), '_pp_homily_doc', true );

    if ( ! $audio && ! $video && ! $doc ) {
        return $content;
    }

    ob_start();
    ?>
    <div class="parishpress-homilies-single">
        <?php if ( $audio ) : ?>
            <div class="pp-homily-audio"><audio controls src="<?php echo esc_url( $audio ); ?>"></audio></div>
        <?php endif; ?>

        <?php if ( $video ) : ?>
            <div class="pp-homily-video">
                <?php
                $embedded = wp_oembed_get( $video );
                if ( $embedded ) {
                    echo $embedded; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                } else {
                    ?>
                    <video controls src="<?php echo esc_url( $video ); ?>" style="max-width:100%;height:auto;"></video>
                    <?php
                }
                ?>
            </div>
        <?php endif; ?>

        <?php if ( $doc ) : ?>
            <div class="pp-homily-doc"><a class="pp-homily-doc-link" href="<?php echo esc_url( $doc ); ?>" target="_blank" rel="noopener">
                <?php esc_html_e( 'View Homily Notes', 'parishpress-homilies' ); ?>
            </a></div>
        <?php endif; ?>
    </div>
    <?php

    return $content . ob_get_clean();
}
add_filter( 'the_content', 'parishpress_homilies_append_to_content' );

/**
 * Replace featured image with video embed if a homily video is set.
 */
function parishpress_homilies_featured_video( $html, $post_id, $post_thumbnail_id ) {
    if ( 'pp_homily' !== get_post_type( $post_id ) ) {
        return $html;
    }

    $video = get_post_meta( $post_id, '_pp_homily_video', true );
    if ( ! $video ) {
        return $html;
    }

    $embedded = wp_oembed_get( $video );
    if ( $embedded ) {
        return '<div class="pp-homily-featured-video">' . $embedded . '</div>';
    }

    return sprintf(
        '<div class="pp-homily-featured-video"><video controls src="%s" style="max-width:100%%;height:auto;"></video></div>',
        esc_url( $video )
    );
}
add_filter( 'post_thumbnail_html', 'parishpress_homilies_featured_video', 10, 3 );
