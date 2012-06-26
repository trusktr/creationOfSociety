<?php

if( !class_exists( 'CD_FBSP_Activity_Widget' ) )
{
	class CD_FBSP_Activity_Widget extends WP_Widget
	{
		function CD_FBSP_Activity_Widget()
		{
			$widget_ops = array(
				'classname' 	=> 'cd-fb-activity-widget',
				'description' 	=> __('Displays a Facebook Activity Feed', 'cd-fbspw' )
			);
			
			$this->WP_Widget( 'CD_FBSP_Activity_Widget', __( 'Facebook Activity Feed', 'cd-fbspw' ), $widget_ops );
		}
		
		function form( $instance )
		{
			$defaults = array(
				'title'				=> 'Activity',
				'url' 				=> get_bloginfo('url'),
				'width'				=> 300,
				'height'			=> 300, 
				'border_color' 		=> '',
				'color_scheme' 		=> 'light',
				'show_header' 		=> 'off',
				'show_recommendations' => 'on',
				'font' 				=> '',
			);
			
			$instance = wp_parse_args( (array) $instance, $defaults );
			extract( $instance );
			
			?>
			<p>
				<label for="cd-fba-title"><?php _e( 'Title:', 'cd-fbspw' ); ?></label>
				<input id="cd-fba-title" class="widefat" name="<?php echo $this-> get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			<p>
				<label for="cd-fba-url"><?php _e( 'Domain:', 'cd-fbspw' ); ?></label>
				<input id="cd-fba-url" class="widefat" name="<?php echo $this-> get_field_name( 'url' ); ?>" type="text" value="<?php echo esc_attr( $url ); ?>" />
			</p>
			<p>
				<label for="cd-fba-width"><?php _e( 'Width:', 'cd-fbspw' ); ?></label>
				<input id="cd-fba-width" class="widefat" name="<?php echo $this->get_field_name( 'width' ); ?>" type="text" value="<?php echo esc_attr( $width ); ?>" />
			</p>
			<p>
				<label for="cd-fba-height"><?php _e( 'Height:', 'cd-fbspw' ); ?></label>
				<input id="cd-fba-height" class="widefat" name="<?php echo $this->get_field_name( 'height' ); ?>" type="text" value="<?php echo esc_attr( $height ); ?>" />
			</p>
			<p>
				<label for="cd-fba-border"><?php  _e( 'Border Color:', 'cd-fbspw' ); ?></label>
				<input id="cd-fba-border" class="widefat" name="<?php echo $this->get_field_name( 'border_color' ); ?>" type="text" value="<?php echo esc_attr( $border_color ); ?>" />
			</p>
			<p>
				<label for="cd-fba-color"><?php _e( 'Color Scheme:', 'cd-fbswp' ); ?></label>
				<select id="cd-fba-color" name="<?php echo $this->get_field_name( 'color_scheme' ); ?>">
					<option value="light" <?php selected( $color_scheme, 'light' ); ?>><?php _e( 'Light', 'cd-fbspw' ); ?></option>
					<option value="dark" <?php selected( $color_scheme, 'dark' ); ?>><?php _e( 'Dark', 'cd-fbspw' ); ?></option>
				</select>
			</p>
			<p>
				<label for="cd-fba-font"><?php _e( 'Font', 'cd-fbspw' ); ?></label>
				<select id="cd-fba-font" name="<?php echo $this->get_field_name( 'font' ); ?>">
					<option value="" <?php selected( $font, '' ); ?>>&nbsp;</option>
					<option value="arial" <?php selected( $font, 'arial' ); ?>>Arial</option>
					<option value="lucida grande" <?php selected( $font, 'lucida grande' ); ?>>Lucida Grande</option>
					<option value="segoe ui" <?php selected( $font, 'segoe ui' ); ?>>Segoe ui</option>
					<option value="tahoma" <?php selected( $font, 'tahoma' ); ?>>Tahoma</option>
					<option value="trebuchet ms" <?php selected( $font, 'trebuchet ms' ); ?>>Trebuchet ms</option>
					<option value="verdana" <?php selected( $font, 'verdana' ); ?>>Verdana</option>
				</select>
			</p>
			<p>
				<input id="cd-fba-header" name="<?php echo $this->get_field_name( 'show_header' ); ?>" type="checkbox" <?php checked( $show_header, 'on' ); ?> />
				<label for="cd-fba-header"><?php _e( 'Check to show the facebook header', 'cd-fbspw' ); ?></label>
			</p>
			<p>
				<input id="cd-fba-recommendations" name="<?php echo $this->get_field_name( 'show_recommendations' ); ?>" type="checkbox" <?php checked( $show_recommendations, 'on' ); ?> />
				<label for="cd-fba-recommendations"><?php _e( 'Check this box to show recommendations', 'cd-fbspw' ); ?></label>
			</p>
			<?php	
		}
		
		function update( $new_instance, $old_instance )
		{
			$instance = $old_instance;
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['url'] = isset( $new_instance['url'] ) ? esc_url( $new_instance['url'], array( 'http', 'https' ) ) : '';
			$instance['width'] = absint( $new_instance['width'] );
			$instance['height'] = absint( $new_instance['height'] );
			$instance['border_color'] = strip_tags( $new_instance['border_color'] );
			$instance['color_scheme'] = strip_tags( $new_instance['color_scheme'] );
			$instance['font'] = isset( $new_instance['font'] ) ? strip_tags( $new_instance['font'] ) : '';
			$instance['show_header'] = isset(  $new_instance['show_header'] ) && $new_instance['show_header'] ? 'on' : 'off';
			$instance['show_recommendations'] = isset( $new_instance['show_recommendations'] ) && $new_instance['show_recommendations'] ? 'on' : 'off';
			
			return $instance;
		}
		
		function widget( $args, $instance )
		{
			extract( $args );
			
			// Get our widget variables
			$title = apply_filters( 'widget_title', $instance['title'] );
			$width = empty( $instance['width'] ) ? ' width="300"' : ' width="' . $instance['width'] . '"';
			$height = empty( $instance['height'] ) ? ' height="300"' : ' height="' . $instance['height'] . '"';
			$url = empty( $instance['url'] ) ? ' site="http://wordpress.org/"' : ' site="' . $instance['url'] . '"';
			$border = empty( $instance['border_color'] ) ? ' border_color=""' : ' border_color="' . $instance['border_color'] . '"';
			$color = $instance['color_scheme'] == 'light' ? '' : ' colorscheme="dark"';
			$font = empty( $instance['font'] ) ? '' : ' font="'. $instance['font'] . '"';
			$header = $instance['show_header'] == 'on' ? ' header="true"' : ' header="false"';
			$recommendations = $instance['show_recommendations'] == 'on' ? ' recommendations="true"' : ' recommendations="false"';
			
			// Render the widget
			echo $before_widget;
			if( !empty( $title ) )
			{
				echo $before_title . $title . $after_title;
			}
			echo '<fb:activity' . $url . $width . $height . $border . $color . $font . $header . $recommendations . '></fb:activity>';
			echo $after_widget;
		}
	} // end class
	
	/**
	* Register the widget here to make sure we get the right class...
	*/
	add_action( 'widgets_init', 'cd_fbsp_activity_register' );
	function cd_fbsp_activity_register()
	{		
		register_widget( 'CD_FBSP_Activity_Widget' );
	}
	
} // end class_exists
