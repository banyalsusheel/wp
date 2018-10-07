<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
	<?php // Show the selected frontpage content.
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/page/content', 'front-page' );
		endwhile;
	else :
		get_template_part( 'template-parts/post/content', 'none' );
	endif; ?>
<?php get_footer();
