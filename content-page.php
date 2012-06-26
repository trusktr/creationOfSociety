




<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entryHeader">
		<h1 class="entryTitle"><?php the_title(); ?></h1>
	</header><!-- .entryHeader -->

	<div class="entryBody">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entryBody -->
	
	<footer class="entryFooter">
		<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entryFooter -->
											
	<?php comments_template('', true); ?>
</article><!-- #post-<?php the_ID(); ?> -->




