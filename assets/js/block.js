(function( wp ) {
    const { registerBlockType } = wp.blocks;
    const { __ } = wp.i18n;
    const { InspectorControls } = wp.blockEditor || wp.editor;
    const { PanelBody, TextControl } = wp.components;
    const { Fragment, createElement: el } = wp.element;

    registerBlockType( 'parishpress/homilies', {
        title: __( 'Modern Catholic – Parish Homilies', 'parishpress-homilies' ),
        icon: 'microphone',
        category: 'widgets',
        attributes: {
            limit: { type: 'number', default: 5 },
        },
        edit: function( props ) {
            const { attributes: { limit }, setAttributes } = props;
            const limitValue = Number.isFinite( limit ) ? limit : 5;

            return el(
                Fragment,
                null,
                el(
                    InspectorControls,
                    null,
                    el(
                        PanelBody,
                        { title: __( 'Settings', 'parishpress-homilies' ) },
                        el( TextControl, {
                            label: __( 'Number to show', 'parishpress-homilies' ),
                            type: 'number',
                            min: 1,
                            value: limitValue,
                            onChange: ( value ) => setAttributes( { limit: Math.max( 1, parseInt( value, 10 ) || 5 ) } ),
                        } )
                    )
                ),
                el(
                    'div',
                    { className: 'parishpress-block-placeholder' },
                    el( 'strong', null, __( 'Modern Catholic – Parish Homilies', 'parishpress-homilies' ) ),
                    el( 'div', null, __( 'Displays recent homilies.', 'parishpress-homilies' ) ),
                    el( 'div', null, __( 'Limit', 'parishpress-homilies' ), ': ', limitValue )
                )
            );
        },
        save: function() {
            return null;
        },
    } );
})( window.wp );
