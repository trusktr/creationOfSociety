<?php

if( !class_exists( 'CD_FBSP_Like_Widget' ) )
{
	class CD_FBSP_Like_Widget extends WP_Widget
	{
		function CD_FBSP_Like_Widget()
		{
			$widget_ops = array(
				'classname' 	=> 'cd-fb-like-widget',
				'description' 	=> __('Displays a Facebook Like Box', 'cd-fbspw' ),
			);
			
			$this->WP_Widget( 'CD_FBSP_Like_Widget', __('Facebook Like Box', 'cd-fbspw' ), $widget_ops );
		}
		
		function form( $instance )
		{
			$defaults = array(
				'title'			=> 'Find Us on Facebook',
				'url' 			=> 'http://www.facebook.com/WordPress',
				'width'			=> 300, 
				'color_scheme' 	=> 'light',
				'show_faces'	=> 'on',
				'border_color' 	=> '',
				'show_stream' 	=> 'on',
				'show_header' 	=> 'off',
				'height'		=> 400
			);
			
			$instance = wp_parse_args( (array) $instance, $defaults );
			extract( $instance );
			
			?>
			<p>
				<label for="cd-fb-title"><?php _e( 'Title:', 'cd-fbspw' ); ?></label>
				<input id="cd-fb-title" class="widefat" name="<?php echo $this-> get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			<p>
				<label for="cd-fb-url"><?php _e( 'Facebook URL to Like:', 'cd-fbspw' ); ?></label>
				<input id="cd-fb-url" class="widefat" name="<?php echo $this->get_field_name( 'url' ); ?>" type="text" value="<?php echo esc_attr( $url ); ?>" />
			</p>
			<p>
				<label for="cd-fb-width"><?php _e( 'Width:', 'cd-fbspw' ); ?></label>
				<input id="cd-fb-width" class="widefat" name="<?php echo $this->get_field_name( 'width' ); ?>" type="text" value="<?php echo esc_attr( $width ); ?>" />
			</p>
			<p>
				<label for="cd-fba-height"><?php _e( 'Height:', 'cd-fbspw' ); ?></label>
				<input id="cd-fba-height" class="widefat" name="<?php echo $this->get_field_name( 'height' ); ?>" type="text" value="<?php echo esc_attr( $height ); ?>" />
			</p>
			<p>
				<label for="cd-fb-border"><?php _e( 'Border Color:', 'cd-fbspw' ); ?></label>
				<input id="cd-fb-border" class="widefat" name="<?php echo $this->get_field_name( 'border_color' ); ?>" type="text" value="<?php echo esc_attr( $border_color ); ?>" />
			</p>
			<p>
				<label for="cd-fb-color"><?php _e( 'Color Scheme:', 'cd-fbspw' ); ?></label>
				<select id="cd-fb-color" name="<?php echo $this->get_field_name( 'color_scheme' ); ?>">
					<option value="light" <?php selected( $color_scheme, 'light' ); ?>><?php _e( 'Light', 'cd-fbspw' ); ?></option>
					<option value="dark" <?php selected( $color_scheme, 'dark' ); ?>><?php _e( 'Dark', 'cd-fbspw' ); ?></option>
				</select>
			</p>
			<p>
				<input id="cd-fb-faces" name="<?php echo $this->get_field_name( 'show_faces' ); ?>" type="checkbox" <?php checked( $show_faces, 'on' ); ?> />
				<label for="cd-fb-faces"><?php _e( 'Check to show faces', 'cd-fbspw' ); ?></label>
			</p>
			<p>
				<input id="cd-fb-stream" name="<?php echo $this->get_field_name( 'show_stream' ); ?>" type="checkbox" <?php checked( $show_stream, 'on' ); ?> />
				<label for="cd-fb-stream"><?php _e( 'Check to show the page activity stream', 'cd-fbspw' ); ?></label>
			</p>
			<p>
				<input id="cd-fb-header" name="<?php echo $this->get_field_name( 'show_header' ); ?>" type="checkbox" <?php checked( $show_header, 'on' ); ?> />
				<label for="cd-fb-header"><?php _e( 'Check to show the facebook header', 'cd-fbspw' ); ?></label>
			</p>
			<?php	
		}
		
		function update( $new_instance, $old_instance )
		{
			$instance = $old_instance;
			$instance['title'] = isset( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['url'] = isset( $new_instance['url'] ) ? esc_url( $new_instance['url'], array( 'http', 'https' ) ) : '';
			$instance['width'] = isset( $new_instance['width'] ) ? absint( $new_instance['width'] ) : 300;
			$instance['height'] = isset( $new_instance['height'] ) ? absint( $new_instance['height'] ) : 400;
			$instance['border_color'] = isset( $new_instance['border_color'] ) ? strip_tags( $new_instance['border_color'] ) : '';
			$instance['color_scheme'] = strip_tags( $new_instance['color_scheme'] );
			$instance['show_faces'] = isset( $new_instance['show_faces'] ) && $new_instance['show_faces'] ? 'on' : 'off';
			$instance['show_stream'] = isset( $new_instance['show_stream'] ) && $new_instance['show_stream'] ? 'on' : 'off';
			$instance['show_header'] = isset( $new_instance['show_header'] ) && $new_instance['show_header'] ? 'on' : 'off';
			
			return $instance;
		}
		
		function widget( $args, $instance )
		{
			extract( $args );
			
			// Get our widget variables
			$title = apply_filters( 'widget_title', $instance['title'] );
			$width = empty( $instance['width'] ) ? ' width="300"' : ' width="' . $instance['width'] . '"';
			$height = empty( $instance['height'] ) ? ' height="400"' : ' height="' . $instance['height'] . '"';
			$url = empty( $instance['url'] ) ? ' href="http://www.facebook.com/WordPress"' : ' href="' . $instance['url'] . '"';
			$border = empty( $instance['border_color'] ) ? ' border_color=""' : ' border_color="' . $instance['border_color'] . '"';
			$color = $instance['color_scheme'] == 'light' ? '' : ' colorscheme="dark"';
			$faces = $instance['show_faces'] == 'on' ? ' show_faces="true"' : ' show_faces="false"';
			$stream = $instance['show_stream'] == 'on' ? ' stream="true"' : ' stream="false"';
			$header = $instance['show_header'] == 'on' ? ' header="true"' : ' header="false"';
			
			// Render the widget
			echo $before_widget;
			if( !empty( $title ) )
			{
				echo $before_title . $title . $after_title;
			}
			echo '<fb:like-box' . $url . $width . $height . $border . $color . $faces . $stream . $header . '></fb:like-box>';
			echo $after_widget;
		}
	} // end class
	
	/**
	* Register the widget here to make sure we get the right class...
	*/
	add_action( 'widgets_init', 'cd_fbsp_like_register' );
	function cd_fbsp_like_register()
	{		
		register_widget( 'CD_FBSP_Like_Widget' );
	}
	
} // end class_exists
