<?php
/**
 * Displays content for front page
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
?>

	<aside class="left-side">
		<h2 class="main-heading">Popular <span>Events</span></h2>
		<?php get_sidebar('popular-events');?>
		<?php dynamic_sidebar( 'sidebar-left-banners' ); ?>
		
	</aside>
	<aside class="left-side right-side">
		<h2 class="main-heading">Popular <span>Places</span></h2>
		<?php get_sidebar('popular-places');?>
		<?php dynamic_sidebar( 'sidebar-right-banners' ); ?>
	</aside>



	<!-- Start Middle content Area -->
	<div class="middle-content">	
		<h2 class="main-heading">Upcoming <span>Events</span></h2>
		<?php 
		$current_time = current_time( 'timestamp' );
	    $current_date = date( 'Y-m-d H:i:s', $current_time );
		$args = array(
			'posts_per_page'=> 5,
			'post_type'  => 'event',
			'orderby' => 'ID',
			'order'   => 'DESC',
			'meta_query' => array(
				// 'relation' => 'OR',
				array(
	                'key'        => '_event_end_local',
	                'compare'    => '>=',
	                'value'      => $current_date,
	            ),
			),
		);
		
		$loop_event = new WP_Query( $args );
		$i = 1;
		while ( $loop_event->have_posts()) { 
			$loop_event->the_post(); 
			
			$categories = get_categories_of_posttype($post->ID, 'event-categories');
			$_event_start_local = get_post_meta(get_the_ID(), '_event_start_local', true);
			$_event_end_local = get_post_meta(get_the_ID(), '_event_end_local', true);
			$dates =  date('d M H:i a', strtotime($_event_start_local)).' - '. date('d M H:i a', strtotime($_event_end_local));
			$location_data = get_location_of_event(get_the_ID());
			$content = substr(strip_tags($post->post_content), 0, 60);
			$image = '<img src="'.get_stylesheet_directory_uri().'/assets/img/default.jpg"  class="img-fluid" width="250" height="227" alt="Visitarians">';
			if ( has_post_thumbnail($post->ID) ) {
				$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail-size-250x227' ); 
				$image = '<img src="'.esc_url( $thumbnail[0] ).'" class="img-fluid" width="'.$thumbnail[1].'" height="'.$thumbnail[1].'" alt="Visitarians">';
				
			}
			$total = $loop_event->post_count;

			if($i == 1){ ?>
				<div class="main-box">
					<div class="image"><?php echo $image;?></div>
					<div class="text">
						<h1 class="heading"><a href="<?php echo esc_url( get_permalink() )?>"><?php the_title();?></a></h1>
						<span class="event-type"><?php echo $categories['categories_link']; ?></span>
						<p><?php echo $dates;?></p>
				       	<?php if(!empty($location_data)){?>
				       		<p><?php echo $location_data['location'];?></p>
				       	<?php } ?>
					    <p><?php echo $content; ?></p>
						<div class="text-right"><a href="<?php echo esc_url( get_permalink() )?>" title="Continue Reading" class="read-more">Continue Reading</a></div>
					</div>
				</div>
			<?php } elseif ($i >= 2 || $i <= 5) { ?>
				<?php if ($i==2 || $i==4){?>
					<div class="row">
				<?php }?>
				
				<div class="col-sm-6">
					<div class="sub-boxes">
						<div class="image-content">
							<div class="img">
								<div class="image-box">
									<?php echo $image;?>
								</div>
							</div>
							<div class="txt">
								<span class="event-name"><?php the_title();?></span>
								<span class="event-date"><?php echo $dates;?></span>
								<span class="event-type"><?php echo $categories['categories_link']; ?></span>
							</div>
						</div>
						<p><?php echo $content; ?>...</p>
						<div class="text-right"><a href="<?php echo esc_url( get_permalink() )?>" title="Continue Reading" class="read-more">Continue Reading</a></div>
					</div>
				</div>

				<?php if ($i == 3 || $i == 5){?>
					</div>
				<?php } else if($total < 5 && $i==4){?>
					</div>
				<?php } ?>
			<?php } //endwhile?>
			
		<?php $i = $i+1; 
		}?>
		<?php wp_reset_query();?>



		<div class="spacer"></div>
		<h2 class="main-heading">Places<span></span></h2>
		<?php 
		$args = array(
			'posts_per_page'=> 5,
			'post_type'  => 'place',
			'orderby' => 'ID',
			'order'   => 'DESC'
		);
		
		$loop_event = new WP_Query( $args );
		$i = 1;
		while ( $loop_event->have_posts()) { 
			$loop_event->the_post(); 
			
			$categories = get_categories_of_posttype($post->ID, 'place_categories');
			$location_data = get_location_of_place(get_the_ID());
			$content = substr(strip_tags($post->post_content), 0, 60);
			$image = '<img src="'.get_stylesheet_directory_uri().'/assets/img/default.jpg"  class="img-fluid" width="250" height="227" alt="Visitarians">';
			if ( has_post_thumbnail($post->ID) ) {
				$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail-size-250x227' ); 
				$image = '<img src="'.esc_url( $thumbnail[0] ).'" class="img-fluid" width="'.$thumbnail[1].'" height="'.$thumbnail[1].'" alt="Visitarians">';
				
			}
			$total = $loop_event->post_count;

			if($i == 1){ ?>
				<div class="main-box">
					<div class="image"><?php echo $image;?></div>
					<div class="text">
						<h1 class="heading"><a href="<?php echo esc_url( get_permalink() )?>" ><?php the_title();?></a></h1>
						<span class="event-type"><?php echo $categories['categories_link']; ?></span>
						<p><?php echo $dates;?></p>
				       	<?php if(!empty($location_data)){?>
				       		<p><?php echo $location_data['location'];?></p>
				       	<?php } ?>
					    <p><?php echo $content; ?></p>
						<div class="text-right"><a href="<?php echo esc_url( get_permalink() )?>" title="Continue Reading" class="read-more">Continue Reading</a></div>
					</div>
				</div>
			<?php } elseif ($i >= 2 || $i <= 5) { ?>
				<?php if ($i==2 || $i==4){?>
					<div class="row">
				<?php }?>
				
				<div class="col-sm-6">
					<div class="sub-boxes">
						<div class="image-content">
							<div class="img">
								<div class="image-box">
									<?php echo $image;?>
								</div>
							</div>
							<div class="txt">
								<span class="event-name"><?php the_title();?></span>
								<span class="event-type"><?php echo $categories['categories_link']; ?></span>
							</div>
						</div>
						<p><?php echo $content; ?>...</p>
						<div class="text-right"><a href="<?php echo esc_url( get_permalink() )?>" title="Continue Reading" class="read-more">Continue Reading</a></div>
					</div>
				</div>

				<?php if ($i == 3 || $i == 5){?>
					</div>
				<?php } else if($total < 5 && $i==4){?>
					</div>
				<?php } //endwhile?>
			<?php } //endwhile?>
		<?php $i = $i+1; 
		}?>
		<?php wp_reset_query();?>	
	</div>	<!-- end middle content area -->
