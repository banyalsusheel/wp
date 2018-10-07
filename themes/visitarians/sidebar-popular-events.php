<ul class="visit-event-place">
	<?php 
	$current_time = current_time( 'timestamp' );
    $current_date = date( 'Y-m-d H:i:s', $current_time );
	$args = array(
		'posts_per_page'=> 3,
		'post_type'  => 'event',
		'meta_key'   => 'post_views_count',
		'orderby'    => 'meta_value_num',
		'meta_query' => array(
			'relation' => 'OR',
			array(
                'key'        => '_event_end_local',
                'compare'    => '>=',
                'value'      => $current_date,
            ),
		),
		'order'      => 'DESC'
	);
	
	$loop_event = new WP_Query( $args );
	
	while ( $loop_event->have_posts()) : $loop_event->the_post(); ?>
		
		<?php $location_data = get_location_of_event($post->ID);?>
		<li>
			<div class="event-place-text">
				<span class="event-name"><a href="<?php the_permalink()?>"><?php the_title()?></a></span>
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
				<img src="<?php echo get_stylesheet_directory_uri();?>/assets/img/event1.jpg"  class="img-fluid" width="250" height="117" alt="Visitarians">
			<?php } ?>
		</li>
	<?php endwhile;?>
	<?php wp_reset_query();?>

</ul>