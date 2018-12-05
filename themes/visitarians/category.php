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
?>

<?php get_sidebar('left');?>

	<div class="middle-content">	

		<p>Category: <?php single_cat_title(); ?></p>
		<?php global $post; // required
			$args = array('category' => $cat_id); // include category 9
			$custom_posts = get_posts($args);
			foreach($custom_posts as $post) : setup_postdata($post);

			// put here what you want to appear for each post like:
			//the title:
			the_title();

			// an excerpt:
			the_content();

			//and so on...    

			endforeach;?>
		</div>
		<?php get_sidebar('right');?>
<?php get_footer();


