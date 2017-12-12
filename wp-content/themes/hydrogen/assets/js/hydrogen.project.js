
;(function( $, window, document ) {

	"use strict";

	var _doc = $( document ), _win = $( window );
	var Hydrogen = window.hydrogen = window.hydrogen || {};

	$.extend( Hydrogen, {

		Project: function( element, options ) {
			this.element = $( element );
			return this.init( options );
		}
	});

	Hydrogen.Project.PopupControls = $([
		'<div class="project-controls">', 
			'<ul>', 
				'<li><button class="mfp-prevent-close" data-action="prev"><i class="mfp-prevent-close fa fa-arrow-left"></i></button></li>', 
				'<li><button data-action="close"><i class="fa fa-times"></i></button></li>', 
				'<li><button class="mfp-prevent-close" data-action="next"><i class="mfp-prevent-close fa fa-arrow-right"></i></button></li>', 
			'</ul>', 
		'</div>'
	].join( '' ));

	Hydrogen.Project.prototype = {

		defaults: {
			loader: {
				requestUrl: null, 
				requestData: {}, 
				afterLoad: $.noop
			}
		}, 

		init: function( options ) {

			this.options = $.extend( true, {}, this.defaults, options );

			this.element.imagesLoaded( $.proxy( function() {

				this.element.addClass( 'loaded' );

				this.initializeLayout();
				this.bindHandlers();

			}, this ));
		}, 

		initializeLayout: function() {

			this.element.find( '.items' ).isotope({
				masonry: {
					columnSize: '.grid-sizer', 
					gutter: '.gutter-sizer'
				}, 
				itemSelector: '.project', 
				transitionDuration: '0.5s'
			});
		}, 

		bindHandlers: function() {

			var t = this;

			this.element.on( 'click', '.filter a[data-filter]', function( e ) {

				$( this )
					.closest( 'li' ).addClass( 'active' )
					.siblings().removeClass( 'active' );

				t.element
					.find( '.items' ).isotope({ filter: $( this ).data( 'filter' ) })
					.end()
					.find( '.filter .active-label' ).html( this.innerHTML );

				e.preventDefault();

			}).on( 'click', '.project .actions .mfp-details.is-ajax > a, .project .project-image > a.is-ajax', function( e ) {

				var currentProject = $( this ).closest( '.project' ), 
					projectCollection = currentProject.siblings( '.project' ).addBack().filter(function() {
						return !! $( this ).find( '.actions .mfp-details.is-ajax > a, .project-image > a.is-ajax' ).length;
					}), 
					projectIndex = projectCollection.index( currentProject );

				t.openProjectPopup( t.getProjectUrls( projectCollection ), projectIndex );
				
				e.preventDefault();

			}).on( 'click', '.project-load-more a', function( e ) {

				if( t.options.loader.requestUrl ) {

					var loader = $( this ).closest( '.project-load-more' ), 
						requestData = $.isFunction( t.options.loader.requestData ) ? t.options.loader.requestData.apply( t.element[0] ) : t.options.loader.requestData, 
						afterLoad = t.options.loader.afterLoad;

					$.getJSON( t.options.loader.requestUrl, requestData, function( response ) {

						switch( response.status ) {
							case 'finished':
								loader.remove();
							case 'success':
								t.appendProjectItems( $( response.html ).find( '.items .project' ), afterLoad );
								break;
							case 'error':
								console.log( response.message );
								break;
						}
					});
				}

				e.preventDefault();
			});
		}, 

		appendProjectItems: function( items, afterLoad ) {

			var t = this;
			if( items && items.length ) {

				t.element.find( '.items' ).append( items.hide() ).imagesLoaded(function() {

					$( this ).isotope( 'insert', items.show() );

					if( $.isFunction( afterLoad ) ) {
						afterLoad.apply( t.element[0] );
					}
				});
			}
		}, 

		openProjectPopup: function( urls, index ) {
			
			if( urls.length ) {

				var t = this;

				if( $.fn.mfpFastClick && ! Hydrogen.Project.hasFastClick ) {

					Hydrogen.Project.hasFastClick = true;
					Hydrogen.Project.PopupControls.find( 'button' ).each(function() {
						var callback = $.magnificPopup.instance[ $( this ).data( 'action' ) ];
						( 'function' == typeof callback ) && $( this ).mfpFastClick( callback );
					});
				}

				$.magnificPopup.open({
					items: urls, 
					type: 'ajax', 
					gallery: {
						enabled: true, 
						arrows: false
					}, 
					ajax: {
						settings: {
							cache: false
						}
					}, 
					alignTop: true, 
					showCloseBtn: false, 
					mainClass: 'project-details-popup', 
					callbacks: {
						open: function() {
							_doc.off( 'keydown.mfp-gallery' );
						}, 
						parseAjax: function( response ) {
							var data = $( response.data ).find( '.section.project-details' ).first();
							if( data.length ) {
								data.find( '.project-title' ).before( Hydrogen.Project.PopupControls );
								response.data = data;
							} else {
								response.data = '';
							}
						}, 
						ajaxContentAdded: t.initPopup, 
						beforeChange: t.teardownPopup, 
						beforeClose: t.teardownPopup
					}
				}, Math.max( 0, index ) );
			}
		}, 

		getProjectUrls: function( projects ) {
			return projects.map(function() {
				var href, actionLink = $( this ).find( '.actions .mfp-details.is-ajax > a, .project-image > a.is-ajax' );
				if( actionLink.length ) {
					href = actionLink.attr( 'href' );
					if( href && href != '#' ) {
						return {
							type: 'ajax', 
							src: href
						};
					}
				}
			}).get();
		}, 

		initPopup: function() {
			if( this.content && $.isFunction( Hydrogen.setup ) ) {
				Hydrogen.setup( this.content );
			}
		}, 

		teardownPopup: function() {
			if( this.content && $.isFunction( Hydrogen.teardown ) ) {
				Hydrogen.teardown( this.content );
			}
			Hydrogen.Project.PopupControls.detach();
		}
	};

	/* EOF */

}) ( jQuery, window, document );