<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function parishpress_homilies_add_meta_box() {
    add_meta_box(
        'parishpress_homily_details',
        __( 'Homily Details', 'parishpress-homilies' ),
        'parishpress_homilies_render_meta_box',
        'pp_homily',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes', 'parishpress_homilies_add_meta_box' );

function parishpress_homilies_render_meta_box( $post ) {
    wp_nonce_field( 'parishpress_homily_details', 'parishpress_homilies_nonce' );

    $date    = get_post_meta( $post->ID, '_pp_homily_date', true );
    $preacher = get_post_meta( $post->ID, '_pp_homily_preacher', true );
    $audio   = get_post_meta( $post->ID, '_pp_homily_audio', true );
    $video   = get_post_meta( $post->ID, '_pp_homily_video', true );
    $doc     = get_post_meta( $post->ID, '_pp_homily_doc', true );
    ?>
    <p>
        <label for="pp_homily_date"><strong><?php esc_html_e( 'Date', 'parishpress-homilies' ); ?></strong></label><br>
        <input type="date" id="pp_homily_date" name="pp_homily_date" value="<?php echo esc_attr( $date ); ?>" />
    </p>
    <p>
        <label for="pp_homily_preacher"><strong><?php esc_html_e( 'Preacher', 'parishpress-homilies' ); ?></strong></label><br>
        <input type="text" id="pp_homily_preacher" name="pp_homily_preacher" value="<?php echo esc_attr( $preacher ); ?>" class="regular-text" />
    </p>
    <p>
        <label for="pp_homily_audio"><strong><?php esc_html_e( 'Audio URL (MP3)', 'parishpress-homilies' ); ?></strong></label><br>
        <input type="url" id="pp_homily_audio" name="pp_homily_audio" value="<?php echo esc_attr( $audio ); ?>" class="regular-text" />
        <button type="button" class="button" id="pp_homily_audio_button"><?php esc_html_e( 'Upload/Select Audio', 'parishpress-homilies' ); ?></button>
    </p>
    <p>
        <label for="pp_homily_video"><strong><?php esc_html_e( 'Video URL (MP4 or oEmbed)', 'parishpress-homilies' ); ?></strong></label><br>
        <input type="url" id="pp_homily_video" name="pp_homily_video" value="<?php echo esc_attr( $video ); ?>" class="regular-text" />
        <button type="button" class="button" id="pp_homily_video_button"><?php esc_html_e( 'Upload/Select Video', 'parishpress-homilies' ); ?></button>
    </p>
    <p>
        <label for="pp_homily_doc"><strong><?php esc_html_e( 'Homily Notes/Document URL (PDF)', 'parishpress-homilies' ); ?></strong></label><br>
        <input type="url" id="pp_homily_doc" name="pp_homily_doc" value="<?php echo esc_attr( $doc ); ?>" class="regular-text" />
        <button type="button" class="button" id="pp_homily_doc_button"><?php esc_html_e( 'Upload/Select Document', 'parishpress-homilies' ); ?></button>
        <span class="description"><?php esc_html_e( 'Paste a URL or use the media library to upload/select the document.', 'parishpress-homilies' ); ?></span>
    </p>
    <?php
}

function parishpress_homilies_save_meta( $post_id ) {
    if ( ! isset( $_POST['parishpress_homilies_nonce'] ) ||
         ! wp_verify_nonce( $_POST['parishpress_homilies_nonce'], 'parishpress_homily_details' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $map = array(
        '_pp_homily_date'     => 'pp_homily_date',
        '_pp_homily_preacher' => 'pp_homily_preacher',
        '_pp_homily_audio'    => 'pp_homily_audio',
        '_pp_homily_video'    => 'pp_homily_video',
        '_pp_homily_doc'      => 'pp_homily_doc',
    );

    foreach ( $map as $meta_key => $field_key ) {
        if ( isset( $_POST[ $field_key ] ) ) {
            $value = sanitize_text_field( wp_unslash( $_POST[ $field_key ] ) );
            if ( in_array( $meta_key, array( '_pp_homily_audio', '_pp_homily_video', '_pp_homily_doc' ), true ) ) {
                $value = esc_url_raw( wp_unslash( $_POST[ $field_key ] ) );
            }
            update_post_meta( $post_id, $meta_key, $value );
        }
    }
}
add_action( 'save_post_pp_homily', 'parishpress_homilies_save_meta' );
