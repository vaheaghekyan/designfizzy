( function( $ ) {
	"use strict";
    $( function() {
        $.fn.ease = function( options ) {
            var selector = $( this ).selector; // Get the selector
            // Set default options
            var defaults = {
                'preview' : '.preview-upload',
                'button'  : '.button-upload',
				'text'    : '.text-upload',
				'remove'  : '.button-remove',
            };

            var options  = $.extend( defaults, options );
            // When the Button is clicked...
            $( options.button ).click( function() {
                // Get the Text element.
			
				var remove = $( this ).siblings( options.remove );
				var preview = $( this ).siblings( options.preview );
				var text = $( this ).siblings( options.text );

                // Show WP Media Uploader popup
                tb_show( 'Upload a logo', 'media-upload.php?referer=options_page&type=image&TB_iframe=true&post_id=0', false );

                // Re-define the global function 'send_to_editor'
                // Define where the new value will be sent to
                window.send_to_editor = function( html ) {
                    // Get the URL of new image

                    var src = $(html).prop('src');

                    // Send this value to the Text field.
					preview.attr( 'src', src ).trigger( 'change' );
					text.attr( 'value', src ).trigger( 'change' );
					
					preview.attr( 'style' , 'display:block;')
                    tb_remove(); // Then close the popup window
					remove.attr ( 'style' , 'display:block' );
					remove.attr ( 'value' , 'Remove' );					
                }				

                return false;
            } );

            $( options.text ).bind( 'change', function() {

                // Get the value of current object

                var url = this.value;
                // Determine the Preview field
                var preview = $( this ).siblings( options.preview );

                // Bind the value to Preview field
                $( preview ).attr( 'src', url );
				
            } ); 
            $( options.remove ).click( function() {				

				var preview = $( this ).siblings( options.preview );
				var text = $( this ).siblings( options.text );
				
                $( preview ).attr( 'src', '' );
				$( preview ).attr( 'style', 'display:none;' );
				
                $( text ).attr( 'value', '' );
				$( this ).attr( 'style',' display:none; ' );
				$( this ).attr( 'value','' );				

            });
        }

        // Usage
        $( '.upload' ).ease(); // Use as default option.

    } );
} ( jQuery ) );