<ul class="visit-event-place">
<?php 
	$args = array(
		'posts_per_page'=> 3,
		'post_type' => 'place',
	    'meta_query' => array(
	        'relation' => 'OR',
	        'rating_clause' => array(
	        	'key' => 'post_average_rating',
	        )
	    ),
	    'orderby' => array( 
	        'rating_clause' => 'DESC',
	        'comment_count' => 'DESC',
	    ),
	);
	
	$loop = new WP_Query( $args );
	while ( $loop->have_posts()) : $loop->the_post(); ?>
		<?php $location_data = get_location_of_place($post->ID);?>
		<li><a href="<?php the_permalink()?>">
			<div class="event-place-text">
				<span class="event-name"><?php the_title()?></span>
				 <?php if(!empty($location_data)){?>
				 	<span class="place-name"><?php echo $location_data['location'];?></span>
		       	<?php } ?>
				<!-- <span class="event-date">Feb 22</span> -->
			</div>

			<?php if ( has_post_thumbnail($post->ID) ) {
				$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail-size-250x117' ); 
				?>
				<img src="<?php echo esc_url( $thumbnail[0] )?>"  class="img-fluid" width="<?php echo $thumbnail[1]?>" height="<?php echo $thumbnail[2]?>" alt="Visitarians">
			<?php } else { ?>
				<img src="<?php echo get_stylesheet_directory_uri();?>/assets/img/default.jpg"  class="img-fluid" width="250" height="117" alt="Visitarians">
			<?php } ?>
			</a>
		</li>
	<?php endwhile;?>
	<?php wp_reset_query();?>
</ul>
