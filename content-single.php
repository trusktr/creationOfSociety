


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
		
		

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entryHeader">
					<h1 class="entryTitle"><?php the_title(); ?></h1>

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
				</header><!-- .entryHeader -->

				<div class="entryBody">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
				</div><!-- .entryBody -->

				<footer class="entryFooter">
					<?php
						/* translators: used between list items, there is a space after the comma */
						$categories_list = get_the_category_list( __( ', ', 'twentyeleven' ) );

						/* translators: used between list items, there is a space after the comma */
						$tag_list = get_the_tag_list( '', __( ', ', 'twentyeleven' ) );
						if ( '' != $tag_list ) {
							$utility_text = __( 'This entry was posted in %1$s and tagged %2$s by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyeleven' );
						} elseif ( '' != $categories_list ) {
							$utility_text = __( 'This entry was posted in %1$s by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyeleven' );
						} else {
							$utility_text = __( 'This entry was posted by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyeleven' );
						}

						printf(
							$utility_text,
							$categories_list,
							$tag_list,
							esc_url( get_permalink() ),
							the_title_attribute( 'echo=0' ),
							get_the_author(),
							esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )
						);
					?>
					<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>

					<?php if ( get_the_author_meta( 'description' ) && ( ! function_exists( 'is_multi_author' ) || is_multi_author() ) ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries ?>
					<div id="authorInfo">
						<div id="authorAvatar">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyeleven_author_bio_avatar_size', 68 ) ); ?>
						</div><!-- #authorAvatar -->
						<div id="authorDescription">
							<h2><?php printf( __( 'About %s', 'twentyeleven' ), get_the_author() ); ?></h2>
							<?php the_author_meta( 'description' ); ?>
							<div id="authorLink">
								<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
									<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'twentyeleven' ), get_the_author() ); ?>
								</a>
							</div><!-- #authorLink	-->
						</div><!-- #authorDescription -->
					</div><!-- #entry-authorInfo -->
					<?php endif; ?>
				</footer><!-- .entryFooter -->
														
				<?php comments_template('', true); ?>
			</article><!-- #post-<?php the_ID(); ?> -->

			

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



