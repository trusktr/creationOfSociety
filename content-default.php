


<?php if ( have_posts() ) : ?>

	<?php //twentyeleven_content_nav( 'nav-above' ); ?>

	<!-- Begin Pagination -->
		<?php if (function_exists("emm_paginate")) {
			emm_paginate();
		} ?>
	<!-- End Pagination -->
	
	<div class="content">

		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
		
		

			<article <?php post_class(); ?>>
				<header class="entryHeader">
					<?php if ( is_sticky() ) : ?>
						<hgroup>
							<h2 class="entryTitle"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyeleven' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
							<h3 class="entry-format"><?php _e( 'Featured', 'twentyeleven' ); ?></h3>
						</hgroup>
					<?php else : ?>
						<h1 class="entryTitle"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyeleven' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
					<?php endif; ?>

					<?php if ( 'post' == get_post_type() ) : ?>
					<div class="entryMeta">
						<?php
						printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'twentyeleven' ),
							esc_url( get_permalink() ),
							esc_attr( get_the_time() ),
							esc_attr( get_the_date( 'c' ) ),
							esc_html( get_the_date() ),
							esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
							esc_attr( sprintf( __( 'View all posts by %s', 'twentyeleven' ), get_the_author() ) ),
							get_the_author()
						);
						?>
					</div><!-- .entryMeta -->
					<?php endif; ?>
				</header>
				
				<div class="entryBody">
					<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) ); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
				</div>
				
				<footer class="entryFooter">
					<?php
					$show_sep = false;
					/* translators: used between list items, there is a space after the comma */
					$categories_list = get_the_category_list( __( ', ', 'twentyeleven' ) );
					?>
					<?php if ( $categories_list ): ?>
						<span class="catLinks">
							<?php printf( __( '<span class="%1$s">Posted in</span> %2$s', 'twentyeleven' ), 'entry-utility-prep entry-utility-prep-catLinks', $categories_list );
							$show_sep = true; ?>
						</span>
					<?php endif; // End if categories ?>
					<?php
					/* translators: used between list items, there is a space after the comma */
					$tags_list = get_the_tag_list( '', __( ', ', 'twentyeleven' ) );
					?>
					<?php if ( $tags_list ): ?>
						<?php if ( $show_sep ) : ?>
							<span class="sep"> | </span>
						<?php endif; // End if $show_sep ?>
						<span class="tagLinks">
							<?php printf( __( '<span class="%1$s">Tagged</span> %2$s', 'twentyeleven' ), 'entry-utility-prep entry-utility-prep-tagLinks', $tags_list );
							$show_sep = true; ?>
						</span>
					<?php endif; // End if $tags_list ?>

					<?php if ( comments_open() ) : ?>
						<?php if ( $show_sep ) : ?>
							<span class="sep"> | </span>
						<?php endif; // End if $show_sep ?>
						<span class="commentsLink"><?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment &raquo;', 'twentyeleven' ) . '</span>', __( '<b>1</b> Comment &raquo;', 'twentyeleven' ), __( '<b>%</b> Comments &raquo;', 'twentyeleven' ) ); ?></span>
					<?php endif; // End if comments_open() ?>

					<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
				</footer>
														
				<?php comments_template('', true); ?>
				
			</article>

			

		<?php endwhile; ?>

	</div>

	<?php // twentyeleven_content_nav( 'nav-below' ); ?>

	<!-- Begin Pagination -->
		<?php if (function_exists("emm_paginate")) {
			emm_paginate();
		} ?>
	<!-- End Pagination -->
	
<?php else : ?>
	<div class="content">
		<article>Hello.</article>
	</div>
<?php endif; ?>


