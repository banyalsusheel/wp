<?php /* Template Name: Places Template */ 
get_header(); ?>
	<aside class="left-side">
		<h2 class="main-heading">Filter<span></span></h2>
		<!-- <?php get_sidebar('left-event-filters');?>	 -->
		<?php get_sidebar('left-place-filters');?>
		<?php dynamic_sidebar( 'Sidebar-left-banners' ); ?>
	</aside>
	<?php get_sidebar('right');?>
	<div class="middle-content">
		<h2 class="main-heading">Places <span>List</span></h2>
		<ul>
			<?php 			
		    $paged= (get_query_var('paged' )) ? get_query_var('paged'):1;
			$args = array(
				'paged' => $paged,
				'posts_per_page'=> 2,
				'post_type'  => 'place',
				'orderby' => 'ID',
				'order'   => 'DESC'
			);
			
			$loop_place = new WP_Query( $args );
			
			while ( $loop_place->have_posts()) { 
				$loop_place->the_post(); 
				
				$categories = get_categories_of_posttype($post->ID, 'place_categories');
				$location_data = get_location_of_place(get_the_ID());
				$content = substr(strip_tags($post->post_content), 0, 60);
				$image = '<img src="'.get_stylesheet_directory_uri().'/assets/img/default.jpg"  class="img-fluid" width="250" height="117" alt="Visitarians">';
				if ( has_post_thumbnail($post->ID) ) {
					$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail-size-250x117' );
					$image = '<img src="'.esc_url( $thumbnail[0] ).'" class="img-fluid" width="'.$thumbnail[1].'" height="'.$thumbnail[2].'" alt="Visitarians">';
				}
				$rating = average_rating(get_the_ID());?>
				<li>
					<div class="sub-boxes list-textBoxes">
						<div class="image"><?php echo $image;?></div>
						<div class="text">
							<h2 class="heading"><a href="<?php echo esc_url( get_permalink() )?>"><?php the_title();?></a></h2>
							<span class="pull-right"><?php echo $rating;?></span>
							<div class="event-DateLocation">
								<div class="DateLocation-inner">
								<?php if(!empty($location_data)){?>
									<div class="date-location">
									<i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $location_data['location'];?>
									</div>
								<?php } ?>
								<span class="event-type"><?php echo $categories['categories_link']; ?></span>
								</div>
								<div class="text-right"><a href="<?php echo esc_url( get_permalink() )?>" title="Continue Reading" class="read-more DateLocation-iconLink"></a></div>
							</div>
						</div>
					</div>
				</li>
			<?php }?>
		</ul>
		<?php wp_pagenavi( array( 'query' => $loop_place ) );?>
		<?php wp_reset_query(); ?>
	</div>
	

<?php get_footer();
