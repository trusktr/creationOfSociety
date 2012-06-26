<?php
/*
Plugin Name: Easy Add Thumbnail
Plugin URI: http://wordpress.org/extend/plugins/easy-add-thumbnail/
Description: Checks if you defined the post thumbnail, and if not it sets the thumbnail to the first uploaded image for that post. So easy like that...
Author: Samuel Aguilera
Version: 1.0.1
Author URI: http://www.samuelaguilera.com
*/

/*
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License version 3 as published by
the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

if ( function_exists( 'add_theme_support' ) ) {

add_theme_support( 'post-thumbnails' );
      
      function easy_add_thumbnail() {
      
          global $post;
          
          $already_has_thumb = has_post_thumbnail();
         
              if (!$already_has_thumb)  {
                                        	     
              $attached_image = get_children( "post_parent=$post->ID&post_type=attachment&post_mime_type=image&numberposts=1" );

                          if ($attached_image) {
                      	
                                foreach ($attached_image as $attachment_id => $attachment) {                            	
                                add_post_meta($post->ID, '_thumbnail_id', $attachment_id, true);                                 
                                }     
                        
                           }
                         
                        }
      } // fin función

  add_action('the_post', 'easy_add_thumbnail');
 
  // hooks added to set the thumbnail when publishing too
  add_action('new_to_publish', 'easy_add_thumbnail');
  add_action('draft_to_publish', 'easy_add_thumbnail');
  add_action('pending_to_publish', 'easy_add_thumbnail');
  add_action('future_to_publish', 'easy_add_thumbnail');

} else {

    function eat_fail_requirements() {
   
      echo "<!-- Easy Add Thumbnail activated, but your WordPress doesn't support add_theme_support function -->";
    
    }
    
  add_action('wp_head', 'eat_fail_requirements');


}

?>