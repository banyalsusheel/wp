<?php /* Template Name: Common Template */ 
get_header(); ?>

	<?php get_sidebar('left');?>
	<div class="middle-content">	
		<?php the_ID();?>
		<?php the_content();?>

		<?php if ( has_post_thumbnail() ) :
		$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'twentyseventeen-featured-image' );

		// Calculate aspect ratio: h / w * 100%.
		$ratio = $thumbnail[2] / $thumbnail[1] * 100;
		?>

		<div class="panel-image" style="background-image: url(<?php echo esc_url( $thumbnail[0] ); ?>);">
			<div class="panel-image-prop" style="padding-top: <?php echo esc_attr( $ratio ); ?>%"></div>
		</div><!-- .panel-image -->

	<?php endif; ?>
	</div>
	<?php get_sidebar('right');?>

<?php get_footer();
