
;(function( wp, $ ) {

	"use strict";

	var api = wp.customize, 
		gallery = wp.media && wp.media.gallery;

	if( api && gallery ) {

		api.Youxi = api.Youxi || {};
		api.Youxi.GalleryControl = api.Control.extend({

			ids: function() {
				var attachments = this.setting();
				if( attachments && attachments.length ) {
					return ' ids="' + attachments.join( ',' ) + '"';
				}
				return '';
			}, 

			createView: function( attachments ) {
				return attachments.map(function( attachment ) {
					var src = this.attachmentSize( attachment, 'thumbnail' ).url;
					return $( '<div />' ).append( $( '<img />' ).attr( 'src', src ) );
				}, this );
			}, 

			open: function( event ) {
				if ( api.utils.isKeydownButNotEnterEvent( event ) ) {
					return;
				}

				event.preventDefault();

				var frame = gallery.edit( '[gallery' + this.ids() + ']' );

				frame.state( 'gallery-edit' ).on( 'update', this.update );
				frame.on( 'close', function() { frame.detach(); } );
			}, 

			update: function( attachments ) {

				var control = this, ids, opts;

				ids = attachments.pluck( 'id' );

				opts = _.map( ids, function( id ) {
					return $( '<option />' ).val( id ).text( id ).prop( 'selected', true );
				}, control );

				/* Append items */
				control.dropdown.html( opts );

				/* Append thumbnails */
				control.view.html( control.createView( attachments ) );

				/* Show clear button */
				control.clearBtn.show();

				/* Set control value */
				control.setting.set( control.dropdown.val() );
			}, 

			clear: function( event ) {
				if ( api.utils.isKeydownButNotEnterEvent( event ) ) {
					return;
				}

				var control = this;

				event.preventDefault();

				control.dropdown.empty();
				control.view.empty();
				control.clearBtn.hide();

				control.setting.set( [] );
			}, 

			attachmentSize: function( attachment, size ) {
				var sizes = attachment.attributes.sizes || {};

				if( _.has( sizes, size ) ) {
					return _.pick( sizes[ size ], 'url' );
				}
				return { url: attachment.url };
			}, 

			ready: function() {

				var control = this;

				control.dropdown = control.container.find( '.youxi-gallery-control-dropdown' ).hide();
				control.view     = control.container.find( '.youxi-gallery-control-view' );
				control.clearBtn = control.container.find( '.youxi-gallery-control-clear' );

				_.bindAll( control, 'open', 'update', 'clear' );

				control.view.on( 'click keydown', control.open );
				control.clearBtn.on( 'click keydown', control.clear );
			}
		});

		$.extend( api.controlConstructor, { youxi_gallery: api.Youxi.GalleryControl });
	}

})( window.wp, jQuery );