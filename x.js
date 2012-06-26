

var _x = $('#x'),
	_buffer = $('<div>'),
	
	bgImg = $('<img class="tmpImg" src="http://creationofsociety.com/wp/wp-content/uploads/2012/06/cos_flyer_back.jpg" alt="" />');



function when_images_loaded(_imgContainer, callback) { // (LATEST) 2.0 // do callback when images in _imgContainer are loaded. Only works when ALL images in _imgContainer are newly inserted images and this function is called immediately after images are inserted into the target.
	_imgContainer.html(_imgContainer.html()); // This ensures that everything in _imgContainer is newly inserted so that the load event can be attached to each image in _imgContainer before the load events fire for each image. If the images are already loaded by the browser, this also ensure that the load event fires anyways... I wonder why?...
	var _imgs = _imgContainer.find('img'),
		img_length = _imgs.length,
		img_load_cntr = 0;

	if (img_length) { //if the _imgContainer contains new images.
		_imgs.on('load', function() { //then we avoid the callback until images are loaded
			img_load_cntr++;
			if (img_load_cntr == img_length) {
				callback();
			}
		});
	}
	else { //otherwise just do the main callback action if there's no images in _imgContainer.
		callback();
	}
}
function when_content_loaded(_contentContainer, callback) { // (LATEST) 1.0 // do callback when content in _contentContainer are loaded. Only works when ALL onload-enabled content in _contentContainer are newly inserted content and this function is called immediately after content is inserted into the target.
	_contentContainer.html(_contentContainer.html()); // This ensures that everything in _contentContainer is newly inserted so that the load event can be attached to each image in _contentContainer before the load events fire for each image. If the onload-enabled content is already loaded by the browser, this also ensure that the load event fires anyways... I wonder why?...
	var _content = _contentContainer.find('img, iframe, frame, script'),
		content_length = _content.length,
		content_load_cntr = 0;

	if (content_length) { //if the _contentContainer contains new onload-enabled content.
		_content.on('load', function() { //then we avoid the callback until onload-enabled content is loaded
			content_load_cntr++;
			if (content_load_cntr == content_length) {
				console.log('ONE!');
				callback();
			}
		});
	}
	else { //otherwise just do the main callback action if there's no onload-enabled content in _contentContainer.
		console.log('TWO!');
		callback();
	}
}


$(window).on('load', function() {
	_buffer.load(location.protocol+'//'+location.host+'/wp/?cat=3', function() {
		
		_buffer.append(bgImg);
		
		/*Set a 3 second delay to allow users to view the load nice animation :D.*/
		setTimeout(function() {
			when_content_loaded(_buffer, function() {
				console.log('Site loaded.');
				_x.append(_buffer.contents());
				$('.tmpImg').remove();
				$('#cubeLoader').fadeToggle(function() {
					_x.toggle(400);
				});
			});
		}, 3000);
	});
});
















