


<?php if ( have_posts() ) : ?>

	<?php //twentyeleven_content_nav( 'nav-above' ); ?>

	<!-- Begin Pagination -->
		<?php if (function_exists("emm_paginate")) {
			emm_paginate();
		} ?>
	<!-- End Pagination -->
	
	<div class="content row">

		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
		
		

			<div class="four columns">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entryHeader">
						<?php if ( has_post_thumbnail() ) { ?>
								<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyeleven' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_post_thumbnail('thumbnail'); ?></a>
						<?php } ?>
						<h1 class="entryTitle"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyeleven' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
					</header><!-- .entryHeader -->
					
					<div class="entryBody">
						<?php echo do_shortcode('[eshop_addtocart]'); ?>
					</div>
					
					<footer class="entryFooter">
						<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entryFooter -->
					
				</article><!-- #post-<?php the_ID(); ?> -->
			</div>

			

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




