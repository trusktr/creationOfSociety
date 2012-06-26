<?php

if( !class_exists( 'CD_FBSP_Recommends_Widget' ) )
{
	class CD_FBSP_Recommends_Widget extends WP_Widget
	{
		function CD_FBSP_Recommends_Widget()
		{
			$widget_ops = array(
				'classname' 	=> 'cd-fb-recommendation-widget',
				'description' 	=> __( 'Displays a Facebook Recommendations Box', 'cd-fbspw' )
			);
			
			$this->WP_Widget( 'CD_FBSP_Recommends_Widget', __( 'Facebook Recommendations', 'cd-fbspw' ), $widget_ops );
		}
		
		function form( $instance )
		{
			$defaults = array(
				'title'			=> 'Top Articles',
				'url' 			=> get_bloginfo('url'),
				'width'			=> 300,
				'height'		=> 300, 
				'border_color' 	=> '',
				'color_scheme' 	=> 'light',
				'show_header' 	=> 'off',
				'font' 			=> '',
			);
			
			$instance = wp_parse_args( (array) $instance, $defaults );
			extract( $instance );
			
			?>
			<p>
				<label for="cd-fbr-title"><?php _e( 'Title:', 'cd-fbspw' ); ?></label>
				<input id="cd-fbr-title" class="widefat" name="<?php echo $this-> get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			<p>
				<label for="cd-fbr-url"><?php _e( 'Domain:', 'cd-fbspw' ); ?></label>
				<input id="cd-fbr-url" class="widefat" name="<?php echo $this-> get_field_name( 'url' ); ?>" type="text" value="<?php echo esc_attr( $url ); ?>" />
			</p>
			<p>
				<label for="cd-fbr-width"><?php _e( 'Width:', 'cd-fbspw' ); ?></label>
				<input id="cd-fbr-width" class="widefat" name="<?php echo $this->get_field_name( 'width' ); ?>" type="text" value="<?php echo esc_attr( $width ); ?>" />
			</p>
			<p>
				<label for="cd-fbr-height"><?php _e( 'Height:', 'cd-fbspw' ); ?></label>
				<input id="cd-fbr-height" class="widefat" name="<?php echo $this->get_field_name( 'height' ); ?>" type="text" value="<?php echo esc_attr( $height ); ?>" />
			</p>
			<p>
				<label for="cd-fbr-border"><?php _e( 'Border Color:', 'cd-fbspw' ); ?></label>
				<input id="cd-fbr-border" class="widefat" name="<?php echo $this->get_field_name( 'border_color' ); ?>" type="text" value="<?php echo esc_attr( $border_color ); ?>" />
			</p>
			<p>
				<label for="cd-fbr-color"><?php _e( 'Color Scheme:', 'cd-fbspw' ); ?></label>
				<select id="cd-fbr-color" name="<?php echo $this->get_field_name( 'color_scheme' ); ?>">
					<option value="light" <?php selected( $color_scheme, 'light' ); ?>><?php _e( 'Light', 'cd-fbspw'); ?></option>
					<option value="dark" <?php selected( $color_scheme, 'dark' ); ?>><?php _e( 'Dark', 'cd-fbspw' ); ?></option>
				</select>
			</p>
			<p>
				<label for="cd-fbr-font"><?php _e( 'Font:', 'cd-fbspw' ); ?></label>
				<select id="cd-fbr-font" name="<?php echo $this->get_field_name( 'font' ); ?>">
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
				<input id="cd-fbr-header" name="<?php echo $this->get_field_name( 'show_header' ); ?>" type="checkbox" <?php checked( $show_header, 'on' ); ?> />
				<label for="cd-fbr-header"><?php _e( 'Check to show the facebook header', 'cd-fbspw' ); ?></label>
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
			$instance['font'] = isset( $new_instance['font'] ) ? strip_tags( $new_instance['font'] ) : '';
			$instance['show_header'] = isset( $new_instance['show_header'] ) && $new_instance['show_header'] ? 'on' : 'off';
			
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
			
			// Render the widget
			echo $before_widget;
			if( !empty( $title ) )
			{
				echo $before_title . $title . $after_title;
			}
			echo '<fb:recommendations' . $url . $width . $height . $border . $color . $font . $header . '></fb:recommendations>';
			echo $after_widget;
		}
	} // end class
	
	/**
	* Register the widget here to make sure we get the right class...
	*/
	add_action( 'widgets_init', 'cd_fbsp_recommends_register' );
	function cd_fbsp_recommends_register()
	{		
		register_widget( 'CD_FBSP_Recommends_Widget' );
	}
	
} // end class_exists
