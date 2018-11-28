<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
<?php /*?>

<body <?php body_class(); ?>>
<div id="page" class="site">
<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentyseventeen' ); ?></a>

<header id="masthead" class="site-header" role="banner">

<?php get_template_part( 'template-parts/header/header', 'image' ); ?>

<?php if ( has_nav_menu( 'top' ) ) : ?>
<div class="navigation-top">
<div class="wrap">
<?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
</div><!-- .wrap -->
</div><!-- .navigation-top -->
<?php endif; ?>

</header><!-- #masthead -->

<?php

/*
 * If a regular post or page, and not the front page, show the featured image.
 * Using get_queried_object_id() here since the $post global may not be set before a call to the_post().
 */
/*
if ( ( is_single() || ( is_page() && ! twentyseventeen_is_frontpage() ) ) && has_post_thumbnail( get_queried_object_id() ) ) :
echo '<div class="single-featured-image-header">';
echo get_the_post_thumbnail( get_queried_object_id(), 'twentyseventeen-featured-image' );
echo '</div><!-- .single-featured-image-header -->';
endif;
?>

<div class="site-content-contain">
<div id="content" class="site-content">

<?php */?>

	<!DOCTYPE html>
	<html <?php language_attributes();?> class="no-js no-svg">
	<head>
		<!-- Mobile Specific Meta -->
		<meta charset="<?php bloginfo('charset');?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/fav.png">
		<!-- Meta Description -->
		
		<!-- Meta Keyword -->
		
		<!-- meta character set -->
		
		<!-- Site Title -->
		<title>Visitarians</title>

			<!--
			CSS
			============================================= -->
			<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/font-awesome.min.css">
			<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bootstrap.css">
			<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/owl.carousel.css">
			<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/flexslider.css">
			<?php wp_head();?>
		</head>
		<body <?php body_class();?>>
			<!-- start banner Area -->
			<section class="banner-area" id="home">
					<!-- Start Header Area -->
					<header class="default-header">
						<nav class="navbar navbar-expand-lg  navbar-light">
							<div class="container">
							  	<a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
							  		<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo1.png"  class="img-fluid" alt="Visitarians">
							  	</a>
							  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							    	<span class="text-white lnr lnr-menu"></span>
							  	</button>

							  	<?php if (has_nav_menu('top')): ?>
							  		<div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarSupportedContent">
										<?php
										$defaults = array('container' => '', 'menu_class' => 'navbar-nav', 'menu_id' => 'top-menu', 'theme_location' => 'top');
										wp_nav_menu($defaults);
										?>
									</div>
							  	<?php endif;?>

							</div>
						</nav>
					</header>
					<!-- End Header Area -->
			</section>

			<!-- Place either at the bottom in the <head> of your page or inside your CSS -->

			<!-- home page/ inner pages check for Header -->
			<?php if ((twentyseventeen_is_frontpage() || (is_home() && is_front_page()))) {?>

				<section class="default-banner active-blog-slider">

				<?php $slider_images = get_featured_events_places(5);?>
				<!-- Place somewhere in the <body> of your page -->
					<div class="flexslider" id="event_slider">
						<ul class="slides">
							<?php foreach ($slider_images as $value) {?>
								<li>
									<a href="<?php echo $value['link'] ?>" title="<?php echo $value['title'] ?>">
									<div class="overlay" style="background: rgba(0,0,0,.3)"></div>
										
											<!-- div class="row fullscreen justify-content-center inner-banner align-items-center">
												
													<div class="banner-content text-center">
													<h1 class="text-uppercase text-white"><?php //echo $value['title'] ?></h1>
													<a href="<?php //echo $value['link'] ?>" class="text-uppercase header-btn">Discover Now</a>
													</div>
													</div -->
									<img src="<?php echo $value['image_full'] ?>" />
									</a>
				
								</li>
							<?php }?>
						</ul>
						</div>

						<div class="flexslider carousel" id="event_slider_thumbnail" >
							<ul class="slides">
							<?php foreach ($slider_images as $value) {?>
								<li class="<?php echo $value['class'] ?>" >
									<img src="<?php echo $value['image_thumb'] ?>" />
								</li>
							<?php }?>
							</ul>
						</div>

				</section>

			<?php } else if (is_tax()) {
				$cat_id = get_queried_object_id();
				$cat_image = z_taxonomy_image_url($cat_id);
				$cat_obj = get_term($cat_id);
				$style = "style='background:#fdb101'";
				if (!empty($cat_image)) {
					$style = "style='background:url(" . esc_url($cat_image) . ");background-size: cover;'";
					?>
				<?php }?>

				<section class="default-banner">
					<div class="relative" <?php echo $style; ?>>
						<div class="overlay" style="background: rgba(0,0,0,.3)"></div>
						<div class="container">
							<div class="row fullscreen justify-content-center inner-banner align-items-center">
								<div class="col-md-10 col-12">
									<div class="banner-content text-center">
										<h1 class="text-uppercase text-white"><?php echo $cat_obj->name; ?></h1>

									</div>
								</div>

							</div>
						</div>
					</div>
				</section>

			<?php } else {?>
				<section class="default-banner">
					<?php $style = "style='background:#fdb101'";
					if (has_post_thumbnail($post->ID)) {
						$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'twentyseventeen-featured-image');
						$style = 'style="background: url( ' . esc_url($thumbnail[0]) . ' );background-size: cover;"';
					}
					?>
					<div class="relative" <?php echo $style; ?>>
						<div class="overlay" style="background: rgba(0,0,0,.3)"></div>
						<div class="container">
							<div class="row fullscreen justify-content-center inner-banner align-items-center">
								<div class="col-md-10 col-12">
									<div class="banner-content text-center">
										<h1 class="text-uppercase text-white"><?php the_title()?></h1>
										<h4 class="text-white text-uppercase">
											<?php $tag_line = get_post_meta(get_the_ID(), 'tag_line', true);
											if (!empty($tag_line)) {
												echo $tag_line;
											}
											?>
										</h4>
									</div>
								</div>

							</div>
						</div>
					</div>
				</section>
			<?php }?>

<div class="content-area"> <!-- close in footer -->