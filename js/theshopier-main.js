
(function($) {
	"use strict";
	
	$.fn.theshopier_block = function( options ){
		var defaults = {
			message: null,
			overlayCSS: {
				background: "#fff url("+theshopier_data.loading_icon+") no-repeat center"
			}
		}
		var opts = $.extend( {}, defaults, options );
		return this.each(function() {
			var elem = $( this );
			elem.block(opts);
		});
	};
	
	$.fn.updateMegaMenuPosition = function(){
		var i = Math.round(($(this).parent().outerWidth() - $(this).outerWidth())/2);
		if($(this).parents('.container').length > 0) {
			var off_left = Math.round($(this).parents('.container').offset().left);
			var off_right = Math.round(off_left + $(this).parents('.container').width());
			var left_ed = false;
			if( $(this).parent().offset().left + i - off_left < 3 ) {
				i = 15 - $(this).parent().offset().left + off_left;
				left_ed = true;
			}
			
			if( !left_ed && $(this).parent().offset().left + $(this).outerWidth() + i > off_right ) {
				var over_right = Math.round($(this).parent().offset().left - i - off_right);
				i = i - over_right - $(this).parent().width() - 30;
			}
			
			
			if( $(this).parent('li').hasClass( 'menu-item-level-0' ) ) {
				$(this).css('left', i + 'px');
			} else {
				if( $(this).parent().offset().left + $(this).parent().outerWidth() + $(this).outerWidth() + i >  off_right ) {
					$(this).addClass( 'nth-pos-left' );
					$(this).find('ul.sub-menu:not(.nth-pos-left)').addClass('nth-pos-left');
				}
				
				if($(this).parent('li').offset().left-$(this).outerWidth()-off_left<10 && $(this).hasClass('nth-pos-left')) {
					$(this).removeClass('nth-pos-left');
				}
			}
		}		
		
	};
	
	var NTH = {
		initialized: false,
		prodInfo: {
			timeout: {
				obj: false,
				time: 2000,
				fIn: 'zoomInRight',
				fOut: 'zoomOutRight'
			}
		},
		initialize: function(){
			if (this.initialized) return;
			this.initialized = true;
			this.build();
			NTH.events();
		},
		data: {
			shortcode: {
				product_tab: []
			},
			shop_dropText: $('.nth-toolbar-popup-cotent .shop-cart-dropable-box').text(),
			touchDevice: $.support.touch? 1 : 0,
		},
		build: function(){
			NTH.dropDragProduct();
			NTH.headerSticky(0);
			NTH.megaMenu();
			//NTH.applyTooltip();
		},
		events: function(){
			NTH.eventsGeneral();
			NTH.ajax_response();
			NTH.shortcodeEvents();
			NTH.windowResize();
			NTH.quickShop();
			NTH.countdowns();
			NTH.prodSingleThumbEvent();
			NTH.owlCarousel2_event();
			NTH.compareLink();
			NTH.isotope();
			NTH.formPopup();
			NTH.toggleWidgetCategories();
			NTH.ajaxLogin();
			NTH.appearAnimated();
			NTH.paceLoader();
			NTH.fix_VC_FullWidth();
			NTH.updated_wc_div();
			NTH.prodSingleImageEvent();
		},
		headerSticky: function( update ){
			
			if( $.support.touch ) return false;
			
			if( update == 1 ) {
				$('#header .nth-sticky').sticky('unstick');
			}
			
			var wpbar_top = $('#wpadminbar').length > 0 ? $('#wpadminbar').height(): 0;
			
			$('#header .nth-sticky').sticky({topSpacing: wpbar_top})
				.on('sticky-start', function(){
					$(this).find('.vertical-menu-wrapper.toggle-homepage').removeClass('active');
				})
				.on('sticky-end', function(){
					$(this).find('.vertical-menu-wrapper.toggle-homepage').addClass('active');
				});

			
		},
		megaMenu: function(){
			/*$('.main-menu ul.menu > li ul.sub-menu').each(function(e,i){
				$(this).updateMegaMenuPosition();
			});*/
			$('.main-menu ul.menu li').on('hover', function(){
				if($(this).find('> ul.sub-menu').length > 0)
					$(this).find('> ul.sub-menu').updateMegaMenuPosition();
			});
		},
		updateQuantityButton: function(){
			$( 'div.quantity:not(.buttons_added)' )
				.addClass('buttons_added')
				.prepend('<input type="button" value="-" class="minus" />')
				.append('<input type="button" value="+" class="plus" />');
		},
		applyTooltip: function(){
			if( NTH.data.touchDevice ) return false;
			$('#main-content-wrapper button[title], #main-content-wrapper a.button[title], #main-content-wrapper a.btn[title]').attr('data-toggle', 'tooltip');
		},
		eventsGeneral: function(){
			$('[data-toggle="tooltip"]').tooltip();
			$('.widget_categories ul > li.cat-item ul').each( function( index ){
				$(this).parent().addClass( 'cat-parent' );
			} );
			$( '.shortcode-woo-tabs li.tab-item' ).on( 'click', function( e ){
				if( $(this).hasClass('active') ) return false;
				var _id = $(this).find( 'a' ).data('id');
				$(this).parent().find('.active').removeClass('active');
				$(this).addClass('active');
				$('#'+_id).parent().find('.show').removeClass('show').addClass('hidden');
				$('#'+_id).removeClass('hidden').addClass('show');
			} );
			
			$('.nth-phone-menu-icon').on('click', function(){
				$('.nth-menu-wrapper .main-menu.pc-menu').removeClass('pc-menu').addClass('mb-menu');
				$('.nth-menu-wrapper .main-menu.mb-menu').toggleClass('fadeInDown');
				$('.nth-menu-wrapper').toggleClass('hidden-xs');
				$(this).toggleClass('active');
			});
			
			NTH.updateQuantityButton();
			
			$(document).on( 'click', '.quantity .plus, .quantity .minus', function(e){
				
				//get value
				var $qty		= $(this).closest( '.quantity' ).find( '.qty' ),
					currentVal	= parseFloat( $qty.val() || 0 ),
					max			= parseFloat( $qty.attr( 'max' ) || 0 ),
					min			= parseFloat( $qty.attr( 'min' ) || 0 ),
					step		= parseFloat( $qty.attr( 'step' ) || 1 );
				
				// Format values
				if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
				if ( max === '' || max === 'NaN' ) max = '';
				if ( min === '' || min === 'NaN' ) min = 0;
				if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;
				
				// Change the value		
				if ( $( this ).is( '.plus' ) ) {
					if ( max && ( max == currentVal || currentVal > max ) ) {
						$qty.val( max );
					} else {
						$qty.val( currentVal + parseFloat( step ) );
					}
				} else {
					if ( min && ( min == currentVal || currentVal < min ) ) {
						$qty.val( min );
					} else if ( currentVal > 0 ) {
						$qty.val( currentVal - parseFloat( step ) );
					}
				}
				
				// Trigger change event
				$qty.trigger( 'change' );
			} );

			/* Quantity sync */
			$(document).on('change', 'form.cart input.qty', function() {
				$(this.form).find('button[data-quantity]').data('quantity', this.value);
			});
			
			if( $('.vertical-menu-inner ul.menu').length > 0 ) {
				//var verti_height = $('.vertical-menu-inner').height();
				//$('.vertical-menu-inner ul.menu > li > ul.sub-menu').height(verti_height + 2);
			}
			
			$('.vertical-menu-inner.submenu_height_fixed > ul.menu > li').on('hover',function(){
				var verti_height = $(this).parents('.vertical-menu-inner').height();
				$(this).children('ul.sub-menu').outerHeight(verti_height);
			});
			
			$('.yith-wcwl-add-button.show').on('click', function(){
				$(this).addClass('loading');
			});

			$( '.woocommerce-ordering' ).on( 'change', 'select.per_show', function() {
				$( this ).closest( 'form' ).submit();
			});

			$('#header .nth_header_bottom').on("click", '.vertical-menu-wrapper .vertical-menu-dropdown', function(){
				$(this).parents('.vertical-menu-wrapper').toggleClass("active");
			});

			$('ul.menu > li').on('hover', function () {
				NTH.owlCarousel2();
			});

			$(window).bind("cbox_closed", function() {
				NTH.update_cart();
			});

			$('.nth-social-share-link li a').on('click', function (e) {
				e.preventDefault();
				var url = $(this).attr('href');
				var title = $(this).attr('title');
				window.open(url, title,"width=700, height=520");
			});

			$('body.pace-loading').addClass('pace-done').removeClass('pace-loading');

			$('.widget-heading').on('click', function () {
				if($(window).width() < 480) {
					$(this).next().slideToggle(200);
				}
			});

			$(document).ajaxStop(function () {
				NTH.quickShop();
				NTH.dropDragProduct();
			});

		},
		owlCarousel: function(){
			
			$('.nth-owlCarousel:not(.initialized)').each( function(){
				var sl_root = $(this);
				var defaults = {
					items: 5,
					itemsCustom: false,
                    itemsDesktop: [1199, 4],
                    itemsDesktopSmall: [980, 3],
                    itemsTablet: [768, 2],
                    itemsTabletSmall: false,
                    itemsMobile: [479, 1],
					itemsScaleUp: false,
					stopOnHover: false,
					rewindNav: true,
					scrollPerPage: false,
					autoPlay: false,
					pagination: false,
					autoHeight : false,
					navigation: true,
					lazyload: false,
					lazyFollow: true,
                    lazyEffect: "fade",
					mouseDrag: true,
                    touchDrag: true,
					dragBeforeAnimFinish: true,
					afterInit: function(){
						sl_root.addClass('initialized').removeClass('loading');
					}
				};

				var slider = sl_root.data('slider');
				var base = sl_root.data('base');
				
				var config = $.extend({}, defaults, sl_root.data("options"));
				
				if( typeof base !== "undefined" && base == 1 ) {
					config.responsiveBaseWidth = sl_root;
				}
				if( typeof slider !== "undefined" && slider !== 'this' ) {
					sl_root.find(slider).owlCarousel(config);
				} else {
					sl_root.owlCarousel(config);
				}
				
			} );
		},
		owlCarousel2_callback: function ($this) {
			var sl_root = $this;

			var defaults = {
				loop: false,
				nav: true,
				autoplay: false,
				autoplayTimeout: 5000,
				dots: false,
				lazyLoad: false,
				navRewind: false,
				mouseDrag: false,
				onInitialized: function(event){
					sl_root.addClass('initialized').removeClass('loading');
				}
			};
			if(typeof theshopier_data !== 'undefined' && theshopier_data.rtl == '1') {
				defaults.rtl = true;
			}

			var slider = sl_root.data('slider');
			var base = sl_root.data('base');

			var config = $.extend({}, defaults, sl_root.data("options"));

			if( typeof base !== "undefined" && base == 1 ) {
				config.responsiveBaseElement = sl_root;
			}

			if( typeof slider !== "undefined" && slider !== 'this' ) {
				var owl = sl_root.find(slider);
			} else {
				var owl = sl_root;
			}

			owl.owlCarousel(config);

            NTH.prodSingleImageEvent();
		},
		owlCarousel2: function(){
			setTimeout(function () {

				$('.nth-owlCarousel:not(.initialized):visible').each( function(){
					var root = $(this);
					if(typeof imagesLoaded !== 'undefined' && root.find('img').length > 0 ) {
                        var _first = true;
						$(this).imagesLoaded().progress(function(){
							if(_first) {
                                NTH.owlCarousel2_callback(root);
                            }
                            _first = false;
						});
					} else {
						NTH.owlCarousel2_callback(root);
					}
				} );
			}, 200);
		},
		owlCarousel2_event: function(){

			$('.vc_tta-tabs .vc_tta-tab').on('click', function(){
				NTH.owlCarousel2();
			});

			NTH.owlCarousel2();
		},
		dropDragProduct: function(){
			if(typeof $({}).draggable !== 'function') return false;
			if($.support.touch || parseInt(theshopier_data.isDropDrag)!=1) return false;

			$('.woocommerce .products.shop_dragdrop section.product-type-simple').draggable({
				revert: 'invalid',
				cancel: '.product-meta-wrapper',
				cursorAt: { bottom: 40, left: 40 },
				helper: function(){
					var drop_elem = $(this).find('.product-thumbnail-wrapper img').clone().appendTo('body');
					drop_elem.css({'z-index': 9999, 'width': '80px', 'cursor': 'move'});
					drop_elem.css({'border': '1px solid #999'});
					return drop_elem;
				},
				start: function(){
					$('.toolbar_item.nth-shopping-cart-item > .nth-toolbar-popup-cotent:not(.adding)').addClass('show');
					$(this).css({'z-index': 9});
				},
				stop: function(){
					$('.toolbar_item.nth-shopping-cart-item > .nth-toolbar-popup-cotent:not(.adding)').removeClass('show');
					$(this).css({'z-index': ''});
				}
			});

			$( ".nth-toolbar-popup-cotent.nth-shopping-cart-content:not(.adding)" ).droppable({
				activeClass: "droppable_active",
				hoverClass: "droppable_in",
				drop: function( event, ui ) {
					$( this ).addClass('adding');
					var clone = ui.draggable.find('.product-thumbnail-wrapper img').clone();
					var cart_btn = ui.draggable.find('.product-meta-wrapper .add_to_cart_button');
					if(cart_btn.length > 0) {
						$( this ).find('.shop-cart-dropable-box').html(clone);
						$( this ).find('.shop-cart-dropable-box').theshopier_block();
						cart_btn.trigger('click');
					} else {
						$('.toolbar_item.nth-shopping-cart-item > .nth-toolbar-popup-cotent.adding').removeClass('show').removeClass('adding');
						$( ".nth-toolbar-popup-cotent.nth-shopping-cart-content .shop-cart-dropable-box" ).unblock().html(NTH.data.shop_dropText)
					}

				}
			});
			
			$('body').on('added_to_cart', function(){
				$('.toolbar_item.nth-shopping-cart-item > .nth-toolbar-popup-cotent.adding').removeClass('show').removeClass('adding');
				$( ".nth-toolbar-popup-cotent.nth-shopping-cart-content .shop-cart-dropable-box" ).unblock().html(NTH.data.shop_dropText)
			});
		},
		//events
		ajax_response: function(){
			NTH.added_to_cart();
			NTH.removeCartItem();
			NTH.removeWishList();
			
		},
		shortcodeEvents: function(){
			
			$('ul.shortcode-woo-tabs li.tab-item-ajax:not(.active)').live('click', function(e){
				var cat_slug = $(this).find('> a').data('slug');
				var tab_id = $(this).find('> a').data('id');
				var element = $(this).parents('.nth-shortcode').find('.nth-shortcode-content .products');
				var tab_ajax_content = $(this).parents('.nth-shortcode').find('.nth-shortcode-content .tab-content-item.ajax-content')
				var data = {
					action: 'nth_woo_get_product_by_cat',
					atts: $(this).parents('.nth_products_categories_shortcode').data('atts'),
					cat_slug: cat_slug,
					context: 'frontend'
				}
				
				$(this).siblings().removeClass('active');
				$(this).addClass('active');
				
				if( NTH.data.shortcode.product_tab[tab_id] ) {
					tab_ajax_content.html(NTH.data.shortcode.product_tab[tab_id]);
					NTH.owlCarousel2();
					NTH.quickShop();
					return;
				}
				
				$.ajax({
					type : "POST",
					timeout : 30000,
					url : theshopier_data.ajax_url,
					data : data,
					error: function(xhr,err){
						element.unblock();
					},
					beforeSend: function(){
						element.theshopier_block();
					},
					success: function( response ){
						element.unblock();
						tab_ajax_content.html(response);
						NTH.data.shortcode.product_tab[tab_id] = response;
						NTH.owlCarousel2();
						NTH.quickShop();
					}
				});
				
			});
		},
		windowResize: function(){
			$(window).resize(function(){
				NTH.headerSticky(1);
				NTH.prodSingleImageEvent();
			});
		},
		quickShop: function(){
			if( typeof $({}).prettyPhoto !== 'function') return false;

			$('.nth_quickshop_link').prettyPhoto({
				social_tools: false,
				opacity: 0.6,
				show_title: false,
				default_width: 880,
				default_height: 400,
				theme: 'pp_woocommerce pp_nexthemes',
				changepicturecallback: function(){
					$( 'div.quantity:not(.buttons_added)' ).addClass('buttons_added')
						.prepend('<input type="button" value="-" class="minus" />')
						.append('<input type="button" value="+" class="plus" />');
					
					$('.pp_inline').find('form.variations_form').wc_variation_form();
					$('.pp_inline').find('form.variations_form .variations select').change();
					jQuery('body').trigger('wc_fragments_loaded');

					$('.woocommerce-product-gallery').css({opacity: 1});

					NTH.owlCarousel2();
				}
			});
		},
		countdowns: function(){
			$('.nth-countdown').each(function(e,i){
				var cd = $(this).data('atts');
				$(this).find('span.count_down').countdown(cd.dateTo, function(e){
					$(this).html( e.strftime(cd.format) );
				});
				$(this).parents('.product-meta-wrapper').addClass('prod-count-down');
			});
		},
		prodSingleThumbEvent: function(){
			$(document).on('click', ".product .images #nth_prod_thumbnail .owl-item a", function( event ){
				event.preventDefault();
				var pos = $(this).data('pos');
				$(".product .images .nth-owlCarousel .yeti-owl-slider").trigger('to.owl.carousel', [pos, 300, true]);
			});

			$('body').on('found_variation', function (e, variation) {
				var $form = $('form.variations_form');
				$form.wc_variations_image_update( false );

				if(typeof variation !== 'undefined' && variation.image.src !== 'undefined') {
                    //console.log(variation.image.src);
					$('.product .p_image').find('a.zoom1').each(function (i) {
						if($(this).find('img:eq(0)').attr('src') === variation.image.src) {
                            console.log(i);
							$(".product .images .nth-owlCarousel .yeti-owl-slider").trigger('to.owl.carousel', [i, 300, true]);
						}
					});
				}
			});

			setTimeout(function () {
				var $form = $('form.variations_form');
				$form.trigger('check_variations');
			}, 1500);

		},
		prodSingleImageEvent: function () {

			var _zoom = true;
			if($('.nth-quickshop-wrapper .product .images').length > 0) _zoom = false;

            if($(".product .images .nth-owlCarousel").length) {

                $(".product .images .p_image.nth-owlCarousel").find('.owl-item:nth-of-type(1) a.zoom1').imagesLoaded( function() {
                    if(_zoom) {
						var element = $(".product .images .p_image.nth-owlCarousel").find('.owl-item:nth-of-type(1) a.zoom1');
						if(!element.find('.zoomImg').length && $(window).width() > 768) {
							element.zoom({
								url: element.find('img').attr('data-src')
							});
						}
					}

                    $(".product .images .p_image.nth-owlCarousel").on('changed.owl.carousel', function(event){
						if(_zoom) {
							var element = $(".product .images .p_image.nth-owlCarousel").find('.owl-item:nth-of-type('+(event.item.index+1)+') a.zoom1');
							if(!element.find('.zoomImg').length  && $(window).width() > 768) {
								element.zoom({
									url: element.find('img').attr('data-src')
								});
							}
						}

                        var thumb = $(".product .images .thumbnails.nth-owlCarousel").find('.owl-item:nth-of-type('+(event.item.index+1)+')');
                        thumb.parent().find('.owl-item .active').removeClass('active');
                        if( !thumb.hasClass('active') ) {
                            $(".product .images .thumbnails.nth-owlCarousel").trigger('to.owl.carousel', [event.item.index, 300, true]);
                        }
                        thumb.find('a.img_thumb, a.video_thumbnail').addClass('active');
                    });
                });

            } else {
				if(_zoom) {
					$(".product .images .p_image a.zoom1").imagesLoaded( function() {
						var element = $(".product .images .p_image a.zoom1");
						if(!element.find('.zoomImg').length && $(window).width() > 768) {
							element.zoom({
								url: element.find('img').attr('data-zoom-image')
							});
						}
					});
				}
			}
		},
		added_to_cart: function(){
			$("body").bind('cart_page_refreshed', function(){
				NTH.updateQuantityButton();
			});

		},
		update_cart: function(){
			$.ajax({
				type: 'GET',
				url: theshopier_data.ajax_url + '?action=nth_update_cart',
				success: function(response){
					var fragments = response.fragments;
					// Replace fragments
					if ( fragments ) {
						$.each( fragments, function( key, value ) {
							$( key ).replaceWith( value );
						});
					}
				}
			});
			NTH.added_to_cart();
		},
		removeCartItem: function(){
			$('body').on('click', 'li.mini_cart_item .nth_remove_cart', function(e){
				e.preventDefault();
				var $thisbutton = $(this);
				var data = {
					action: "nth_woo_remove_cart_item"
				};
				
				$.each($thisbutton.data(), function( key, value ){
					data[key] = value;
				});
				
				$.ajax({
					url: theshopier_data.ajax_url,
					data: data,
					type: "POST",
					beforeSend: function(){
						$thisbutton.parents('.widget_shopping_cart_content').theshopier_block();
					},
					success: function(response){
						if ( ! response ) return;

						var this_page = window.location.toString();

						var fragments = response.fragments;
						if ( fragments ) {
							$.each( fragments, function( key, value ) {
								$( key ).addClass( 'updating' );
							});
						}

						// Block widgets and fragments
						$( '.shop_table.cart, .updating, .cart_totals' ).theshopier_block();

						// Replace fragments
						if ( fragments ) {
							$.each( fragments, function( key, value ) {
								$( key ).replaceWith( value );
							});
						}

						// Unblock
						$( '.widget_shopping_cart, .updating' ).stop( true ).css( 'opacity', '1' ).unblock();

						// Cart page elements
						$( '.shop_table.cart' ).load( this_page + ' .shop_table.cart:eq(0) > *', function() {
							$( '.shop_table.cart' ).stop( true ).css( 'opacity', '1' ).unblock();
							$( 'body' ).trigger( 'cart_page_refreshed' );
						});

						$( '.cart_totals' ).load( this_page + ' .cart_totals:eq(0) > *', function() {
							$( '.cart_totals' ).stop( true ).css( 'opacity', '1' ).unblock();
						});

						$( 'body' ).trigger( 'added_to_cart');

						NTH.updateQuantityButton();
					}
				});
			});
		},
		removeWishList: function(){
			$('body').on('click', '.nth_remove_from_wishlist', function(){
				var remove_btn = $(this),
					pagination = remove_btn.data( 'pagination' ),
					wishlist_id = remove_btn.data( 'id' ),
					wishlist_token = remove_btn.data( 'token' ),
					prod_id = remove_btn.data( 'prod_id' ),
					par_box = remove_btn.parents('.nth-toolbar-popup-cotent');
				var data = {
					action: 'remove_from_wishlist',
					remove_from_wishlist: prod_id,
					wishlist_id: wishlist_id,
					wishlist_token: wishlist_token
				}
				$.ajax({
					url: theshopier_data.ajax_url,
					data: data,
					type: "POST",
					beforeSend: function(){
						par_box.theshopier_block();
					},
					success: function(response){
						$('body').trigger('added_to_wishlist');
					}
				});
			});
		},
		compareLink: function(){
			if( typeof yith_woocompare == 'undefined' || typeof woocommerce_params == 'undefined') return false;
			$(document).on( 'click', '.product a.nth-compare:not(.added)', function(e){
				e.preventDefault();
				var button = $(this),
					data = {
						//_yitnonce_ajax: yith_woocompare.nonceadd,
						action: yith_woocompare.actionadd,
						id: button.data('product_id'),
						context: 'frontend'
					},
					widget_list = $('.yith-woocompare-widget ul.products-list');

				$.ajax({
					type: 'post',
					url: yith_woocompare.ajaxurl.toString().replace( '%%endpoint%%', yith_woocompare.actionadd ),
					data: data,
					dataType: 'json',
					beforeSend: function(){
						button.addClass('loading');
					},
					success: function(response){

						if( typeof woocommerce_params != 'undefined' ) {
							widget_list.unblock()
						}

						button.removeClass("loading");
						button.addClass('added')
							.attr( 'href', response.table_url )
							.text( yith_woocompare.added_label );

						// add the product in the widget
						widget_list.html( response.widget_table );

						/*if ( yith_woocompare.auto_open == 'yes')
							$('body').trigger( 'yith_woocompare_open_popup', { response: response.table_url, button: button } );*/

						$('body').trigger('compare_product_added');
					}
				});
			});
			$(document).on('click', '.product a.nth-compare.added', function (ev) {
				ev.preventDefault();

				var table_url = this.href;

				if (typeof table_url == 'undefined')
					return;

				$('body').trigger('yith_woocompare_open_popup', {response: table_url, button: $(this)});
			});

			$(document).on('click', '.nth_remove_compare', function(e){
				e.preventDefault();
				//var url = $(this).attr('href');
				var button = $(this);

				var data = {
					action: yith_woocompare.actionremove,
					id: button.data('product_id'),
					context: 'frontend'
				};

				$.ajax({
					type: 'post',
					url: yith_woocompare.ajaxurl.toString().replace( '%%endpoint%%', yith_woocompare.actionremove ),
					data: data,
					beforeSend: function(){
						button.parents('.nth-toolbar-popup-cotent').theshopier_block();
					},
					success: function(o){
						$('body').trigger('compare_product_added', [button]);
					}
				});
			});

			$('body').on('compare_product_added', function(e, button){
				if( typeof woocommerce_params == 'undefined' ) return false;
				$.ajax({
					url: theshopier_data.ajax_url,
					type: "POST",
					data: {
						action: 'nth_added_to_compare',
						context: 'frontend'
					},
					success: function( data ){
						if ( data ) {
							$.each( data, function( key, value ) {
								$( key ).replaceWith( value );
							});
						}
					}
				});
			})
		},
		isotope: function(){
			$(".nth-isotope-act").each(function(i,e){
				var data = $(this).data('params');
				if( typeof data == "undefined" ) return false;
				var $this = $(this)
				setTimeout(function(){
					$this.isotope(data);
				}, 750);
				$(this).find("img").load(function(){
					$(this).parents('.nth-isotope-act').isotope(data);
				});
			})
		},
		formPopup: function(){
			if(typeof $({}).prettyPhoto !== 'function') return false;

			var nth_nlt_pp_w = $("#nth_newsletter_popup_open").data('pp_width') || 500;
			$("#nth_newsletter_popup_open").prettyPhoto({
				opacity: 0.6,
				show_title: false,
				theme: 'pp_shopier_newsletter',
				social_tools: false,
				default_width: 570
			});

			if( !$.cookie('nth_newsletter_popup_open') || $.cookie('nth_newsletter_popup_open') == '0') {
				setTimeout(function () {
					$("#nth_newsletter_popup_open").trigger('click');
				}, 300);
			}

			$(document).on('click', '.popup-cookie-close', function (e) {
				e.preventDefault();
				console.log(1);
				$.prettyPhoto.close();
				var __ex = $(this).data('time') || 1;
				if( parseInt(__ex) > 0 )
					$.cookie('nth_newsletter_popup_open', '1', {expires: __ex, path: '/'});
			});


			$(".nth-prettyPhoto").prettyPhoto({
				opacity: 0.6,
				show_title: false,
				theme: 'pp_woocommerce pp-popup-form',
				social_tools: false
			});
		},
		toggleWidgetCategories: function(){
			$('.widget_product_categories .product-categories li, .widget_categories ul li').each(function(){
				if($(this).hasClass('cat-parent')){
					$(this).prepend("<span class='go-sub'><span class='cat-icon'></span></span>");
					if($(this).hasClass('current-cat') || $(this).hasClass('current-cat-parent')){
						$(this).addClass('show-sub');
					}
				}

				$(this).find('> .go-sub').on('click', function(){
					$(this).parent().toggleClass('show-sub');
					//$(this).parent().find('> ul.children').slideToggle(100);
				});
			});
		},
		ajaxLogin: function(){
			$(document).on('submit', '.nth-ajax-login-wrapper form', function(e){
				e.preventDefault();
				var $this = $(this);
				//var _url = $this.attr('action');
				var data = $this.serializeArray();
				data.push({name: 'action', value: 'nth_ajax_login'});
				$.ajax({
					type: "POST",
					url: theshopier_data.ajax_url,
					data: data,
					dataType: 'json',
					beforeSend: function(){
						$this.find('[name=submit], input').prop('disabled', true);
						$this.theshopier_block();
					},
					success: function (o) {
						if(o.code == false) window.location.reload(true);
						else {
							$this.find('.login-username').removeClass('form-group has-error has-feedback');
							$this.find('.login-username label').removeClass('control-label');
							$this.find('.login-username input').removeClass('form-control');

							$this.find('.login-password').addClass('form-group has-error has-feedback');
							$this.find('.login-password label').addClass('control-label');
							$this.find('.login-password input').addClass('form-control').val('');
							if(o.code == 'invalid_username') {
								$this.find('.login-username').addClass('form-group has-error has-feedback');
								$this.find('.login-username label').addClass('control-label');
								$this.find('.login-username input').addClass('form-control');
							}
							var _append = '<div class="alert alert-danger alert-dismissible" role="alert">'+ o.mess +'</div>';
							if($this.parents('.nth-ajax-login-wrapper').find('div.alert').length > 0)
								$this.parents('.nth-ajax-login-wrapper').find('div.alert').remove();
							$this.parents('.nth-ajax-login-wrapper').append(_append);
							$this.unblock();
							$this.find('[name=submit], input').prop('disabled', false);
						}
					}
				});
			})
		},
		appearAnimated: function () {
			if($('.nth_animate').length > 0) {
				$('.nth_animate').appear();
				$(document.body).on('appear', '.nth_animate', function (e, $affected) {
					$affected.each(function () {
						var _animate = $(this).data('animate');
						if( typeof _animate !== 'undefined' ) {
							var $_this = $(this);
							setTimeout(function () {
								$_this.removeClass('animate_hide').addClass('animated').addClass(_animate);
							}, 600);
						}
					});
				} );
			}
		},
		paceLoader: function () {
			if(typeof Pace !== 'undefined') {
				Pace.options = {
					ajax: false
				};
			}

		},
		preview: function () {
			$('.nth-preview-wrapper').on('click', '.layout-section .layout-button .button', function (e) {
				e.preventDefault();
				var act = $(this).data('action');
				var color = $(this).data('color');
				$(this).parent().find('.active').removeClass('active');
				$(this).addClass('active');
				if(act === 'boxed') {
					$('.nth-preview-wrapper .layout-background .bg-item.bg_repeat1').trigger('click');
					console.log($('.nth-preview-wrapper .layout-background .bg-item:first-child'));
					$('body #body-wrapper').addClass('container').css({'padding': 0, 'background-color': '#'+color});

				} else {
					$('body #body-wrapper.container').removeClass('container');
				}

			})

			$('.nth-preview-wrapper').on('click', '.layout-section .layout-background .bg-item', function (e) {
				e.preventDefault();
				$(this).parent().find('.bg-item.active').removeClass('active');
				$(this).addClass('active')
				var json = $(this).data('bg');
				console.log(json);
				$('body').css(json);
			});

			$('.nth-preview-wrapper').on('click', '.button-wrapper .preview-toggle', function (e) {
				e.preventDefault();
				$('.nth-preview-wrapper').toggleClass('nth-close');
				
				if( typeof $.cookie === 'function' ) {
					var act = 'nth-open';
					if( $('.nth-preview-wrapper.nth-close').length > 0 ) {
						act = 'nth-close';
					}
					$.cookie('nth_previewcookie', act, { path: '/' });
				}
			});

			$('.nth-preview-wrapper').on('change', '#theshopier_preview_font', function (e) {
				var __val = $(this).val();
				var __gg_link = 'https://fonts.googleapis.com/css?family=' + $(this).val();
				if( $('#theshopier_heading_font').length ) {
					$('#theshopier_heading_font').attr('href', __gg_link);
				} else {
					var __gg_scr = document.createElement('link');
					__gg_scr.rel = "stylesheet";
					__gg_scr.type = "text/css";
					__gg_scr.id = "theshopier_heading_font";
					__gg_scr.href = __gg_link;
					$("head").append(__gg_scr);
				}

				$.ajax({
					type: 'GET',
					dataType: 'json',
					url: theshopier_data['templ_url'] + '/js/preview_font.json',
					success: function (data) {
						$(data.font_1).css({'font-family': __val});
					}
				});

			});

		},
		fix_VC_FullWidth: function () {
			if(typeof theshopier_data !== 'undefined' && theshopier_data.rtl == '1') {
				var _screen_w = $(window).width();
				$('body .vc_row[data-vc-full-width=true]').each(function (e, i) {
					var _margin = ($(this).width() - _screen_w)/2;
					$(this).css('right', _margin);
				});
			}
		},
		updated_wc_div: function () {
			$(document.body).on('updated_wc_div', function () {
				NTH.updateQuantityButton();
			});
		}
	};

    $(document).on('click', '.product .images .zoom1', function (e) {
        e.preventDefault();
    });


    $(document).ready(function(){

		NTH.initialize();

        /* Category list table */
        $('.product_buttons').has('.add_to_cart_button.product_type_variable').css('right', '1%');
        $('.product_buttons').has('.product_type_external').css('right', '1.5%');

        // Set equal height Top brands home3
        /*$('.product_brands .woo-subcat-item > .nth-row-grid').matchHeight();
        $('.nth-shortcode .nth_products_categories_shortcode.style-2 ul.shortcode-woo-tabs > li > a').matchHeight();*/
        setTimeout(function(){
            // Set equal height Top brands home3
            $('.product_brands .woo-subcat-item > .nth-row-grid').matchHeight();

            /*$('.nth-shortcode .nth_products_categories_shortcode.style-2 ul.shortcode-woo-tabs > li > a').matchHeight();*/

        }, 500);

	});

    $(window).bind('resize', function () {
        /*setHeightProductInfo(true);*/

        setTimeout(function(){
			if(typeof setHeightProductInfo == 'function') window.setHeightProductInfo(true);

            // Set equal height Top brands home3
            $('.product_brands .woo-subcat-item > .nth-row-grid').matchHeight();

            $('.nth-shortcode .nth_products_categories_shortcode.style-2 ul.shortcode-woo-tabs > li > a').matchHeight()

        }, 1000);

    });

	$(window).load(function() {
        /*setHeightProductInfo(true);*/
		if(typeof setHeightProductInfo == 'function') setTimeout(function(){ window.setHeightProductInfo(true); }, 100);
    });
	
	/*Product page*/
	$('body').on( "click", ".variations_form .nth-variable-attr-swapper .select-option", function(e){
		var val = $(this).attr('data-value');
		var _this = $(this);
		var color_select = $(this).parents('.value').find('select');

		color_select.trigger('focusin');
		if(color_select.find('option[value='+val+']').length !== 0) {
			color_select.val( val ).change();
			$(this).parent( ".nth-variable-attr-swapper" ).find('.selected').removeClass('selected');
			_this.addClass('selected');
		}
		
	} );

	$('body').on( 'click', '.variations_form .reset_variations', function(e){
		$(this).parents('.variations').find('.nth-variable-attr-swapper .select-option.selected').removeClass('selected');
	});
	
	$('#back_to_top, .back_to_top').on('click', function(){
		$('html, body').animate({scrollTop: 0}, 300);
	});

	$(window).on('scroll', function (e) {
		var _top = $(window).scrollTop();
		if(_top > 200) {
			$('.back_to_top.hidden').removeClass('hidden');
		} else {
			$('.back_to_top').addClass('hidden');
		}
	});
	
	$(document).on('added_to_wishlist', function(e){
		if( typeof woocommerce_params == 'undefined' ) return false;
		$.ajax({
			url: theshopier_data.ajax_url,
			type: "POST",
			data: {
				action: 'nth_added_to_wishlist'
			},
			success: function( data ){
				if ( data ) {
					$.each( data, function( key, value ) {
						$( key ).replaceWith( value );
					});
				}
			}
		});
	});
	
	$(document).on('click', '.nth_header_toolbar .nth-compare-item a.nth-ajax-compare-popup', function(e){
		e.preventDefault();
		var res = $(this).attr('href');
		 $('body').trigger( 'yith_woocompare_open_popup', { response: res } );
	});

	$(".shipping-calculator-button").on('click', function(){
		$(this).toggleClass('open');
	});
	
	$(document).on('click', '.add_to_cart_button.product_type_simple, .single_add_to_cart_button.ajax_add_to_cart', function(){
		var product_id = $(this).data('product_id');
		
		$.ajax({
			url: theshopier_data.ajax_url,
			type: "POST",
			data: {
				action: "nth_woo_getproductinfo",
				product_id: product_id
			}, success: function(data){
				$('.current-product-added-to-cart').removeClass(NTH.prodInfo.timeout.fOut).addClass(NTH.prodInfo.timeout.fIn).html(data).show();
				clearTimeout( NTH.prodInfo.timeout.obj );
				NTH.prodInfo.timeout.obj = setTimeout(function(){
                    $('.current-product-added-to-cart').removeClass(NTH.prodInfo.timeout.fIn).addClass(NTH.prodInfo.timeout.fOut);
                }, NTH.prodInfo.timeout.time);
			}
		});
	});


    function is_touch_device() {
        return (('ontouchstart' in window)
            || (navigator.MaxTouchPoints > 0)
            || (navigator.msMaxTouchPoints > 0));
    }

    $(document).on('click', '.nth-sidebar ul.widgets-sidebar > li.widget_product_categories ul.product-categories  li  a', function(event){
        if($('body').hasClass('touch_device')) {
            if($(this).find("+ ul.children").length) {
                if(! $(this).attr('click-counter')){
                    event.preventDefault();
                    $(this).find("ul.children").css("max-height", "100%");
                    $(this).attr('click-counter', 1);
                    /* alert($(this).attr('click-counter'));*/
                }
                else
                {
                    return;
                }
            }
        }
    });
    // Mobile menu active
    $.activeMobileMenu = function(elem) {
    	$(elem).click( function(e){
    		e.stopPropagation();
    		$('body').toggleClass('mobile-menu-active');
    	});
    	$(document).on('click', function(e) {
    		if($('body').hasClass('mobile-menu-active')) {
    			$('body').removeClass('mobile-menu-active');	
    		}
    	});
    }
    // Mobile search active
    $.activeMobileSearch = function(elem) {
    	var formSearch = $($(elem).attr('data-form'));
    	$(elem).click( function(e){
    		$('.nth-mini-popup .mini-popup-hover').removeClass('active');
			$('.nth-mini-popup .nth-mini-popup-cotent').removeClass('show');
    		$(elem).toggleClass('active');
    		e.stopPropagation();
    		//formSearch.fadeToggle();
    		formSearch.toggleClass('show');
    	});
    }
    $.arcodianMenuMobile = function(){
    	$('.c-menu .mobile-menu ul li.menu-item-has-children').each(function(){
    		$(this).prepend('<span class="menu-drop-icon"></span>');
    	});
    	$('.c-menu .pc-menu .menu li.menu-item-has-children, .c-menu .mobile-menu ul li.menu-item-has-children').each(function(){
    		var itemMenu = $(this);
    		$(this).find('> .menu-drop-icon').click(function(){
    			if(itemMenu.hasClass('show-submenu')){
    				itemMenu.removeClass('show-submenu');
    			}else{
    				itemMenu.addClass('show-submenu');
    			}
    		});
    	});
    }
    // Slide Out Content
    $.contentSlideOut =  function(button, element, type) {
        var slideContent = new Menu({
            wrapper: element,
            type: type,
            menuOpenerClass: '.c-button',
            maskId: '#c-mask'
        });
        $(button).each(function(){
            var active = $(this);
            active.click( function(){
               	slideContent.open();
            });
        });
    }
    // Compare Move HTML
    $('table.compare-list').each(function(){         
            var table = $(this);
            var trPrice = table.find('tr.price');
            var trTitle = table.find('tr.title');

            // Get and move data Price to Title
            trPrice.find('td').each(function(){           
                var tdPrice = jQuery(this);       
                // Map td of Title and td of Price to move data
                trTitle.find('td').each(function(){
                    var tdTitle = $(this);
                    if(tdTitle.hasClass('have-price') == false && tdTitle.index() == tdPrice.index()) {
                        tdTitle.addClass('have-price');
                        tdTitle.append('<span class="price">' + tdPrice.html() + '</span>'); 
                    }
                });                       
            });
            // Hide Price Row
            trPrice.hide();
        });


    // apply matchHeight to each item container's items
    /*$('.product_brands .owl-stage').each(function() {
        $(this).children('.owl-item').matchHeight({
            byRow: byRow
        });
    });*/

	//  Toggle for mini cart on mobile device
	$.toggleMiniCartOnMobile = function(){
		var flaf = 0;
		$('.nth-mini-popup').each(function(){
			if(!$(this).hasClass('nth-mini-nodropdown')){
				var wrapper = $(this);
				
				wrapper.find('.mini-popup-hover').unbind('click');
				wrapper.find('.mini-popup-hover').on('click', function(e){
					// Check if stub is open
        			var isContentOpen = wrapper.find('.mini-popup-hover').hasClass('active') ? 1 : 0;
					$('.nth-mini-popup .mini-popup-hover').removeClass('active');
					$('.nth-mini-popup .nth-mini-popup-cotent').removeClass('show');
					$('#searchIconActiveId').removeClass('active');
					$('.searchform.nth-searchform').removeClass('show');
					// Toggle stubs
			        if (isContentOpen) {
			        	wrapper.find('.mini-popup-hover').removeClass('active');
			        	wrapper.find('.nth-mini-popup-cotent').removeClass('show');
			            //wrapper.removeClass('show');
			        } else {
			        	wrapper.find('.mini-popup-hover').addClass('active');
			        	wrapper.find('.nth-mini-popup-cotent').addClass('show');
			            //wrapper.addClass('show');
			        }

				})
			}
		});

		/*$('.nth-mini-popup.nth-shopping-cart').each(function(){
			var wrapper = $(this);
			wrapper.find('.mini-popup-hover.nth-shopping-hover').click(function(){
				$(this).off('mouseleave');
				if($(window).width() < 768 ) {
					wrapper.find('.nth-mini-popup-cotent.nth-shopping-cart-content').toggleClass('show');
				}				
			});
			// Window Resize
			$(window).resize(function(){
				if($(window).width() > 767 ) {
					wrapper.find('.nth-mini-popup-cotent.nth-shopping-cart-content').removeClass('show');
				}	
			});
		});*/
		
	}

	// Close Dropdown When Click Outsite
    $.closeDropdown = function(options,e){
        var settings = $.extend({
            'title': '.mini-popup-hover',
            'content':'.nth-mini-popup-cotent',
            'clsRemoveTitle':'',
            'clsRemoveContent':''
        }, options);

        var title = settings.title,
            content = settings.content;
        var target = $(e.target);
        if($(title).length && $(content).length){
            if (!target.parents().andSelf().is(title) && !target.parents().andSelf().is(content)) { // Clicked outside
                $(title).removeClass(settings.clsRemoveTitle);
                $(content).removeClass(settings.clsRemoveContent);
            }
        }
    }

    $.home2MenuHeight = function(){
    	var slideshow_height =0;
    	if($('.slider-home2-1-col .rev_slider_wrapper').length){
    		slideshow_height = $('.slider-home2-1-col .rev_slider_wrapper').height() + 1;
			$('header.header-2 .vertical-menu-wrapper .vertical-menu-inner > ul.menu').css({'min-height': slideshow_height});
    	}
    	
    }

    // Home 9 Cat group

    $('.woo_categories  .woo-categories-list ul li').on('hover', function(){
        var att = $(this).attr('data-id');
		$(this).parent().find('li.active').removeClass('active');
		$(this).addClass('active');
		$(this).parents('.woo-categories-wrapper').find('.woo-categories-info .cat-info-item:not(.hidden)').addClass('hidden');
		$(this).parents('.woo-categories-wrapper').find('.woo-categories-info '+ att).removeClass('hidden');
        /*$('.woo_categories  .woo-categories-info .cat-info-item').each(function(){
            $(this).addClass('hidden');

            if ($(this).attr('id')== att)
                $(this).removeClass('hidden');
        });*/

    })


})(jQuery);


/* Call all script on the page here */
var $j = jQuery.noConflict();

// Ready
$j(document).ready(function () {
    // Mobile menu
    //$j.activeMobileMenu('#mobileMenuActiveId');
    // Search Bar Mobile
    $j.activeMobileSearch('#searchIconActiveId');
    $j.activeMobileSearch('#searchIconActiveIdDesktop');
    // Active Slide Out
	var _rtl_push = 'push-left';
	if( typeof theshopier_data !== 'undefined' && theshopier_data.rtl == '1' ) {
		_rtl_push = 'push-right';
	}
    $j.contentSlideOut('.active-push-out', '#body-wrapper', _rtl_push);
    $j.arcodianMenuMobile();

    if($j('body').hasClass('touch_device') || $j(window).width() < 768){
    	$j.toggleMiniCartOnMobile();
    }

    // Close dropdown when click out
    $j('*').mouseup(function(e){
    	$j.closeDropdown({
	        'title': '.mini-popup-hover',
	        'content':'.nth-mini-popup-cotent',
	        'clsRemoveTitle':'active',
	        'clsRemoveContent':'show'
	    },e);
	    $j.closeDropdown({
	        'title': '#searchIconActiveId',
	        'content':'.nth-searchform',
	        'clsRemoveTitle':'active',
	        'clsRemoveContent':'show'
	    },e);
    });
});

$j(window).load(function () {
	$j.home2MenuHeight();
});

$j(window).resize(function () {
	setTimeout(function(){
		$j.home2MenuHeight();
	}, 200);

	if($j(window).width() < 768){
    	$j.toggleMiniCartOnMobile();
    }
});
