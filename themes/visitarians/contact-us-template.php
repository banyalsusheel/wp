<?php /* Template Name: Contact us */ 
get_header(); ?>
    <?php while ( have_posts() ) : the_post(); ?>
	<div class="middle-content no-margin">	
		<?php the_content();?>
	</div>
<?php endwhile; // End of the loop.?>
<?php get_footer();
