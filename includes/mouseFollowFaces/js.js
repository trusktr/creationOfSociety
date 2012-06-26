var $ = jQuery.noConflict(); // in case another plugin messes with the jQuery '$' symbol.

var boundaries_top = new Array(),
    boundaries_right = new Array(),
    boundaries_bottom = new Array(),
    boundaries_left = new Array(),
    mouse_positions = new Array(),
    face_directions = new Array(),
	_faceContainers = $('.face_container');

function setFaceBoundaries() {
    _faceContainers.each(function() {
        
        var _this = $(this),
            this_imgHeight = _this.find('img:first').height(),
            this_imgWidth =  _this.find('img:first').width();
    	
    	console.log(' -- Face: '+_this.attr('data-id'));
        console.log('   - this_imgHeight: '+this_imgHeight);
        console.log('   - this_imgWidth: '+this_imgWidth);

        // _this.css({
            // 'height':''+this_imgHeight,
            // 'width':''+this_imgWidth
        // });

        //document the numberical boundaries for each image
        var this_index = _faceContainers.index(this),
            this_offset = _this.offset();
            
        console.log('   - this_index: '+this_index);
        console.log('   - this_offset: '+this_offset.top+' '+this_offset.left);

        boundaries_top[this_index] = this_offset.top /*+ this_imgHeight*0.26*/;
        boundaries_right[this_index] = this_offset.left + this_imgWidth/* *0.75*/;
        boundaries_bottom[this_index] = this_offset.top + this_imgHeight/* *0.75*/;
        boundaries_left[this_index] = this_offset.left /*+ this_imgWidth*0.26*/;
        mouse_positions[this_index] = 0; // initiate to no intial mouse position for this face
        face_directions[this_index] = 5; // initiate to middle middle face diretion for this face

    });
}

﻿$(window).load(function() {
        

    console.log('Calculating mouseFollowFaces image boundaries...');
    setFaceBoundaries();
	console.log('Done.');

  /*  $('.faces').each(function() {
        var _this = $(this);
        _this.css({
            'width':'auto', // set dynamically later
            'height':'auto' // set dynamically later
        });
    });*/

    $(document).on('mousemove', function(event) {

        // for each face, check the mouse position
        _faceContainers.each(function() {
            var _this = $(this),
                this_index = _faceContainers.index(this);

            var topY = false, middleY = false, bottomY = false, leftX = false, middleX = false, rightX = false;

            var previous_faceDirection = 0, new_faceDirection = 0;

            // determine the row
            if (event.pageY < boundaries_top[this_index]) {
                // top row
                topY = true;
            }
            else if (event.pageY >= boundaries_top[this_index] && event.pageY <= boundaries_bottom[this_index]) {
                // middle row
                middleY = true;
            }
            else if (event.pageY > boundaries_bottom[this_index]) {
                // bottom row
                bottomY = true;
            }

            // determine the column
            if (event.pageX < boundaries_left[this_index]) {
                // left column
                leftX = true;
            }
            else if (event.pageX >= boundaries_left[this_index] && event.pageX <= boundaries_right[this_index]) {
                // middle column
                middleX = true;
            }
            else if (event.pageX > boundaries_right[this_index]) {
                // right column
                rightX = true;
            }

            // match the row to column
            if (topY) {
                if (leftX) { // top left
                    mouse_positions[this_index] = 1;
                }
                else if (middleX) { // top middle
                    mouse_positions[this_index] = 2;
                }
                else if (rightX) { // top right
                    mouse_positions[this_index] = 3;
                }
            }
            else if (middleY) {
                if (leftX) { // middle left
                    mouse_positions[this_index] = 4;
                }
                else if (middleX) { // middle middle
                    mouse_positions[this_index] = 5;
                }
                else if (rightX) { // middle right
                    mouse_positions[this_index] = 6;
                }
            }
            else if (bottomY) {
                if (leftX) { // bottom left
                    mouse_positions[this_index] = 7;
                }
                else if (middleX) { // bottom middle
                    mouse_positions[this_index] = 8;
                }
                else if (rightX) { // bottom right
                    mouse_positions[this_index] = 9;
                }
            }

            //if we move to a new area, update the face direction
            if (face_directions[this_index] != mouse_positions[this_index]) {
                previous_faceDirection = face_directions[this_index];
                new_faceDirection = face_directions[this_index] = mouse_positions[this_index];
                //show the appropriate face direction
                // lower the z-index of previous face direction
                $('#face'+(this_index+1)+'_'+previous_faceDirection).css({'z-index':'0'});
                //raise the z-index of the new face direction
                $('#face'+(this_index+1)+'_'+new_faceDirection).css({'z-index':'1'});
            }
        });
    });


});

