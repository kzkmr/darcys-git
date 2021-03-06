jQuery( document ).ready(function()
{
	var percentage = jQuery( '#wp-admin-bar-autoptimize-cache-info .autoptimize-radial-bar' ).attr('percentage');
	var rotate = percentage * 1.8;

	jQuery( '#wp-admin-bar-autoptimize-cache-info .autoptimize-radial-bar .mask.full, #wp-admin-bar-autoptimize-cache-info .autoptimize-radial-bar .fill' ).css({
		'-webkit-transform' : 'rotate(' + rotate + 'deg)',
		'-ms-transform'     : 'rotate(' + rotate + 'deg)',
		'transform'         : 'rotate(' + rotate + 'deg)'
	});

	// Fix Background color of circle percentage & delete cache to fit with the current color theme
	jQuery( '#wp-admin-bar-autoptimize-cache-info .autoptimize-radial-bar .inset' ).css( 'background-color',  jQuery( '#wp-admin-bar-autoptimize .ab-sub-wrapper' ).css( 'background-color') );
	jQuery( '#wp-admin-bar-autoptimize-delete-cache .ab-item' ).css( 'background-color',  jQuery( '#wpadminbar' ).css( 'background-color') );

	jQuery( '#wp-admin-bar-autoptimize-default li' ).on('click', function(e)
	{
		var id = ( typeof e.target.id != 'undefined' && e.target.id ) ? e.target.id : jQuery( e.target ).parent( 'li' ).attr( 'id' );
		var action = '';

		if( id == 'wp-admin-bar-autoptimize-delete-cache' ){
			action = 'autoptimize_delete_cache';
		} else {
			return;
		}

		// Remove the class "hover" from drop-down Autoptimize menu to hide it.
		jQuery( '#wp-admin-bar-autoptimize' ).removeClass( 'hover' );

		// Create and Show the Autoptimize Loading Modal
		var modal_loading = jQuery( '<div class="autoptimize-loading"></div>' ).appendTo( 'body' ).show();

		var success = function() {
			// Reset output values & class names of cache info
			jQuery( '#wp-admin-bar-autoptimize-cache-info .size' ).attr( 'class', 'size green' ).html( '0.00 B' );
			jQuery( '#wp-admin-bar-autoptimize-cache-info .files' ).html( '0' );
			jQuery( '#wp-admin-bar-autoptimize-cache-info .percentage .numbers' ).attr( 'class', 'numbers green' ).html( '0%' );
			jQuery( '#wp-admin-bar-autoptimize-cache-info .autoptimize-radial-bar .fill' ).attr( 'class', 'fill bg-green' );

			// Reset the class names of bullet icon
			jQuery( '#wp-admin-bar-autoptimize' ).attr( 'class', 'menupop bullet-green' );

			// Reset the Radial Bar progress
			jQuery( '#wp-admin-bar-autoptimize-cache-info .autoptimize-radial-bar .mask.full, #wp-admin-bar-autoptimize-cache-info .autoptimize-radial-bar .fill' ).css({
				'-webkit-transform'    : 'rotate(0deg)',
				'-ms-transform'        : 'rotate(0deg)',
				'transform'            : 'rotate(0deg)'
			});
		};

		var notice = function() {
			jQuery( '<div id="ao-delete-cache-timeout" class="notice notice-error is-dismissible"><p><strong><span style="display:block;clear:both;">' + autoptimize_ajax_object.error_msg + '</span></strong></p><button type="button" class="notice-dismiss"><span class="screen-reader-text">' +  autoptimize_ajax_object.dismiss_msg + '</span></button></div><br>' ).insertAfter( '#wpbody .wrap h1:first-of-type' ).show();
		};

		jQuery.ajax({
			type     : 'GET',
			url      : autoptimize_ajax_object.ajaxurl,
			data     : {'action':action, 'nonce':autoptimize_ajax_object.nonce},
			dataType : 'json',
			cache    : false,
			timeout  : 9000,
			success  : function( cleared )
			{
				// Remove the Autoptimize Loading Modal
				modal_loading.remove();
				if ( cleared ) {
					success();
				} else {
					notice();
				}
			},
			error: function( jqXHR, textStatus )
			{
				// Remove the Autoptimize Loading Modal
				modal_loading.remove();

				// WordPress Admin Notice
				notice();
			}
		});
	});
});
