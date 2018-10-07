<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
global $wpdb;
get_header(); ?>
<?php if(function_exists('bac_PostViews')) { bac_PostViews(get_the_ID()); }?>
<aside class="left-side">
	<h2 class="main-heading">Filter<span></span></h2>
	<?php //get_sidebar('left-event-filters');?>		
	<?php get_sidebar('left-place-filters');?>
	<?php dynamic_sidebar( 'Sidebar-left-banners' ); ?>
</aside>
<?php get_sidebar('right');?>
	<div class="middle-content">	
		<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();?>
				
				<div class="place-title"><?php the_title(); ?></div>

				<?php
				// CATEGORIES
				$categories = get_categories_of_posttype($post->ID, 'place_categories');
				?>

		       	<?php 
		       	// LOCATION
		       	$location_data = get_location_of_place(get_the_ID());
		       	// print_r($location_data);
		       	if(!empty($location_data['location'])){?>
		       		<div class="event-location"><?php echo $location_data['location'];?></div> | 
		       	<?php } ?>
		       
		        <div class="place-rating"> <?php echo average_rating(get_the_ID());?></div>
		    
		        <div class="place-category"><?php echo $categories['categories']; ?></div>

		        <!-- CONTENT -->
		        <div class="place-content">
		        	<?php echo $post->post_content;?>
		        </div>
				
		        <!-- RECOMMENDED EVENT SECTION -->
				<div class="place-recommended">
					
					
					<?php 
			        	$args = [
						    'post_type' => 'location',
						    'exclude'   => array(get_the_id()),
						    'post__not_in'   => array(get_the_id()),
						    'tax_query' => [
						        [
						            'taxonomy' => 'place-categories',
						            'terms' => $categories['category_ids'],
						            'include_children' => false // Remove if you need posts from term 7 child terms
						        ],
						    ],
						];
						$loop = new WP_Query($args);
						$total = $loop->post_count;
						if($total > 0){?>
							<h2 class="main-heading">Recommended <span>Places</span></h2>
						<?php } ?>
						
						<ul class="place-recommended-ul">

						<?php 

						while ( $loop->have_posts() ) : $loop->the_post(); 
							$categories = get_categories_of_posttype($post->ID, 'place_categories');
							?>	
						  	<li>
						  		<?php if ( has_post_thumbnail($post->ID) ) {
									$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'twentyseventeen-featured-image' );
									?>
									<div class="place-img">
										<img src="<?php echo esc_url( $thumbnail[0] );?>" class="img-fluid" alt="" width="200" height="200">
									</div>
								<?php } else{ ?>
									<img src="<?php echo get_stylesheet_directory_uri();?>/assets/img/default.jpg"  class="img-fluid" width="250" height="117" alt="Visitarians">
								<?php } ?>	

								<div class="place-content">									
									<a href="<?php echo esc_url( get_permalink() )?>" title="<?php the_title();?>"><?php the_title();?></a>

									<?php 
									$location_data = get_location_of_place(get_the_ID());
							       	if(!empty($location_data['location'])){?>
							       		<div class="place-location"><?php echo $location_data['location'];?></div> | 
							       	<?php } ?>
									
								    <div class="place-rating"> <?php echo average_rating(get_the_ID());?></div>
								    <div class="place-category"><?php echo $categories['categories_link']; ?></div>
									<div class="place-content"><?php echo substr(strip_tags($post->post_content), 0, 100); ?>
									</div>
									
								</div>
							</li>
						<?php endwhile; wp_reset_query(); ?>
					</ul>

		        </div>
				<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

				
			endwhile; // End of the loop.
			?>
	</div>
<?php get_footer();
