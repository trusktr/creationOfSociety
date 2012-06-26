<?php
/*
Plugin Name: The Gallery Shortcode
Description: WP's built-in [gallery] shortcode, upgraded.
Author: Hassan Derakhshandeh
Version: 0.1
Author URI: http://tween.ir/


		* 	Copyright (C) 2011  Hassan Derakhshandeh
		*	http://tween.ir/
		*	hassan.derakhshandeh@gmail.com

		This program is free software; you can redistribute it and/or modify
		it under the terms of the GNU General Public License as published by
		the Free Software Foundation; either version 2 of the License, or
		(at your option) any later version.

		This program is distributed in the hope that it will be useful,
		but WITHOUT ANY WARRANTY; without even the implied warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
		GNU General Public License for more details.

		You should have received a copy of the GNU General Public License
		along with this program; if not, write to the Free Software
		Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

class Gallery_Shortcode {

	private $base_url;

	function __construct() {
		add_action( 'wp_default_scripts', array( &$this, 'admin_script' ), -100 );
		add_action( 'admin_init', array( &$this, 'admin_init' ) );
		add_shortcode( 'gallery', array( &$this, 'shortcode' ) );
		add_action( 'template_redirect', array( &$this, 'css' ) );
		$this->base_url = trailingslashit( plugins_url( '', __FILE__ ) );
	}

	function admin_script( &$scripts ) {
		$scripts->add( 'admin-gallery', $this->base_url . 'js/gallery.js', array( 'jquery-ui-sortable' ), '0.1' );
	}

	function admin_init() {
		remove_filter( 'media_upload_gallery', 'media_upload_gallery' );
		add_filter( 'media_upload_gallery', array( &$this, 'media_upload_gallery' ) );
	}

	function media_upload_gallery() {
		$errors = array();

		if ( !empty($_POST) ) {
			$return = media_upload_form_handler();

			if ( is_string($return) )
				return $return;
			if ( is_array($return) )
				$errors = $return;
		}

		wp_enqueue_script( 'admin-gallery' );
		return wp_iframe( array( &$this, 'media_upload_gallery_form' ), $errors );
	}

	function media_upload_gallery_form( $errors ) {
		global $redir_tab, $type;

		$redir_tab = 'gallery';
		media_upload_header();

		$post_id = intval($_REQUEST['post_id']);
		$form_action_url = admin_url("media-upload.php?type=$type&tab=gallery&post_id=$post_id");
		$form_action_url = apply_filters('media_upload_form_url', $form_action_url, $type);
		$form_class = 'media-upload-form validate';

		if ( get_user_setting('uploader') )
			$form_class .= ' html-uploader';

		require_once( dirname( __FILE__ ) . '/view/gallery_form.php' );
	}

	/**
	 * Gallery Shortcode
	 *
	 * The gallery shortcode has been modified to output <figure> and <figcaption>
	 * and also links to the image file by default rather than the attachment page.
	 *
	 * @since 0.2 added the start and end parameters, also,
	 * CSS styles are disabled by default, use css parameter to include them.
	 */
	function shortcode( $attr ) {
		global $post, $wp_locale;

		static $gallery_instance = 0;
		$gallery_instance++;

		// Allow plugins/themes to override the default gallery template.
		$output = apply_filters( 'post_gallery', '', $attr );
		if ( $output != '' )
			return $output;

		// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
		if ( isset( $attr['orderby'] ) ) {
			$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
			if ( !$attr['orderby'] )
				unset( $attr['orderby'] );
		}

		extract( shortcode_atts( array(
			'order'				=> 'ASC',
			'orderby'			=> 'menu_order ID',
			'id'				=> $post->ID,
			'container'			=> 'section',
			'container_class'	=> '',
			'icontag'			=> 'figure',
			'icon_class'		=> 'gallery-item',
			'show_caption'		=> 1,
			'caption'			=> 'excerpt', /* what to use as caption, can also be 'title' */
			'captiontag'		=> 'figcaption',
			'caption_class'		=> 'gallery-caption',
			'columns'			=> 3,
			'size'				=> 'thumbnail',
			'include'			=> '',
			'exclude'			=> '',
			'start'				=> 0,
			'end'				=> 10000,
			'link'				=> 'file', /* file, attachment, none */
			'before'			=> '<div class="gallery">',
			'after'				=> '</div>',
			'items_per_page'	=> 0, /* 0 mean no pagination, show all images at once */
		), $attr ) );

		$id = intval( $id );
		if ( 'RAND' == $order )
			$orderby = 'none';

		if ( !empty($include) ) {
			$include = preg_replace( '/[^0-9,]+/', '', $include );
			$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

			$attachments = array();
			foreach ( $_attachments as $key => $val ) {
				$attachments[$val->ID] = $_attachments[$key];
			}
		} elseif ( !empty($exclude) ) {
			$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
			$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		} else {
			$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
		}

		if ( empty($attachments) )
			return '';

		if ( is_feed() ) {
			$output = "\n";
			foreach ( $attachments as $att_id => $attachment )
				$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
			return $output;
		}

		$captiontag = tag_escape( $captiontag );
		$columns = intval($columns);

		$selector = "gallery-{$gallery_instance}";

		$size_class = sanitize_html_class( $size );
		$output = '';
		if( $container_class == '' ) $container_class = "clearfix gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}";
		if( $container ) $output = "<{$container} id='{$selector}' class='{$container_class}'>";

		$i = 0;
		$counter = -1;

		// paginated
		if( $items_per_page > 0 ) {
			if( ! isset( $_GET['gallery_page'] ) || $_GET['gallery_page'] == 1 ) {
				$start = 0;
				$end = $items_per_page - 1;
				$page = 1;
			} else {
				$page = $_GET['gallery_page'];
				$start = ( $page - 1 ) * $items_per_page;
				$end = ( $page * $items_per_page ) - 1;
			}
		}

		foreach ( $attachments as $id => $attachment ) {
			$counter++;
			if ( $counter >= $start and $counter <= $end and $id != $thumb_id ) {

				// make the gallery link to the file by default instead of the attachment
				// thanks to Matt Price (countingrows.com)
				if( $link == 'none' ) {
					$image = wp_get_attachment_image( $id, $size );
				} elseif( $link == 'attachment' ) {
					$image = wp_get_attachment_link( $id, $size, true, false );
				} else {
					$image = wp_get_attachment_link( $id, $size, false, false );
				}

				// open each gallery row
				if ( $columns > 0 && $i % $columns == 0 )
					$output .= '<div class="gallery-row">';

				$output .= "
					<{$icontag} class=\"{$icon_class}\">
						{$image}
					";
				if ( $show_caption ) {
					$caption_text = ( $caption == 'title' ) ? $attachment->post_title : $attachment->post_excerpt;
					$output .= "
						<{$captiontag} class=\"{$caption_class}\">
						" . wptexturize( $caption_text ) . "
						</{$captiontag}>";
				}
				$output .= "</{$icontag}>";

				// close .gallery-row div
				if ( $columns > 0 && ++$i % $columns == 0 )
					$output .= '</div>';
			}
		}

		if( $container ) $output .= "</{$container}>\n";

		// pagination links
		if( $items_per_page > 0 && ( $count = count( $attachments ) ) > $items_per_page ) {
			$pages = ceil( $count / $items_per_page );
			$pagination = '<div class="pagination"><ul>';
			for( $i = 1; $i <= $pages; $i++ ) {
				$classes = array();
				if( $page == $i ) $classes[] = 'active';
				$pagination .= sprintf( '<li class="%s"><a href="%s"><span>%s</span></a></li>', implode( ' ', $classes ), add_query_arg( array( 'gallery_page' => $i ) ), $i );
			}
			$pagination .= '</ul></div>';
			$output .= $pagination;
		}

		return $before . $output . $after;
	}

	function css() {
		if( file_exists( TEMPLATEPATH . '/css/gallery.css' ) )
			wp_enqueue_style( 'gallery-shortcode', get_template_directory_uri() . '/css/gallery.css' );
		else
			wp_enqueue_style( 'gallery-shortcode', $this->base_url . 'css/gallery.css' );

		wp_enqueue_style( 'gallery-pagination', $this->base_url . 'css/pagination.css' );
	}
}
new Gallery_Shortcode;