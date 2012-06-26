/*TOOLS*/ //TODO: Update the when_images_loaded() in other code to use .on('load') instead of .load().
function when_images_loaded($img_container, callback) { //do callback when images in $img_container are loaded. Only works when ALL images in $img_container are newly inserted images.
	var img_length = $img_container.find('img').length,
		img_load_cntr = 0;
		
	if (img_length) { //if the $img_container contains new images.
		$('img').on('load', function() { //then we avoid the callback until images are loaded
			img_load_cntr++;
			if (img_load_cntr == img_length) {
				//console.log("one!");
				callback();
			}
		});
	}
	else { //otherwise just do the main callback action if there's no images in $img_container.
		//console.log("two!");
		callback();
	}
}

/* Foundation v2.2 http://foundation.zurb.com */
jQuery(document).ready(function ($) {

/*
##################################################################
	FOUNDATION STUFF
##################################################################
*/

	/* Use this js doc for all application specific JS */

	/* TABS --------------------------------- */
	/* Remove if you don't need :) */

	function activateTab($tab) {
		var $activeTab = $tab.closest('dl').find('a.active'),
				contentLocation = $tab.attr("href") + 'Tab';

		//Make Tab Active
		$activeTab.removeClass('active');
		$tab.addClass('active');

    	//Show Tab Content
		$(contentLocation).closest('.tabs-content').children('li').hide();
		$(contentLocation).css('display', 'block');
	}

	$('dl.tabs').each(function () {
		//Get all tabs
		var tabs = $(this).children('dd').children('a');
		tabs.click(function (e) {
			activateTab($(this));
		});
	});

	if (window.location.hash) {
		activateTab($('a[href="' + window.location.hash + '"]'));
	}

	/* ALERT BOXES ------------ */
	$(".alert-box").delegate("a.close", "click", function(event) {
    event.preventDefault();
	  $(this).closest(".alert-box").fadeOut(function(event){
	    $(this).remove();
	  });
	});


	/* PLACEHOLDER FOR FORMS ------------- */
	/* Remove this and jquery.placeholder.min.js if you don't need :) */

	$('input, textarea').placeholder();

	/* TOOLTIPS ------------ */
	$(this).tooltips();



	/* UNCOMMENT THE LINE YOU WANT BELOW IF YOU WANT IE6/7/8 SUPPORT AND ARE USING .block-grids */
//	$('.block-grid.two-up>li:nth-child(2n+1)').css({clear: 'left'});
//	$('.block-grid.three-up>li:nth-child(3n+1)').css({clear: 'left'});
//	$('.block-grid.four-up>li:nth-child(4n+1)').css({clear: 'left'});
//	$('.block-grid.five-up>li:nth-child(5n+1)').css({clear: 'left'});



	/* WORDPRESS FOUNDATION NAV-BAR SUPPORT ------------- */
	/* Adds support for the nav-bar with flyouts in WordPress */
	//$('#menu .nav-bar').prepend('<li><span>&#9733;</span> Nav <span>&#9733;</span></li>'); // the "* Nav *" thingie.
	$('.nav-bar li').has('ul').addClass("has-flyout").find('ul').before('<a href="#" class="flyout-toggle"><span></span></a>');
	$('.nav-bar li a').addClass('main');
	$('.nav-bar li ul').addClass("flyout small");

	/* DROPDOWN NAV ------------- */

	var lockNavBar = false;
	$('.nav-bar a.flyout-toggle').live('click', function(e) {
		e.preventDefault();
		var flyout = $(this).siblings('.flyout');
		if (lockNavBar === false) {
			$('.nav-bar .flyout').not(flyout).slideUp(500);
			flyout.slideToggle(500, function(){
				lockNavBar = false;
			});
		}
		lockNavBar = true;
	});
  if (Modernizr.touch) {
    $('.nav-bar>li.has-flyout>a.main').css({
      'padding-right' : '75px'
    });
    $('.nav-bar>li.has-flyout>a.flyout-toggle').css({
      'border-left' : '1px dashed #eee'
    });
  } else {
    $('.nav-bar>li.has-flyout').hover(function() {
      $(this).children('.flyout').show();
    }, function() {
      $(this).children('.flyout').hide();
    })
  }


	/* DISABLED BUTTONS ------------- */
	/* Gives elements with a class of 'disabled' a return: false; */

/*
##################################################################
	CUSTOM STUFF
##################################################################
*/

	var _flyInBox = $('#flyInBox'),
		_sectionContainers = $('.sectionContainer'),
		flyInFlownIn = false,
		featuredImageInterval = 3000; //milliseconds

//	function scrollPosition() {
//		var scrollPosition = 0,
//			scrollChrome = 0,
//			scrollFirefox = 0,
//			scrollIE = 0;
//			
//		scrollChrome = $('body').scrollTop();
//		scrollFirefox = $('html').scrollTop();
//		
//		if (scrollChrome > 0) {
//			scrollPosition = scrollChrome;
//		}
//		else if (scrollFirefox > 0) {
//			scrollPosition = scrollFirefox;
//		}
//		
//		return $(document).scrollTop(); // so far this works for both FireFox and Chrome.
//	}
	
	/* MENU SCROLL FOLLOW ------------- */
	function setMenuScrollFollow(menuScrollFollowEnabled) {
		if (!menuScrollFollowEnabled) {
			$('#menu').css({'position':'static', 'top':'auto'});
			$('#wpContent').css({'margin-top':'0px'});
		}
		else if (menuScrollFollowEnabled) {
			$('#menu').css({'position':'fixed', 'top':'0px'});
			$('#wpContent').css({'margin-top':$('#menu').outerHeight(true)});
		}
	}
	
	var menuScrollFollowEnabled = false,
		menuSrollFollowTriggerFlag = false;
	$(window).on('scroll', function() {
		var homeOuterHeight = $('#home').outerHeight(true),
			scrollPosition = $(document).scrollTop();
		
		// by testing for the menu scroll follow condition, we are improving performance. The css() method doesn't need to be called every single time the event fires.
		if (scrollPosition < homeOuterHeight) {
			menuScrollFollowEnabled = false;
		}
		else if (scrollPosition >= homeOuterHeight) {
			menuScrollFollowEnabled = true;
		}
		
		if (menuSrollFollowTriggerFlag != menuScrollFollowEnabled) {
			setMenuScrollFollow(menuScrollFollowEnabled);
			menuSrollFollowTriggerFlag = menuScrollFollowEnabled;
		}
		
	});
	$(window).trigger('scroll'); // puts the menu in place if we are refreshing and are below the point where the menu starts following the scroll.

	/* MENU CLICK AUTOSCROLL ------------- */
//	$('#menu .sub-nav dd a').on('click', function() {
//		var _this = $(this),
//			_target = $( '#'+_this.attr('href') ),
//			scrollTo = _target.offset().top-$('#menu').outerHeight(true);
		
//		$('html, body').animate({scrollTop:scrollTo}, 500);
		
//		return false;
//	});
	
	/* WINDOW RESIZE CALCULATIONS ------------- */
	var windowResizeTimeout = false;
	$(window).on('resize', function() { // The window.resize event gets fired one time at the beginning of the page load.
		if (windowResizeTimeout) {
			clearTimeout(windowResizeTimeout);
		}
		windowResizeTimeout = setTimeout(function() {
			// Do anything needed after window resize.
			
			
			
//			var windowWidth = $(window).width(),
//				windowHeight = $(window).height(),
//				menuHeight = $('#menu').outerHeight(true);
			
//			_flyInBox/*$('#flyInBox, .sectionContainer:not(#menu, #home)')*/
//				.width( windowWidth )
//				.height( windowHeight - menuHeight);
			
//			_flyInBox
//				.css({'top':''+menuHeight+'px'});
				
//			if (flyInFlownIn) {
//				_flyInBox.css({'left':'0px'});
//			}
//			else if (!flyInFlownIn) {
//				_flyInBox.css({'left':'-'+windowWidth+'px'});
//			}
			
			if (setFaceBoundaries !== undefined) {
				setFaceBoundaries();
			}
			
			
			
		}, 500);
	});
	
	/* FLY-IN BOX FUNCTIONALITY ------------- */
	function flyInBox_flyIn(callback) {
		flyInFlownIn = true;
		_flyInBox
			.show()
			.animate({
				left: '0px'
			},
			{
				complete: function() {
					//console.log('Animation done.');
					if ( callback !== undefined) {
						if ( $.isFunction(callback) ) {
							//console.log('Calling callback.');
							callback();
						}
					}
				}
			});
	}
	
	function flyInBox_flyOut(callback) {
		flyInFlownIn = false;
		_flyInBox
			.animate({
				left: '-'+$(window).width()+'px'
			},
			{
				complete: function() {
					$(this).hide();
					if ( callback !== undefined) {
						if ( $.isFunction(callback) ) {
							callback();
						}
					}
				}
			}
			);
	}
	
	function getFlyInContent(type, from) {
		if ( typeof type == 'string' ) {
			if (type == 'successStory') {
				setTimeout(function() {
					var _flyInBox_content = _flyInBox.find('.content');
					_flyInBox_content.html( $('#'+from).html() );
					_flyInBox_content.fadeIn(500);
				}, 800);
			}
			else if (false) {
			
			}
		}
	}
	
	function hideFlyInContent() {
		var _flyInBox_content = _flyInBox.find('.content');
		_flyInBox_content.hide();
	}
	
//	$('.face_container').on('click', function() {
//		var _this = $(this);
//		flyInBox_flyIn( getFlyInContent( 'successStory', _this.attr('data-story') ) );
//	});
	
//	$('#flyInBox .closeButton').on('click', function() {
//		var _this = $(this);
//		flyInBox_flyOut( hideFlyInContent() );
//	});
	
	
	/* SET UP ANY WORDPRESS GALLERIES. MUAH HA HA */
	if ( $('.gallery').length ) {
		var _currentElement;
		
		$('body style').remove(); // One thing I dislike about WordPress is their inline styles. :/
		$('.gallery > br').remove();
		$('.gallery').before('<div class="galleryImageView">');
		$('.gallery').after('<div class="galleryContainer">');
		$('.gallery').each(function() {
			var _thisGallery = $(this),
				_galleryImageView = _thisGallery.prev(),
				_galleryItems = _thisGallery.find('.gallery-item');
			
			_thisGallery.appendTo( _thisGallery.next() );
			_thisGallery.find('.gallery-item a').on('click', function(event) {
				var _clickedThumb = $(this),
					_targetImage,
					imagePercentHeight = 0,
					imagePercentWidth = 0,
					clickedThumbHref = _clickedThumb.attr('href'),
					imgSrc,
					imgSrcPieces = _clickedThumb.find('img').attr('src').split('-'+wp_thumbnail_size_w+'x'+wp_thumbnail_size_h);
					
				_currentElement = _clickedThumb;
					
				imgSrc = ''+imgSrcPieces[0]+imgSrcPieces[1];
				
				_galleryImageView.html('<img src="'+imgSrc+'" alt="'+_clickedThumb.attr('title')+'" />');
				_targetImage = _galleryImageView.find('img');
				
				when_images_loaded(_galleryImageView, function() {
						imagePercentWidth = _targetImage.width() / _galleryImageView.width();
						imagePercentHeight = _targetImage.height() / _galleryImageView.height();
						if (imagePercentHeight < imagePercentWidth) {
							_targetImage.height( _galleryImageView.height() );
							_targetImage.css({'width':'auto'});
							_targetImage.css({'margin-left':'-'+( (_targetImage.width() - _galleryImageView.width())/2 )+'px'});
						}
						else if (imagePercentHeight > imagePercentWidth) {
							_targetImage.width( _galleryImageView.width() );
							_targetImage.css({'height':'auto'});
							_targetImage.css({'margin-top':'-'+( (_targetImage.height() - _galleryImageView.height())/2 )+'px'});
						}
						else if (imagePercentWidth == imagePercentHeight) {
							_targetImage.width( _galleryImageView.width() );
							_targetImage.css({'height':'auto'});
							_targetImage.css({'margin-top':'-'+( (_targetImage.height() - _galleryImageView.height())/2 )+'px'});
						}
				});
				
				event.preventDefault();
			});
			_thisGallery.width( _galleryItems.outerWidth(true) * _galleryItems.length );
		});
				
		function galleryIterator( _startElement ) {
			_currentElement = _startElement;
			
			_currentElement.trigger('click');
			
			setInterval(function() {
				_currentElement = _currentElement.parent().parent().next().find('a');
				
				if ( !_currentElement.length ) {
					_currentElement = _startElement;
				}
				
				_currentElement.trigger('click');
			}, 8500);
		}
		
		$(window).load(function() { // considering that the DOM is ALWAYS ready before content loaded, this prevents that weird gallery behavior.
			$('.gallery').each(function(){
				var _thisGallery = $(this);
				
				galleryIterator( _thisGallery.find('a:first') );
			});
		});
	}
	
	/* ROTATING FEATURE IMAGE FUNCTIONALITY (BELOW MENU, OWN SECTION) */
	/*var aspectRatio = 3/2, // width/height ratio
		slideShowWidth = $('#featuredRotatingImages .ngg-slideshow').width(),
		slideShowHeight = slideShowWidth/aspectRatio;
	
	$('#featuredRotatingImages .ngg-slideshow').height(slideShowHeight);
	$('#featuredRotatingImages img').each(function() {
		var _thisImg = $(this),
			imgToContainerRatio_width = _thisImg.width() / _thisImg.parent().width(),
			imgToContainerRatio_height = _thisImg.height() / _thisImg.parent().height();
		
		if (imgToContainerRatio_height < imgToContainerRatio_width) {
			//set height and center align horizontally.
			_thisImg.height(_thisImg.parent().height());
			_thisImg.css({'width':'auto'});
			_thisImg.css({'margin-left':'-'+( (_thisImg.width() - _thisImg.parent().width())/2 )+'px'});
		}
		else if (imgToContainerRatio_height > imgToContainerRatio_width) {
			//set width and center align vertically.
			_thisImg.width(_thisImg.parent().width());
			_thisImg.css({'height':'auto'});
			_thisImg.css({'margin-top':'-'+( (_thisImg.height() - _thisImg.parent().height())/2 )+'px'});
		}
		else if (imgToContainerRatio_height == imgToContainerRatio_width) {
			//set width and center align vertically.
			_thisImg.width(_thisImg.parent().width());
			_thisImg.css({'height':'auto'});
			_thisImg.css({'margin-top':'-'+( (_thisImg.height() - _thisImg.parent().height())/2 )+'px'});
		}
	});*/
	
	
	/* Remove the <br> tag before the checkout link in the cart widget so that the "Edit Cart" and "Checkout" links are inline.*/
	$('.widget .checkoutlink').prev().remove();
	$('.button.eshopbutton').on('click', function() {
		setTimeout(function() {
			$('.widget .checkoutlink').prev().remove();
		}, 2000);
	});
	
	/*FOOTER FUNCTIONALITY (AUTOHIDE EFFECT)*/
	/*var _footer = $('#footer'),
		footerHeight = _footer.outerHeight(),
		footerInitialPosition = footerHeight-10,
		footerHidden = true;
	
	_footer.css({'bottom':'-'+footerInitialPosition+'px'});
	$(document).on('mousemove', function(event) {
		if (_footer.offset().top-event.pageY <= 20+footerHeight && footerHidden) {
			footerHidden = false;
			_footer.stop().animate({
				bottom:'0px'
			}, function() {setFaceBoundaries()});
		}
		else if (_footer.offset().top-event.pageY > 20 && !footerHidden) {
			footerHidden = true;
			_footer.stop().animate({
				bottom:'-'+footerInitialPosition+'px'
			});
		}
	});*/
	
	/* LINK TO MY SITE */
	$('#joePea').on('click', function() {
		window.location = 'http://trusktr.iaesr.com';
	});
	
	$(window).load(function() {
		$(window).trigger('resize');
	});
	
});



	













