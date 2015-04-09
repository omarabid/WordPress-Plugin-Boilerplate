;
( function( $ ) {
	$( document ).ready( function() {
		$( '.dismiss-notice' ).each( function( i, dismiss ) {
			var $dismiss = $( dismiss );	
			var $notice = $dismiss.parent();

			$dismiss.on( 'click', function() {
				// Hide the notification
				$notice.slideUp();	

				// Send an AJAX request to the backend to disable the notification
				var req = {
					action: 'dismiss_notification',
					namespace: $dismiss.data( 'namespace' ),
					id: $dismiss.data( 'noticeid' )
				};

				$.post( ajaxurl, req, function( data ) {
					// nothing to do here
				} );
			} );
		} );
	} );
} )( jQuery );
