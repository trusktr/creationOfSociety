





//alert('IE8 -> GCF');
// You may want to place these lines inside an onload handler
jQuery(document).ready(function($) {
});

(function($) {
	CFInstall.check({
		mode: "overlay"
	});
	
	function chromeFrameReady() {
		$('#chromeFrameCloseButton').remove();
		$('.chromeFrameOverlayCloseBar > td').html('<span>To view this site, Internet Explorer needs Chrome Frame by Google.</span> It is free and installs in seconds.');
		$('.chromeFrameOverlayCloseBar > td').css({
			'color':'black',
		});
		$('.chromeFrameOverlayCloseBar > td > span').css({
			'color':'red',
			'font-size':'24px',
			'font-weight':'bold',
			'font-family':'BebasNeueRegular, Arial Black, Arial'
		});
	}
	
	var chromeFrameReadyInterval = setInterval(function() {
		if ( $('#chromeFrameCloseButton').length ) {
			chromeFrameReady();
			clearInterval(chromeFrameReadyInterval);
		}
	}, 500);
})(jQuery);









