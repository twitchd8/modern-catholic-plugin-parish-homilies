// Admin script for Modern Catholic – Parish Homilies media pickers.
(function( $ ) {
    function bindMediaButton( buttonSelector, inputSelector, libraryTypes, chooserTitle, buttonText ) {
        var frame;
        var button = $( buttonSelector );
        var input = $( inputSelector );

        if ( ! button.length || ! input.length ) {
            return;
        }

        button.on( 'click', function( event ) {
            event.preventDefault();

            if ( frame ) {
                frame.open();
                return;
            }

            frame = wp.media({
                title: chooserTitle,
                button: { text: buttonText },
                library: { type: libraryTypes },
                multiple: false
            });

            frame.on( 'select', function() {
                var attachment = frame.state().get( 'selection' ).first().toJSON();
                if ( attachment && attachment.url ) {
                    input.val( attachment.url ).trigger( 'change' );
                }
            });

            frame.open();
        });
    }

    $( document ).ready( function() {
        bindMediaButton(
            '#pp_homily_doc_button',
            '#pp_homily_doc',
            [ 'application/pdf' ],
            homiliesAdmin.chooserDoc,
            homiliesAdmin.buttonDoc
        );
        bindMediaButton(
            '#pp_homily_audio_button',
            '#pp_homily_audio',
            [ 'audio' ],
            homiliesAdmin.chooserAudio,
            homiliesAdmin.buttonAudio
        );
        bindMediaButton(
            '#pp_homily_video_button',
            '#pp_homily_video',
            [ 'video' ],
            homiliesAdmin.chooserVideo,
            homiliesAdmin.buttonVideo
        );
    } );
})( jQuery );
