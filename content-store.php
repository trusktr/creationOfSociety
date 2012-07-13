




<div class="four columns">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entryHeader">
		<h1 class="entryTitle"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyeleven' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	</header><!-- .entryHeader -->
	
	<div>
		<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail();
			}
		?>
	</div>
	
	<footer class="entryFooter">
		<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entryFooter -->
	
</article><!-- #post-<?php the_ID(); ?> -->
</div>




