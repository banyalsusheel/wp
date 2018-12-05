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
get_header(); 
$cat_id = get_queried_object_id();
$cat_image = z_taxonomy_image_url($cat_id);
?>

<aside class="left-side">
	<h2 class="main-heading">Filter<span></span></h2>
	<?php get_sidebar('left-event-filters');?>		
	<?php dynamic_sidebar( 'Sidebar-left-banners' ); ?>
</aside>

	<div class="middle-content">	
		<h2 class="main-heading"><?php single_cat_title(); ?> <span>Events</span></h2>
		<ul>
		<?php 
			global $post; // required
			$current_time = current_time( 'timestamp' );
	    	$current_date = date( 'Y-m-d H:i:s', $current_time );
			$paged= (get_query_var('page' )) ? get_query_var('page'):1;
			$args = array(
			'paged' => $paged,
			'posts_per_page'=> 4,
			'post_type' => 'event',
			'tax_query' => array(
				array(
					'taxonomy' => 'event-categories',
					'field'    => 'id',
					'terms'    => $cat_id,
				),
			),
			'meta_query' => array(
				array(
	                'key'        => '_event_end_local',
	                'compare'    => '>=',
	                'value'      => $current_date,
	            ),
			),
		);
		$loop_event = new WP_Query( $args );
		$total = $loop_event->post_count;

		if($total == 0){?>
			<li> No Event found in this category. </li>
		<?php }

			while ( $loop_event->have_posts()) { 
				$loop_event->the_post(); 
				
				$categories = get_categories_of_posttype($post->ID, 'event-categories');
				$_event_start_local = get_post_meta(get_the_ID(), '_event_start_local', true);
				$_event_end_local = get_post_meta(get_the_ID(), '_event_end_local', true);
				$dates =  date('d M H:i a', strtotime($_event_start_local)).' - '. date('d M H:i a', strtotime($_event_end_local));
				$location_data = get_location_of_event(get_the_ID());
				$content = substr(strip_tags($post->post_content), 0, 60);


				
				$image = '<img src="'.get_stylesheet_directory_uri().'/assets/img/default.jpg"  class="img-fluid" width="250" height="117" alt="Visitarians">';
				if(kdmfi_has_featured_image( 'featured-image-2', $post->ID )) {
					$thumbnail = kdmfi_get_featured_image_src( 'featured-image-2', 'thumbnail-size-250x117' );			
					$image = '<img src="'.esc_url( $thumbnail ).'" class="img-fluid" width="250" height="227" alt="Visitarians">';	
				} else if ( has_post_thumbnail($post->ID) ){
					$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail-size-250x117' ); 
					$image = '<img src="'.esc_url( $thumbnail[0] ).'" class="img-fluid" width="'.$thumbnail[1].'" height="'.$thumbnail[2].'" alt="Visitarians">';				
				}
			
				$total = $loop_event->post_count;
				$rating = average_rating(get_the_ID());?>
				<li>
					<div class="sub-boxes list-textBoxes">
						<div class="image"><?php echo $image;?></div>
						<div class="text">
							<h2 class="heading"><a href="<?php echo esc_url( get_permalink() )?>"><?php the_title();?></a></h2>
							<span class="pull-right"><?php echo $rating;?></span>
							<div class="event-DateLocation">
								<div class="DateLocation-inner">
									<div class="date-location">
										<i class="fa fa-calendar-check-o" aria-hidden="true"></i>
										<?php echo $dates;?>
									</div>	
										<?php if(!empty($location_data)){?>
										<div class="date-location">
											<i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $location_data['location'];?>
										</div>
										<?php } ?>
										<span class="event-type"><?php echo $categories['categories']; ?></span>
									</div>
									<div class="text-right"><a href="<?php echo esc_url( get_permalink() )?>" title="Continue Reading" class="read-more DateLocation-iconLink"></a></div>
							</div>
						</div>
					</div>
				</li>
			<?php }?>
		</ul>
		<?php wp_pagenavi( array( 'query' => $loop_event ) );?>
		<?php wp_reset_query(); ?>
		
	</div>
	<?php get_sidebar('right');?>
<?php get_footer();


