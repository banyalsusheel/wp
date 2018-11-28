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
		<?php get_sidebar('left-event-filters');?>		
		<?php get_sidebar('left-location-filters');?>
		<?php dynamic_sidebar( 'Sidebar-left-banners' ); ?>
	</aside>
	
	<?php get_sidebar('right');?>
	<div class="middle-content">	
		<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();?>
				<div class="detail-pageTop">
					<div class="event-title"><?php the_title(); ?></div>

					<?php
					// Featured image 2
					$featured_image = kdmfi_get_featured_image_src( 'featured-image-2', 'thumbnail-size-769x433' );
					$event_organizer = get_post_meta(get_the_ID(), 'event_organizer', true);
					?>
					<div class="featured-image-2"><img src="<?php echo $featured_image ?>"></div>
					<div class="orgnizer-div"><i class="fa fa-user-o fa-icon"></i> <b>Organizer :</b> <span class="fa-icon"><?php echo $event_organizer;?></span></div>
					<?php
					// CATEGORIES
					$categories = get_categories_of_posttype($post->ID, 'event-categories');
					?>

					<?php 
					//DATES
					$_event_start_local = get_post_meta(get_the_ID(), '_event_start_local', true);
					$_event_end_local = get_post_meta(get_the_ID(), '_event_end_local', true);
					
					?>

					

					<?php 
					// LOCATION
					$location_data = get_location_of_event(get_the_ID());
					if(!empty($location_data)){?>
						<div class="event-location"><i class="fa fa-map-marker fa-icon" aria-hidden="true"></i> <?php echo $location_data['location'];?></div> <span class="separater">|</span> 
					<?php } ?>
					<div class="event-dates">
						<i class="fa fa-calendar-check-o fa-icon" aria-hidden="true"></i> <?php echo date('d M Y h:i A', strtotime($_event_start_local))?>  - <?php echo date('d M Y h:i A', strtotime($_event_end_local))?>  &nbsp; | &nbsp; 
					</div>
					<div class="event-rating"> <?php echo average_rating(get_the_ID());?></div>
				</div>
		        <div class="event-category"><?php echo $categories['categories_link']; ?></div>

		        <!-- CONTENT -->
		        <div class="event-content">
					<?php remove_filter_the_content();
					the_content();?>
		        </div>
				<div class="social-share-btns">Share this <?php echo sharethis_inline_buttons(); ?></div>
				
				
		        
				<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;?>

				<!-- RECOMMENDED EVENT SECTION -->
				<div class="event-recommended">
					
					
					<?php 
					$current_time = current_time( 'timestamp' );
	    			$current_date = date( 'Y-m-d H:i:s', $current_time );
			        	$args = [
							'posts_per_page'=> 4,
						    'post_type' => 'event',
						    'exclude'   => array(get_the_id()),
						    'post__not_in'   => array(get_the_id()),
						    'tax_query' => [
						        [
						            'taxonomy' => 'event-categories',
						            'terms' => $categories['category_ids'],
						            'include_children' => false // Remove if you need posts from term 7 child terms
						        ],
						    ],
						    'meta_query' => array(
								array(
					                'key'        => '_event_end_local',
					                'compare'    => '>=',
					                'value'      => $current_date,
					            ),
							),
						];
						$loop = new WP_Query($args);
						$total = $loop->post_count;
						if($total > 0){?>
							<h2 class="main-heading">Recommended <span>Events</span></h2>
						<?php } ?>
						
						<ul class="events-recommended-ul">

						<?php 
						
						while ( $loop->have_posts() ) : $loop->the_post(); 
							$categories = get_categories_of_posttype($post->ID, 'event-categories');
							$_event_start_local = get_post_meta(get_the_ID(), '_event_start_local', true);
		       				$_event_end_local = get_post_meta(get_the_ID(), '_event_end_local', true);
							?>	
						  	<li>
								<div class="sub-boxes">
									<div class="image-content">
										<div class="img">
											<div class="image-box">
											<?php if ( has_post_thumbnail($post->ID) ) {
												$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail-size-250x227' );
												?>
												<div class="image-box event-img">
													<img src="<?php echo esc_url( $thumbnail[0] );?>" class="img-fluid" alt="" width="200" height="227">
												</div>
											<?php } else{ ?>
											<div class="image-box">
												<img src="<?php echo get_stylesheet_directory_uri();?>/assets/img/default.jpg"  class="img-fluid" width="250" height="117" alt="Visitarians">
											</div>
											<?php } ?>	
											</div>
										</div>
										<div class="txt">
											<span class="event-name">
											<a href="<?php echo esc_url( get_permalink() )?>" title="<?php the_title();?>"><?php the_title();?></a>
											</span>
											<div class="event-rating"> <?php echo average_rating(get_the_ID());?></div>
											<div class="event-category event-type"><?php echo $categories['categories']; ?></div>
										</div>
									</div>
									<div class="event-content">
										<p><?php echo substr(strip_tags($post->post_content), 0, 100); ?></p>
										<div class="event-DateLocation">
											<?php 
												$location_data = get_location_of_event(get_the_ID());
												if(!empty($location_data)){?>
													<div class="date-location">
													<i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $location_data['location'];?>, <?php echo $location_region;?></div>
												<?php } ?>

												<div class="date-location">
													<i class="fa fa-calendar-check-o" aria-hidden="true"></i>
													<?php echo date('d M H:i a', strtotime($_event_start_local)).' - '. date('d M H:i a', strtotime($_event_end_local))?>
												</div>
										</div>
										
									
									</div>
								</div>
							</li>
						<?php endwhile; wp_reset_query(); ?>
					</ul>

		        </div>
				
			<?php  endwhile; // End of the loop.
			?>
	</div>
<?php get_footer();?>
<?php /*$f = get_filters_for( 'the_content' );
pr($f);
remove_filter('the_content', 'em_content', 10);
remove_filter('the_content', 'EM_Location_Post::the_content', 10);
remove_filter('the_content', 'EM_Event_Post::the_content', 10);
echo "<hr><hr>";
pr($f);*/
?>