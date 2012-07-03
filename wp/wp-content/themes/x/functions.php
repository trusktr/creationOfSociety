


<?php

	// Disable WordPress version reporting as a basic protection against attacks
	function remove_generators() {
		return '';
	}		
	add_filter('the_generator','remove_generators');

	//allow featured images.
	add_theme_support( 'post-thumbnails' );

	// Disable the admin bar, set to true if you want it to be visible.
	show_admin_bar(FALSE);

	// Custom shortcodes for end user.
	//include('shortcodes.php');

	// Add theme support for Automatic Feed Links
	add_theme_support( 'automatic-feed-links' );

	//allow custom navigation
	add_theme_support('nav-menus');
	register_nav_menus( array(
		'primary' => 'Primary Menu',
	));
	register_nav_menus( array(
		'footer' => 'Footer Menu',
	));
	
	
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'savage' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="content">',
		'after_widget' => "</div></aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	class My_Walker_Nav_Menu extends Walker_Nav_Menu {
		function start_lvl(&$output, $depth) {
			$indent = str_repeat("\t", $depth);
			$output .= "\n$indent<ul class=\"\">\n";
		}
	}
	
	if ( ! function_exists( 'savage_comment' ) ) :
	/**
	 * Template for comments and pingbacks.
	 *
	 * To override this walker in a child theme without modifying the comments template
	 * simply create your own savage_comment(), and that function will be used instead.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @since Twenty Eleven 1.0
	 */
	function savage_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
		?>
		<li class="post pingback">
			<p><?php _e( 'Pingback:', 'twentyeleven' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?></p>
		<?php
				break;
			default :
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<article id="comment-<?php comment_ID(); ?>" class="comment">
				<footer class="comment-meta">
					<div class="comment-author vcard">
						<?php
							$avatar_size = 68;
							if ( '0' != $comment->comment_parent )
								$avatar_size = 39;

							echo get_avatar( $comment, $avatar_size );

							/* translators: 1: comment author, 2: date and time */
							printf( __( '%1$s on %2$s <span class="says">said:</span>', 'twentyeleven' ),
								sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
								sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
									esc_url( get_comment_link( $comment->comment_ID ) ),
									get_comment_time( 'c' ),
									/* translators: 1: date, 2: time */
									sprintf( __( '%1$s at %2$s', 'twentyeleven' ), get_comment_date(), get_comment_time() )
								)
							);
						?>
					</div><!-- .comment-author .vcard -->

					<?php if ( $comment->comment_approved == '0' ) : ?>
						<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentyeleven' ); ?></em>
						<br />
					<?php endif; ?>

				</footer>

				<div class="comment-content"><?php comment_text(); ?></div>

				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'twentyeleven' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .reply -->

				<div class="edit">
					<?php edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
				</div>
			</article><!-- #comment-## -->

		<?php
				break;
		endswitch;
	}
	endif; // ends check for savage_comment()

	// Custom Pagination
	/**
	 * Retrieve or display pagination code.
	 *
	 * The defaults for overwriting are:
	 * 'page' - Default is null (int). The current page. This function will
	 *      automatically determine the value.
	 * 'pages' - Default is null (int). The total number of pages. This function will
	 *      automatically determine the value.
	 * 'range' - Default is 3 (int). The number of page links to show before and after
	 *      the current page.
	 * 'gap' - Default is 3 (int). The minimum number of pages before a gap is 
	 *      replaced with ellipses (...).
	 * 'anchor' - Default is 1 (int). The number of links to always show at begining
	 *      and end of pagination
	 * 'before' - Default is '<div class="emm-paginate">' (string). The html or text 
	 *      to add before the pagination links.
	 * 'after' - Default is '</div>' (string). The html or text to add after the
	 *      pagination links.
	 * 'next_page' - Default is '__('&raquo;')' (string). The text to use for the 
	 *      next page link.
	 * 'previous_page' - Default is '__('&laquo')' (string). The text to use for the 
	 *      previous page link.
	 * 'echo' - Default is 1 (int). To return the code instead of echo'ing, set this
	 *      to 0 (zero).
	 *
	 * @author Eric Martin <eric@ericmmartin.com>
	 * @copyright Copyright (c) 2009, Eric Martin
	 * @version 1.0
	 *
	 * @param array|string $args Optional. Override default arguments.
	 * @return string HTML content, if not displaying.
	 */
	function emm_paginate($args = null) {
		$defaults = array(
			'page' => null, 'pages' => null, 
			'range' => 3, 'gap' => 3, 'anchor' => 1,
			'before' => '<ul class="pagination">', 'after' => '</ul>',
			'title' => __('<li class="unavailable"></li>'),
			'nextpage' => __('Older &raquo;'), 'previouspage' => __('&laquo Newer'),
			'echo' => 1
		);

		$r = wp_parse_args($args, $defaults);
		extract($r, EXTR_SKIP);

		if (!$page && !$pages) {
			global $wp_query;

			$page = get_query_var('paged');
			$page = !empty($page) ? intval($page) : 1;

			$posts_per_page = intval(get_query_var('posts_per_page'));
			$pages = intval(ceil($wp_query->found_posts / $posts_per_page));
		}
	
		$output = "";
		if ($pages > 1) {	
			$output .= "$before<li>$title</li>";
			$ellipsis = "<li class='unavailable'>...</li>";

			if ($page > 1 && !empty($previouspage)) {
				$output .= "<li><a href='" . get_pagenum_link($page - 1) . "'>$previouspage</a></li>";
			}
		
			$min_links = $range * 2 + 1;
			$block_min = min($page - $range, $pages - $min_links);
			$block_high = max($page + $range, $min_links);
			$left_gap = (($block_min - $anchor - $gap) > 0) ? true : false;
			$right_gap = (($block_high + $anchor + $gap) < $pages) ? true : false;

			if ($left_gap && !$right_gap) {
				$output .= sprintf('%s%s%s', 
					emm_paginate_loop(1, $anchor), 
					$ellipsis, 
					emm_paginate_loop($block_min, $pages, $page)
				);
			}
			else if ($left_gap && $right_gap) {
				$output .= sprintf('%s%s%s%s%s', 
					emm_paginate_loop(1, $anchor), 
					$ellipsis, 
					emm_paginate_loop($block_min, $block_high, $page), 
					$ellipsis, 
					emm_paginate_loop(($pages - $anchor + 1), $pages)
				);
			}
			else if ($right_gap && !$left_gap) {
				$output .= sprintf('%s%s%s', 
					emm_paginate_loop(1, $block_high, $page),
					$ellipsis,
					emm_paginate_loop(($pages - $anchor + 1), $pages)
				);
			}
			else {
				$output .= emm_paginate_loop(1, $pages, $page);
			}

			if ($page < $pages && !empty($nextpage)) {
				$output .= "<li><a href='" . get_pagenum_link($page + 1) . "'>$nextpage</a></li>";
			}

			$output .= $after;
		}

		if ($echo) {
			echo $output;
		}

		return $output;
		echo '<br /><br />';
	}

	/**
	 * Helper function for pagination which builds the page links.
	 *
	 * @access private
	 *
	 * @author Eric Martin <eric@ericmmartin.com>
	 * @copyright Copyright (c) 2009, Eric Martin
	 * @version 1.0
	 *
	 * @param int $start The first link page.
	 * @param int $max The last link page.
	 * @return int $page Optional, default is 0. The current page.
	 */
	function emm_paginate_loop($start, $max, $page = 0) {
		$output = "";
		for ($i = $start; $i <= $max; $i++) {
			$output .= ($page === intval($i)) 
				? "<li class='current'><a href='#'>$i</a></li>" 
				: "<li><a href='" . get_pagenum_link($i) . "'>$i</a></li>";
		}
		return $output;
	} 

?>




