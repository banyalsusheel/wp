<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found ">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/404.jpg"  class="img-fluid" alt="Visitarians" width="" height="">
				<!-- <header class="page-header">
					<h1 class="page-title"><?php // _e( 'Oops! That page can&rsquo;t be found.', 'twentyseventeen' ); ?></h1>
				</header><!-- .page-header -->
				<div class="page-content"><h2 class="headig">Oops!</h2>
				<p>The  page you are looking for might have been moved, renamed or might never existed.</p>
				<a href="/" title="Back Home" class="back-btn">Back Home</a>
					<!-- <p><?php // _e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentyseventeen' ); ?></p>

					<?php //get_search_form(); ?>
					-->

				</div><!-- .page-content -->
			</section><!-- .error-404 -->
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();
