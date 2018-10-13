<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */
/*
?>

		</div><!-- #content -->

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="wrap">
				<?php
				get_template_part( 'template-parts/footer/footer', 'widgets' );

				if ( has_nav_menu( 'social' ) ) : ?>
					<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'twentyseventeen' ); ?>">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'social',
								'menu_class'     => 'social-links-menu',
								'depth'          => 1,
								'link_before'    => '<span class="screen-reader-text">',
								'link_after'     => '</span>' . twentyseventeen_get_svg( array( 'icon' => 'chain' ) ),
							) );
						?>
					</nav><!-- .social-navigation -->
				<?php endif;

				get_template_part( 'template-parts/footer/site', 'info' );
				?>
			</div><!-- .wrap -->
		</footer><!-- #colophon -->
	</div><!-- .site-content-contain -->
</div><!-- #page -->
<?*/?>










</div>


<?php if ( !( twentyseventeen_is_frontpage() || ( is_home() && is_front_page() ) ) ) { ?>
	<div class="mt-150"></div>
<?php } ?>

<section class="subscribe-newsletter">
	<div class="single-footer-widget">
		<h6>SUBSCRIBE TO OUR NEWSLETTER</h6>
		<p>And be up to date</p>
		<div class="newsletter-form" id="mc_embed_signup">
			<?php es_subbox( $namefield =  "", $desc = "", $group = "" ); ?>
			<!-- <form novalidate="true" action="#" method="get" class="form-block">
				<div class="d-flex flex-row">
					<input class="form-control" name="EMAIL" placeholder="Enter Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '" required="" type="email">
					<button class="click-btn btn btn-default">Subscribe</button>
				</div>		
			</form> -->

		</div>
	</div>
	
</section>

<footer class="footer-area section-gap">
	<div class="container">
		<div class="footer-whiteBg">
			<div class="row">
				<div class="col-md-5">
					<div class="row">
						<div class="col-sm-5">
							<div class="single-footer-widget">
								<h6>Menu</h6>
								<?php if ( has_nav_menu( 'footer-menu' ) ) : ?>
									<?php 
										$defaults = array( 'container' => '', 'menu_class' => 'links', 'menu_id' => 'footer-menu', 'theme_location' => 'footer-menu' );
										wp_nav_menu($defaults); 
									?>
							  	<?php endif; ?>
							</div>
						</div>
											
						<div class="col-sm-7">
							<div class="single-footer-widget">
								<h6>Latest News</h6>
								<ul class="latest-news">
									<?php $loop = new WP_Query( array(
										    'post_type' => 'news',
										    'posts_per_page' => 5
										  )
										);
									while ( $loop->have_posts() ) : $loop->the_post(); ?>
									  	<li>
									  		<?php if ( has_post_thumbnail() ) :
												$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'twentyseventeen-featured-image' );
												?>
												<div class="img">
													<img src="<?php echo esc_url( $thumbnail[0] );?>" class="img-fluid" alt="" width="48" height="48">
												</div>
											<?php endif; ?>										
											<div class="text">
												<p><a href="#<?php //echo esc_url( get_permalink() )?>" title="News title goes here with bold text">
													<?php echo substr(strip_tags(get_the_content()), 0, 100); ?>
													</a>
												</p>
												<span class="date"><?php echo date('d M Y', strtotime($post->post_modified))?></span>
											</div>
										</li>
									<?php endwhile; wp_reset_query(); ?>
								</ul>
									
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-7">
						<div class="row">
							<div class="col-sm-6">
								<div class="single-footer-widget">
									<h6>Twitter Feed</h6>
									<?php echo do_shortcode('[custom-twitter-feeds exclude="retweeter,actions,linkbox,twitterlink" include="author,date,text,avatar"]')?>
									<?php //dynamic_sidebar( 'twitter-feed-item' ); ?>
									<!-- <ul class="twitter-feeds">
									<li>
										<div class="img">
											<i class="fa fa-twitter"></i>
										</div>
										<div class="text">
											<p><a href="#" title="Discover a #WordPress theme oasis; all you can imagine & more, just make your pick! Come on down to https://t.co/J4OoD1BHeS">Discover a #WordPress theme oasis; all you can imagine & more, just make your pick! Come on down to https://t.co/J4OoD1BHeS</a></p>
											<span class="date">2 months ago</span>
										</div>
									</li>
									<li>
										<div class="img">
											<i class="fa fa-twitter"></i>
										</div>
										<div class="text">
											<p><a href="#" title="Discover a #WordPress theme oasis; all you can imagine & more, just make your pick! Come on down to https://t.co/J4OoD1BHeS">Discover a #WordPress theme oasis; all you can imagine & more, just make your pick! Come on down to https://t.co/J4OoD1BHeS</a></p>
											<span class="date">2 months ago</span>
										</div>
									</li>
									<li>
										<div class="img">
											<i class="fa fa-twitter"></i>
										</div>
										<div class="text">
											<p><a href="#" title="Discover a #WordPress theme oasis; all you can imagine & more, just make your pick! Come on down to https://t.co/J4OoD1BHeS">Discover a #WordPress theme oasis; all you can imagine & more, just make your pick! Come on down to https://t.co/J4OoD1BHeS</a></p>
											<span class="date">2 months ago</span>
										</div>
									</li>
									
								</ul> -->
								</div>
							</div>
									
							<div class="col-sm-6 social-widget">
								<div class="single-footer-widget">
									<h6>Instagram</h6>
										<?php dynamic_sidebar( 'widget-instagram-feed-area' ); ?>
										
									<h6 class="mb-10 mt-30">Let us be social</h6>
									<?php dynamic_sidebar( 'sidebar-3' ); ?>
									<!-- <div class="footer-social d-flex align-items-center">
										<a href="#"><i class="fa fa-facebook"></i></a>
										<a href="#"><i class="fa fa-twitter"></i></a>
										<a href="#"><i class="fa fa-dribbble"></i></a>
										<a href="#"><i class="fa fa-behance"></i></a>
									</div> -->
								</div>
							</div>							
						</div>							
					</div>							
			</div>
		</div>
		<div class="text-center">
			<p><img src="<?php echo get_stylesheet_directory_uri();?>/assets/img/logo-white.png" width="" height="" alt="Visitarians"></p>
			<p class="copy-right-text">Copyright <script>document.write(new Date().getFullYear());</script> by Visitarians. All rights reserved.</p>
		</div>
	</div>
</footer>	
<!-- End footer Area -->			
<?php wp_footer(); ?>
<script src="<?php echo get_stylesheet_directory_uri();?>/assets/js/popper.min.js" ></script>
<script src="<?php echo get_stylesheet_directory_uri();?>/assets/js/bootstrap.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri();?>/assets/js/owl.carousel.min.js"></script>			
<script src="<?php echo get_stylesheet_directory_uri();?>/assets/js/jquery.sticky.js"></script>

<script src="<?php echo get_stylesheet_directory_uri();?>/assets/js/jquery.counterup.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri();?>/assets/js/waypoints.min.js"></script>		
<script src="<?php echo get_stylesheet_directory_uri();?>/assets/js/jquery.flexslider.js"></script>	
<script src="<?php echo get_stylesheet_directory_uri();?>/assets/js/main.js"></script>
<script src="<?php echo get_stylesheet_directory_uri();?>/assets/js/jquery.easing.js"></script>
<script src="<?php echo get_stylesheet_directory_uri();?>/assets/js/jquery.mousewheel.js"></script>


</body>
</html>