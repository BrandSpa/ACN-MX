
;(function( $, window, document ) {

	"use strict";

	var _doc = $( document ), 
		_win = $( window );
		
	var Hydrogen = window.hydrogen = window.hydrogen || {};

	$.extend( Hydrogen, {

		isHandheld: (function(a){return/(android|bb\d+|meego).+mobile|android|ipad|playbook|silk|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))})(navigator.userAgent||navigator.vendor||window.opera), 

		cssTransitions: (function(a,b){a=(new Image).style;b='ransition';return't'+b in a||'webkitT'+b in a||'MozT'+b in a})(), 

		cssAnimations: (function(a,b){a=(new Image).style;b='nimationName';return'a'+b in a||'webkitA'+b in a||'MozA'+b in a})(), 

		resizeCallbacks: [], 

		init: function() {
			
			/* ==========================================================================
				Add Mobile Device class
			============================================================================= */
			( ! Hydrogen.isHandheld ) && $( 'html' ).addClass( 'desktop' );

			/* ==========================================================================
				Setup Listeners
			============================================================================= */
			Hydrogen.setupListeners();

			/* ==========================================================================
				Wait for Document.Ready
			============================================================================= */
			$( Hydrogen.ready );

		}, 

		ready: function() {

			/* ==========================================================================
				Apply any patches/fixes
			============================================================================= */
			Hydrogen.applyPatches();

			/* ==========================================================================
				Add transition class
			============================================================================= */
			if( Hydrogen.cssTransitions ) {
				$( 'html' ).addClass( 'csstransitions' );
			}

			/* ==========================================================================
				Header
			============================================================================= */
			if( $.fn.affix && ! $( document.body ).hasClass( 'header-top-fixed' ) ) {
				$( '.site-header' ).each(function() {
					var header = $( this );
					header.find( '.header-inner' ).affix({
						offset: {
							top: function() {
								return $( '.site-body' ).offset().top - header.outerHeight() - 1;
							}
						}
					});
				});
			}
			
			/* ==========================================================================
				Navigation
			============================================================================= */
			_doc.on( 'click', '.main-nav .nav-toggle', function(e) {
				$( this ).siblings( 'ul.nav' ).slideToggle();
				e.preventDefault();
			}).on( 'click', '.main-nav .sub-toggle', function(e) {
				if( e.target == this ) {
					$( this ).toggleClass( 'open' ).closest( 'li' ).find( '>ul' ).slideToggle();
					e.stopPropagation();
					e.preventDefault();
				}
			});

			// Append sub-toggle to WPML language menu
			$( '.main-nav .nav > .menu-item-language-current > a' )
				.append( '<span class="sub-toggle"></span>' );

			Hydrogen.resizeCallbacks.push({
				callback: Hydrogen.closeMainNav
			});

			/* ==========================================================================
				ScrollSpy
			============================================================================= */
			if( $.fn.scrollspy ) {
				$( document.body ).scrollspy({
					target: '.main-nav', 
					offset: $( '.site-header' ).outerHeight() + 1
				});
			}

			/* ==========================================================================
				Splash Text Slider
			============================================================================= */
			if( $.fn.cycle ) {
				$( '.splash-slider' ).each(function() {
					var $t = $( this );

					$t.on( 'click', '.cycle-next,.cycle-prev', function() {
						var api = $t.data( 'cycle.API' );
						api && api.advanceSlide( $( this ).is( '.cycle-next' ) ? 1 : -1 );
					}).cycle( $.extend( true, $t.data(), {
						fx: ( Hydrogen.isHandheld || ! Hydrogen.cssTransitions ) ? 'fade' : 'none', 
						slides: '>.splash-content', 
						pauseOnHover: '.splash-text', 
						paused: true
					}));
				});
			}

			/* ==========================================================================
				Smooth Scrolling
			============================================================================= */
			_doc.on( 'click', '.brand a[href^="#"],.main-nav ul.nav a[href^="#"],.splash-text .splash-intro a[href^="#"]', function(e) {
				var href = $( this ).attr( 'href' ), 
					mainNav = $( this ).closest( '.main-nav' ), 
					target = ( '#' == href ) ? 0 : document.getElementById( href.split(/#/).pop() );

				if( null !== target ) {
					target = ( 0 == target ) ? 0 : $( target ).offset().top - $( '.site-header' ).outerHeight() + 1;
					if( Hydrogen.isHandheld ) {
						window.scrollTo( 0, target );
					} else {
						$( 'html,body' ).stop( true, true )
							.animate( { scrollTop: target }, 750 );
					}

					if( mainNav.length ) {
						Hydrogen.closeMainNav( mainNav );
					}
					e.preventDefault();
				}
			});

			/* ==========================================================================
				Parallax Sections
			============================================================================= */
			if( $.fn.parallax ) {

				if( Hydrogen.isHandheld ) {
					$( '[data-background][data-mode]' ).attr( 'data-mode', 'none' );
				}

				$( '[data-background]' ).parallax({
					lazyLoad: true, 
					mode: 'parallax', 
					activeClass: 'has-bg', 
					fixedBgClass: 'bg-fixed', 
					parallaxClass: 'bg-fixed', 
					speedFactor: 0.3
				});

			}

			/* ==========================================================================
				Touch Events
			============================================================================= */
			$( document ).on( 'touchstart', function(e) {
				$( '.touch' ).removeClass( 'touch' );
			}).on( 'touchstart', '.icon-box,.team,.media,.recent-post-body,.slider-media,.project-image', function(e) {
				$( '.touch' ).not( this ).removeClass( 'touch' );
				$( this ).toggleClass( 'touch' );
				e.stopPropagation();
			});

			/* ==========================================================================
				Counter Animation
			============================================================================= */
			if( 'function' == typeof countUp ) {
				$( '.counter' ).each(function() {
					var el = $( this ).find( '.number' ), counter, 
						duration = $( this ).data( 'duration' ) || 2, 
						decimals = $( this ).data( 'decimals' ) || 0, 
						options = {
							useGrouping: true, 
							separator: $( this ).data( 'opt-separator' ) || ',', 
							decimal: $( this ).data( 'opt-decimal' ) || '.'
						}, 
						countTo = parseInt( el.text() );

					if( el.length && $.isNumeric( countTo ) ) {
						el.html( 0 );
						counter = new countUp( el[0], 0, countTo, decimals, duration, options );
						el.waypoint(function() { counter.start(function() { counter = null; }); }, { offset: '75%', triggerOnce: true });
					}
				});
			}

			/* ==========================================================================
				Magnific Popup
			============================================================================= */
			if( $.fn.magnificPopup ) {
				$.each({
					'.media .mfp-zoom a': false, 
					'.royalSlider': '.slider-media .mfp-zoom a', 
					'.projects .items': '.mfp-zoom a'
				}, function( selector, delegate ) {
					$( selector ).each(function() {
						$( this ).magnificPopup({
							delegate: delegate, 
							type: 'image', 
							gallery: delegate ? { enabled: true } : false
						});
					});
				});
			}

			/* ==========================================================================
				Team Popup
			============================================================================= */
			if( $.fn.magnificPopup ) {
				var tpl = new Hogan.Template(function(c,p,i){var _=this;_.b(i=i||"");_.b("<div class=\"row\"><div class=\"col-md-12\"><h1 class=\"team-name\">");_.b(_.v(_.f("name",c,p,0)));if(_.s(_.f("role",c,p,1),c,p,0,79,102,"{{ }}")){_.rs(c,p,function(c,p,_){_.b("<small>");_.b(_.v(_.f("role",c,p,0)));_.b("</small>");});c.pop();}_.b("</h1></div></div><div class=\"row\">");if(_.s(_.f("photo",c,p,1),c,p,0,155,305,"{{ }}")){_.rs(c,p,function(c,p,_){_.b("<div class=\"col-md-4 col-md-push-8\"><figure class=\"team-photo\"><img src=\"");_.b(_.v(_.f("photo",c,p,0)));_.b("\" alt=\"");_.b(_.v(_.f("name",c,p,0)));_.b("\"></figure></div><div class=\"col-md-8 col-md-pull-4\">");});c.pop();}if(!_.s(_.f("photo",c,p,1),c,p,1,0,0,"")){_.b("<div class=\"col-md-12\">");};_.b("<div class=\"team-content\">");_.b(_.t(_.f("content",c,p,0)));_.b("</div></div></div>");return _.fl();;});

				_doc.on( 'click', '.team .team-photo a', function( e ) {

					var el = $( this ), 
						lastAddedClass = '', 
						team = el.closest( '.team' ), 
						teamContainer = team.closest( '.section-row' ), 
						teamCollection = teamContainer.find( '.team' ), 
						teamIndex = teamCollection.index( team ), 
						teamData = $.data( teamContainer[0], 'team-data' );

					if( ! teamData ) {
						teamData = teamCollection.map(function() {
							var data = $( this ).find( '.team-data' );
							if( data.length ) {
								return $.extend( true, {}, data.data(), { content: data.html() } );
							}
						}).get();

						$.data( teamContainer[0], 'team-data', teamData );
					}

					$.magnificPopup.open({
						items: teamData, 
						type: 'inline', 
						gallery: {
							enabled: true
						}, 
						inline: { markup: '<div class="team-popup"><div class="container"><div class="row"><div class="col-md-12"><div class="mfp-close"></div><div class="team-popup-content"></div></div></div></div></div>' }, 
						mainClass: 'team-popup-container' + ( teamData.theme ? ' ' + teamData.theme : '' ), 
						callbacks: {
							markupParse: function( template, values, item ) {
								template.find( '.team-popup-content' ).empty().html( tpl.render( values ) );
							}, 
							change: function( item ) {
								var targets = $( this.wrap ).add( this.bgOverlay );
								if( targets.length ) {
									targets.removeClass( lastAddedClass );
									if( typeof item.data !== 'undefined' && item.data.theme ) {
										targets.addClass( lastAddedClass = item.data.theme );
									}
								}
							}
						}
					}, Math.max( 0, teamIndex ) );

					e.preventDefault();
				});
			}

			/* ==========================================================================
				Twitter Feed
			============================================================================= */
			(function() {
				if( $.fn.miniTweets ) {

					var selectors = {
						'.tweet-slider': {

							template: [
								'<div class="tweet">', 
									'<span class="tweet_text"><%= text %></span>', 
									'<a class="tweet_time" href="<%= tweet_url %>"><%= relative_time %></a>', 
									'<a class="tweet_user" href="<%= user_url %>">@<%= user_screen_name %></a>', 
								'</div>'
							].join( '' ), 

							afterAppend: function( tweets ) {
								if( $.fn.owlCarousel ) {
									$( this ).addClass( 'owl-carousel' ).owlCarousel({
										singleItem: true, 
										autoHeight: true, 
										theme: 'hydrogen-theme', 
										navigationText: false
									});
								}
							}
						}, 
						'.tweet-list': {
							template: [
								'<div class="tweet-list-item">', 
									'<span class="tweet_text"><%= text %></span>', 
									'<a class="tweet_time" href="<%= tweet_url %>"><%= relative_time %></a>', 
								'</div>'
							].join( '' )
						}
					};

					$.each( selectors, function( selector, options ) {

						$( selector ).each(function() {

							var data = $( this ).data();

							if( data.hasOwnProperty( 'username' ) && data.hasOwnProperty( 'ajaxAction' ) ) {
								$( this ).miniTweets( $.extend( true, {
									entryPath: _hydrogen.ajaxUrl, 
									username: data.username, 
									count: data.count || 3, 
									userParams: {
										action: data.ajaxAction
									}
								}, options ));
							}
						});
					});

				}
			})();

			/* ==========================================================================
				Progressbar
			============================================================================= */
			if( $.fn.waypoint ) {
				$( '.progress' ).waypoint(function( direction ) {
					var value = $( this ).data( 'value' ) || 100;
					$( this ).find( '.progress-bar' ).css({ 'width': value + '%' });
				}, {
					triggerOnce: true, 
					offset: function() {
						return $.waypoints( 'viewportHeight' ) - 1;
					}
				});
			}

			/* ==========================================================================
				Placeholder
			============================================================================= */
			if( $.fn.placeholder ) {
				$( '[placeholder]' ).placeholder();
			}

			/* ==========================================================================
				Initialize Projects
			============================================================================= */
			if( Hydrogen.Project ) {

				(function() {
					var options = {};
					if( _hydrogen.hasOwnProperty( 'portfolio' ) ) {
						$.extend( options, {
							loader: {
								requestUrl: _hydrogen.ajaxUrl, 
								requestData: function() {
									var data = $( this ).data();
									var atts = $.extend( true, 
										_hydrogen.portfolio.defaults || {}, 
										data.portfolioAtts || {}
									);

									return {
										action: _hydrogen.portfolio.ajax_action, 
										params: $.extend( atts, {
											offset: ( $.data( this, 'project-page' ) || 1 ) * atts.posts_per_page
										})
									};
								}, 
								afterLoad: function() {
									var page = $.data( this, 'project-page' ) || 1;
									$.data( this, 'project-page', ++page );
								}
							}
						});
					}

					$( '.projects' ).each(function() {
						$.data( this, 'hydrogen-projects', new Hydrogen.Project( this, options ) );
					});
				})();
			}

			/* ==========================================================================
				Contextual Setups
			============================================================================= */
			Hydrogen.setup();

			/* ==========================================================================
				Fire initial window resize callbacks
			============================================================================= */
			_win.triggerHandler( 'resize' );

		}, 

		setupListeners: function() {

			/* ==========================================================================
				Monitor Document Height Changes
			============================================================================= */
			(function( callback ) {
				var db = document.body, 
					dd = document.documentElement, 
					docHeight = Math.max(
						db.scrollHeight, dd.scrollHeight,
						db.offsetHeight, dd.offsetHeight,
						db.clientHeight, dd.clientHeight
					);

				function domChangeListener() {
					var currDocHeight = Math.max(
						db.scrollHeight, dd.scrollHeight,
						db.offsetHeight, dd.offsetHeight,
						db.clientHeight, dd.clientHeight
					);

					if( currDocHeight != docHeight ) {
						docHeight = currDocHeight;
						callback();
					}
					setTimeout( domChangeListener, 1000 );
				}

				domChangeListener();
			})( Hydrogen.onDocHeightChange );

			/* ==========================================================================
				Window.Resize
			============================================================================= */
			var resizeTimer, n;
			_win.on( 'resize orientationchange', function() {
				if( resizeTimer ) clearTimeout( resizeTimer );
				resizeTimer = setTimeout(function() {
					for( n = 0; n < Hydrogen.resizeCallbacks.length; n++ ) {
						var cb = Hydrogen.resizeCallbacks[n];
						'function' == typeof cb.callback && cb.callback.apply( cb.context || window );
					}
				}, 50);
			});
		}, 

		setup: function( context ) {
			context = $( context );

			if( ! context.length )
				context = $( document.body );

			/* ==========================================================================
				Tooltips
			============================================================================= */
			if( $.fn.tooltip ) {
				context.find( '[rel="tooltip"]' ).tooltip();
			}

			/* ==========================================================================
				Carousels
			============================================================================= */
			if( $.fn.owlCarousel ) {
				context.find( '.owl-carousel' ).each(function() {
					$( this ).owlCarousel( $.extend( true, {}, {
						items: 3, 
						itemsDesktop: [1199,3], 
						itemsDesktopSmall: [991,2], 
						itemsTablet: [767,1], 
						itemsMobile: false, 
						itemsScaleUp: true, 
						theme: 'hydrogen-theme', 
						navigationText: false, 
						paginationNumbers: false, 
						afterUpdate: function( el ) {
							el.find( '.royalSlider' ).each(function() {
								var api = $( this ).data( 'royalSlider' );
								api && api.updateSliderSize();
							});
						}
					}, $( this ).data() ));
				});
			}

			/* ==========================================================================
				Royal Slider
			============================================================================= */
			if( $.fn.royalSlider ) {
				(function() {
					var defaults = {
						addActiveClass: true, 
						imageScalePadding: 0, 
						slidesSpacing: 0, 
						fadeinLoadedSlide: false
					}, 
					options = {
						'.iphone-slider .royalSlider': {
							options: {
								imageScaleMode: 'fill'
							}, 
							mandatoryOptions: {
								controlNavigation: 'none'
							}
						}, 
						'.ipad-slider .royalSlider': {
							options: {
								imageScaleMode: 'fill'
							}, 
							mandatoryOptions: {
								controlNavigation: 'none'
							}
						}, 
						'.macbook-slider .royalSlider': {
							options: {
								imageScaleMode: 'fill'
							}, 
							mandatoryOptions: {
								controlNavigation: 'none'
							}
						}, 
						'.recent-post-media .royalSlider': {
							options: {
								navigateByClick: false, 
								controlNavigation: 'none', 
								imageScaleMode: 'fill'
							}, 
							mandatoryOptions: {
								sliderDrag: false, 
								sliderTouch: false
							}
						}, 
						'.standard-slider .royalSlider': {
							options: {
								controlNavigation: 'none', 
								imageScaleMode: 'fill'
							}
						}, 
						'.nearby-slider .royalSlider': {
							options: {
								keyboardNavEnabled: true, 
								imageScaleMode: 'fill', 
								visibleNearby: {
									enabled: true, 
									centerArea: 0.5, 
									center: true, 
									breakpoint: 992, 
									breakpointCenterArea: 0.7, 
									navigateByCenterClick: true
								}
							}
						}
					}, 
					royalSliders = context.find( '.royalSlider' );

					$.each( options, function( filter, opt ) {
						royalSliders = royalSliders
							.filter( filter )
								.each(function() {
									if( 'function' == typeof opt.beforeInit ) {
										opt.beforeInit.apply( this );
									}
									$( this ).royalSlider( $.extend( true, {}, defaults, opt.options, $( this ).data(), opt.mandatoryOptions ));
									if( 'function' == typeof opt.afterInit ) {
										opt.afterInit.apply( this );
									}
								})
								.end()
							.not( filter );
					});

					royalSliders.each(function() {
						$( this ).royalSlider( $( this ).data() );
					});
				})();
			}

			/* ==========================================================================
				Justified Grids Photoset
			============================================================================= */
			if( $.fn.justifiedGrids ) {
				context.find( '.photoset' ).each(function() {
					$( this ).imagesLoaded(function() {
						$( this ).addClass( 'loaded' ).justifiedGrids({
							selector: '.photo', 
							margin: 10, 
							minRowHeight: 240
						});
					});
				});
			}
		}, 

		teardown: function( context ) {
			context = $( context );

			if( ! context.length )
				context = $( document.body );

			/* ==========================================================================
				Tooltips
			============================================================================= */
			if( $.fn.tooltip ) {
				context.find( '[rel="tooltip"]' ).tooltip( 'destroy' );
			}
						
			/* ==========================================================================
				Owl Carousel
			============================================================================= */
			if( $.fn.owlCarousel ) {
				context.find( '.owl-carousel' ).each(function() {
					var api = $( this ).data( 'owlCarousel' );
					api && api.destroy();
				});
			}

			/* ==========================================================================
				Royal Slider
			============================================================================= */
			if( $.fn.royalSlider ) {
				context.find( '.royalSlider' ).each(function() {
					var api = $( this ).data( 'royalSlider' );
					api && api.destroy();
				});
			}

			/* ==========================================================================
				Justified Grids Photoset
			============================================================================= */
			if( $.fn.justifiedGrids ) {
				context.find( '.photoset' ).justifiedGrids( 'destroy' );
			}

		}, 

		windowLoad: function() {
			/* ==========================================================================
				Remove Site Loader
			============================================================================= */
			$( '.site-loader' ).remove();

			/* ==========================================================================
				Resume Splash Slider
			============================================================================= */
			$( '.splash-slider' ).each(function() {
				var api = $( this ).data( 'cycle.API' );
				api && api.resume();
			});

			/* ==========================================================================
				Waypoints Entry Animation
			============================================================================= */
			if( ! Hydrogen.isHandheld && Hydrogen.cssAnimations && $.fn.youxiAnimate ) {
				$( '.section-row .row' ).filter(function() {
					// Prevent nested row animations
					return $( this ).parents( '.row' ).length == 0;
				}).youxiAnimate();
			}
		}, 

		onDocHeightChange: function() {
			if( $.fn.scrollspy ) {
				$( document.body ).scrollspy( 'refresh' );
			}

			if( $.waypoints ) {
				$.waypoints( 'refresh' );
			}

			if( $.fn.parallax ) {
				$( '[data-background]' ).parallax( 'refresh' );
			}
		}, 

		closeMainNav: function( mainNav ) {
			( mainNav && mainNav.length ? mainNav : $( '.main-nav' ) )
				.find( 'ul' ).css( 'display', '' )
				.find( '.sub-toggle' ).removeClass( 'open' );
		}, 

		applyPatches: function() {

			/* ==========================================================================
				MediaElementJS Patches
			============================================================================= */
			if( typeof mejs !== 'undefined' && mejs.version && $.fn.mediaelementplayer ) {

				(function() {
					var mejsShimCreate = mejs.HtmlMediaElementShim.create;
					mejs.HtmlMediaElementShim.create = function(el, o) {
						var pluginMediaElement = mejsShimCreate.apply( mejs.HtmlMediaElementShim, arguments );

						// Vimeo video bug fix
						if( typeof pluginMediaElement.vimeoid !== 'undefined' && typeof $f == 'function' ) {
							var container = document.getElementById( 'me_vimeo_' + ( mejs.meIndex - 1 ) + '_container' );
							if( !! ( container && container.nodeType === 1 ) ) {
								pluginMediaElement.pluginElement = container;
							}
						}

						return pluginMediaElement;
					};

					var mejsSetPlayerSize = mejs.MediaElementPlayer.prototype.setPlayerSize;
					mejs.MediaElementPlayer.prototype.setPlayerSize = function( width, height ) {
						var t = this, 
							videoWrap = t.container.closest( '.aligned-video-wrapper' ), 
							wrapContainer = videoWrap.parent();

						if( t.isVideo && videoWrap.length && wrapContainer.length ) {

							var nativeWidth = (t.media.videoWidth && t.media.videoWidth > 0) ? t.media.videoWidth : t.options.defaultVideoWidth, 
								nativeHeight = (t.media.videoHeight && t.media.videoHeight > 0) ? t.media.videoHeight : t.options.defaultVideoHeight, 
								nativeRatio = nativeWidth / nativeHeight, 
								videoWrapWidth = wrapContainer.outerWidth(), 
								videoWrapHeight = wrapContainer.outerHeight(), 
								css = { width: '100%', height: '100%', marginTop: 'auto', marginLeft: 'auto' };

							if( nativeRatio > videoWrapWidth / videoWrapHeight ) {
								css.width = Math.round( nativeRatio * videoWrapHeight );
								css.marginLeft = ( videoWrapWidth - css.width ) / 2;
							} else {
								css.height = Math.round( videoWrapWidth / nativeRatio );
								css.marginTop = ( videoWrapHeight - css.height ) / 2;
							}

							videoWrap.css( css );
						}

						mejsSetPlayerSize.apply( t, arguments );
					};
				})();

				(function( oldFn ) {
					$.fn.mediaelementplayer = function( options ) {
						if( false == options ) {
							oldFn.apply( this, arguments );
						} else {
							var backgrounds = this.filter( '.wp-video-shortcode' )
								// Fix wp-video-shortcode size
								.css({ width: '100%', height: '100%' })
								// Unwrap videos wrapped in those damned .wp-video
								.filter( '.wp-video>.wp-video-shortcode' )
									.unwrap()
									.end()
								// Filter all background videos and return them
								.filter( '.splash-media-video .wp-video-shortcode,.section-media-video .wp-video-shortcode' );

							// Extended arguments for background and splash videos
							if( backgrounds.length ) {
								oldFn.call( backgrounds, $.extend({}, options, {
									enableKeyboard: false, 
									features: [], 
									pauseOtherPlayers: false, 
									success: function( media ) {
										media.addEventListener( 'playing', function() {
											if( 'vimeo' !== media.pluginType ) {
												media.setMuted( true );
											}
										}, false);
										media.play();
										options.success && options.success.apply( this, arguments );
									}
								}));
							}

							// The rest gets the default arguments
							oldFn.apply( this.not( backgrounds ), arguments );
						}

						return this;
					};
				})( $.fn.mediaelementplayer );
			}
		}
	});

	Hydrogen.init();

	/* ==========================================================================
		Window.Load
	============================================================================= */
	_win.load( Hydrogen.windowLoad );

	/* EOF */

}) ( jQuery, window, document );