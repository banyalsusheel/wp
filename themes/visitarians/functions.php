<?php

add_image_size( 'thumbnail-size-250x117', 250, 117, true); 
add_image_size( 'thumbnail-size-250x227', 250, 227, true); 
add_image_size( 'thumbnail-size-100x64', 100, 64, true); 

add_filter( 'nav_menu_link_attributes', 'wpse156165_menu_add_class', 10, 3 );

function wpse156165_menu_add_class( $atts, $item, $args ) {
	// echo "<pre>";print_r($args);echo "</pre>";
	if($args->menu_id=='top-menu'){
		if(in_array('current_page_item', $item->classes)){
		$class = 'active'; // or something based on $item
	    	$atts['class'] = $class;
	    	
		}
	}
	
    return $atts;
}


function register_footer_menus() {
  register_nav_menus(
    array(
      'footer-menu' => __( 'Footer Menu' ),
    )
  );
}
add_action( 'init', 'register_footer_menus' );


add_action( 'widgets_init', 'theme_slug_widgets_init' );
function theme_slug_widgets_init() {
    register_sidebar( 
    	array(
	        'name' => __( 'Sidebar left banners', 'visitarians' ),
	        'id' => 'sidebar-left-banners',
	        'description' => __( 'Widgets in this area will be shown on left sidebar.', 'visitarians' ),
	        'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
    	)
    );
    register_sidebar( 
    	
    	array(
	        'name' => __( 'Sidebar right banners', 'visitarians' ),
	        'id' => 'sidebar-right-banners',
	        'description' => __( 'Widgets in this area will be shown on right sidebar.', 'visitarians' ),
	        // 'before_widget' => '<li id="%1$s" class="widget %2$s">',
	        'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
    	)
    );

    register_sidebar( 
    	
    	array(
	        'name' => __( 'Twitter Feed', 'visitarians' ),
	        'id' => 'twitter-feed-item',
	        'description' => __( 'Widgets in this area will be shown on twitter feeds in footer.', 'visitarians' ),
	        // 'before_widget' => '<li id="%1$s" class="widget %2$s">',
	        'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
    	)
    );
    register_sidebar( 
    	
    	array(
	        'name' => __( 'Instagram Feed Area', 'visitarians' ),
	        'id' => 'widget-instagram-feed-area',
	        'description' => __( 'Widgets in this area will be shown on instagram feeds in footer.', 'visitarians' ),
	        // 'before_widget' => '<li id="%1$s" class="widget %2$s">',
	        'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
    	)
    );
}


add_filter('comment_form_default_fields', 'website_remove');
function website_remove($fields){
	if(isset($fields['url'])){
		unset($fields['url']);
	}
	return $fields;
}


/*
* ADD LOCATION CATEGORIES MENU IN ADMIN SIDE BAR
*/ 
// add_action( 'admin_menu', 'location_categories_url' );
// function location_categories_url() {
// 	add_menu_page( 'Place Categories', 'Place Categories', 'manage_options', '/edit-tags.php?taxonomy=place_categories', '', 'dashicons-text', 26 );
// }

/*
* GET LOCATIONS OF EVENTS AND LOCATIONS
*/

function get_location_of_event($event_id){
	global $wpdb;
	$location = get_post_meta($event_id, '_location_id', true);
	# code...
	$loc = [];
	if(!empty($location)){
		$location_data = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix."em_locations WHERE location_id = ".$location);
		$location_name = $location_data[0]->location_name;
		$location_region = $location_data[0]->location_region;
		$loc['location'] = $location_name .", ". $location_region;
		$loc['data'] = $location_data[0];
		return $loc;
	} else {
		return false;
	}
}



/*
* GET CATEGORIES OF EVENTS AND LOCATIONS
*/

function get_categories_of_posttype($event_id, $taxonomy){
	global $wpdb;
	$terms = get_the_terms( $event_id, $taxonomy );
	$cat = [];
    if ( $terms && ! is_wp_error( $terms ) ) {                
        $term_slugs_array = array();
        foreach ( $terms as $term ) {
            $term_slugs_array[] = $term->name;
            $term_slugs_links_array[] = '<a href="'.get_term_link($term->slug, $taxonomy).'"><span>'.$term->name.'</span></a>';
            $term_ids_array[] = $term->term_id;
            $data[] = $term;

        }
        $terms_slugs_string = join( ", ", $term_slugs_array );
        $terms_slugs_links = join( ", ", $term_slugs_links_array );
    }
    $cat['categories'] = $terms_slugs_string;
    $cat['categories_link'] = $terms_slugs_links;
    $cat['category_ids'] = $term_ids_array;
    $cat['category_data'] = $data;
    return $cat;
}
/*
* AVERAGE RATING
*/

function average_rating($post_id) {

    global $wpdb, $passedtext;
    $args = array('post_id' => $post_id);
    
    $comments = get_comments($args);
    
    $sum = 0;
    $count=0;
	foreach($comments as $comment) :	    
	     $approvedComment = $comment->comment_approved; 	    
	     if($approvedComment > 0){  
	     	$rates = get_comment_meta( $comment->comment_ID, 'rating', true );
	     }
	     if($rates){
	         $sum = $sum + (int)$rates;
	         $count++;
	     }	    
	endforeach;

	if($count != 0){ 
	    $result=   $sum/$count;
	} else {
	    $result= 0;
	}
    $chkresults = $wpdb->get_results( "SELECT option_value FROM ".$wpdb->prefix."options WHERE option_name = 'wpcr_settings'");
    $check2 = unserialize($chkresults[0]->option_value);
    $check_val = $check2['checkbox2'];
    
    $passedtext = $check_val;
    $html = '';
    // if($check_val == 'yes'){
        // if($count != 0){ 
		    $html .= '<a class="wpcr_tooltip" title="Average rating is '.round($result, 2).' out of 5"><span class="wpcr_stars" title="">';
		    // $html .=  'Average rating:';
		    $html .=  '</span>';
		    $html .=  '<span class="wpcr_averageStars" data-rating="'.$result.'"></span>';
		    $html .=  '</a>';
	    // } 
	// }
	return $html;
}


/*
* REMOVE PLUGIN UPDATES
*/
function filter_plugin_updates( $value ) {
    unset( $value->response['wp-post-comment-rating/wpcr-comment-rating.php'] );
    unset( $value->response['events-manager/events-manager.php'] );
    return $value;
}
add_filter( 'site_transient_update_plugins', 'filter_plugin_updates' );




/*
*
* POST VIEWS
*/

//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
function bac_PostViews($post_ID) {    
    $count_key = 'post_views_count'; 
    $count = get_post_meta($post_ID, $count_key, true);
     
    if($count == ''){
        $count = 0; 
        delete_post_meta($post_ID, $count_key);
        add_post_meta($post_ID, $count_key, '0');
        return true;
    } else {
        $count++; 
        update_post_meta($post_ID, $count_key, $count);
        return true;
    }
}


/*
* VIEW  COLUMN for EVENTS
*/
function get_PostViews($post_ID){
    $count_key = 'post_views_count';
    $count = get_post_meta($post_ID, $count_key, true);
    return $count;
}
 
function post_column_views($newcolumn){
	global $post;
	if( $post->post_type == "event") {
	    $newcolumn['post_views'] = __('Views');
	}
	return $newcolumn;
}
 
function post_custom_column_views($column_name, $id){
	global $post;
	if( $post->post_type == "event") {
	    if($column_name === 'post_views'){
	        echo get_PostViews(get_the_ID());
	    }
	}
}
add_filter('manage_posts_columns', 'post_column_views');
add_action('manage_posts_custom_column', 'post_custom_column_views',10,2);



/*
* RATING COLUMN FOR PLACE
*/
function get_PostRatings($post_ID){
    $count_key = 'post_average_rating';
    $count = get_post_meta($post_ID, $count_key, true);
    return $count;
}
 
function post_average_rating_column($newcolumn){
	global $post;
	if( $post->post_type == "place") {
	    $newcolumn['post_average_rating'] = __('Average rating');	    
	}
	return $newcolumn;
}
 
function post_custom_column_rating($column_name, $id){
	global $post;
	// print_r($post);
	if( $post->post_type == "place") {
	    if($column_name === 'post_average_rating'){
	        echo get_PostRatings(get_the_ID());
	    }
	}
}
add_filter('manage_posts_columns', 'post_average_rating_column');
add_action('manage_posts_custom_column', 'post_custom_column_rating',10,2);

/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////

/*
* Instagram widget images filter classes
*/

add_filter( 'wpiw_list_class', 'my_instagram_list_class' );

add_filter( 'wpiw_item_class', 'my_instagram_item_class' );
add_filter( 'wpiw_a_class', 'my_instagram_a_class' );
add_filter( 'wpiw_img_class', 'my_instagram_image_class' );
// add_filter( 'wpiw_linka_class', 'my_instagram_linka_class' );

function my_instagram_list_class( $classes ) {
    $classes = "visitarian-instagram-list";
    return $classes;
}
function my_instagram_item_class( $classes ) {
    $classes = "visitarian-instagram-item";
    return $classes;
}
function my_instagram_image_class( $classes ) {
    $classes = "visitarian-instagram-image";
    return $classes;
}
function my_instagram_a_class( $classes ) {
    $classes = "visitarian-instagram-anchor";
    return $classes;
}





/*
* REWRITE THE RULES FOR CATEGORY PAGES EVENT/LOCATION
*/

function generate_taxonomy_rewrite_rules( $wp_rewrite ) {
 
    $rules = array();
 
    $post_types = get_post_types( array( 'public' => true, '_builtin' => false ), 'objects' );
    $taxonomies = get_taxonomies( array( 'public' => true, '_builtin' => false ), 'objects' );

 //    $post_types = get_post_types( array( 'name' => 'location', 'public' => true, '_builtin' => false ), 'objects' );
	// $taxonomies = get_taxonomies( array( 'name' => 'place_categories', 'public' => true, '_builtin' => false ), 'objects' );

    foreach ( $post_types as $post_type ) {
        $post_type_name = $post_type->name;
        $post_type_slug = $post_type->rewrite['slug'];
 
        foreach ( $taxonomies as $taxonomy ) {
            if ( $taxonomy->object_type[0] == $post_type_name ) {
            	
                $terms = get_categories( array( 'type' => $post_type_name, 'taxonomy' => $taxonomy->name, 'hide_empty' => 0 ) );
                foreach ( $terms as $term ) {
                    // $rules[$post_type_slug . '/' . $term->slug . '/?$'] = 'index.php?' . $term->taxonomy . '=' . $term->slug;
                    // $rules[$post_type_slug . '/' . $term->slug . '/page/?([0-9]{1,})/?$'] = 'index.php?' . $term->taxonomy . '=' . $term->slug . '&page=' . $wp_rewrite->preg_index( 1 );
                    if($term->taxonomy=='place_categories'){
                    	$rules['places/categories/' . $term->slug . '/?$'] = 'index.php?' . $term->taxonomy . '=' . $term->slug;
						$rules['places/categories/' . $term->slug . '/page/?([0-9]{1,})/?$'] = 'index.php?' . $term->taxonomy . '=' . $term->slug . '&page=' . $wp_rewrite->preg_index( 1 );
                    }
                    if($term->taxonomy=='event-categories'){
                    	$rules['events/categories/' . $term->slug . '/?$'] = 'index.php?' . $term->taxonomy . '=' . $term->slug;
						$rules['events/categories/' . $term->slug . '/page/?([0-9]{1,})/?$'] = 'index.php?' . $term->taxonomy . '=' . $term->slug . '&page=' . $wp_rewrite->preg_index( 1 );
                    }

                }
            }
        }
    }
    $wp_rewrite->rules = $rules + $wp_rewrite->rules;
 
}
 
add_action('generate_rewrite_rules', 'generate_taxonomy_rewrite_rules');

/*
* ADD PLACE POST TYPE
*/ 
function create_place(){
   	$labels = array(
	    'name'               => _x( 'Place', 'Place', 'visitarians' ),
	    'singular_name'      => _x( 'Place', 'Place', 'visitarians' ),
	    'menu_name'          => _x( 'Places', 'Places', 'visitarians' ),
	    'name_admin_bar'     => _x( 'Place', 'add new on admin bar', 'visitarians' ),
	    'add_new'            => _x( 'Add New', 'Place', 'visitarians' ),
	    'add_new_item'       => __( 'Add New Place', 'visitarians' ),
	    'new_item'           => __( 'New Place', 'visitarians' ),
	    'edit_item'          => __( 'Edit Place', 'visitarians' ),
	    'view_item'          => __( 'View Place', 'visitarians' ),
	    'all_items'          => __( 'All Place', 'visitarians' ),
	    'search_items'       => __( 'Search Place', 'visitarians' ),
	    'not_found'          => __( 'No Place found.', 'visitarians' ),
	    'not_found_in_trash' => __( 'No Place found in Trash.', 'visitarians' )
	);
   	$args = array(
	    'labels'             => $labels,
	    'description'        => __( 'Description.', 'Add New Place on visitarians' ),
	    'public'             => true,
	    'publicly_queryable' => true,
	    'show_ui'            => true,
	    'show_in_menu'       => true,
	    'query_var'          => true,
	    'rewrite'            => array( 'slug' => 'place' ),
	    'has_archive'        => true,
	    'hierarchical'       => false,
	    'menu_position'      => 100,
	    'menu_icon'          =>'dashicons-cart',
	    'supports'           => array( 'title','editor','excerpt','custom-fields','comments','thumbnail','author' ),
	    'taxonomies'         => array('place_categories')
	);
    register_post_type( 'place', $args );
 }

 add_action( 'init', 'create_place' );

/*
* ADD LOCATION TEXONOMY
*/ 

add_action( 'init', 'create_place_category_taxonomies', 10 );

function create_place_category_taxonomies() {
	$labels = array(
		'name'              => _x( 'Place Categories', 'Place Categories'),
		'singular_name'     => _x( 'Place Category', 'Place Category'),
		'search_items'      => __( 'Search Place Categories ', 'visitarians' ),
		'all_items'         => __( 'All Place Categories', 'visitarians' ),
		'parent_item'       => __( 'Parent Place Category', 'visitarians' ),
		'parent_item_colon' => __( 'Parent Place Category:', 'visitarians' ),
		'edit_item'         => __( 'Edit Place Category', 'visitarians' ),
		'update_item'       => __( 'Update Place Category', 'visitarians' ),
		'add_new_item'      => __( 'Add New Place Category', 'visitarians' ),
		'new_item_name'     => __( 'New Place Category', 'visitarians' ),
		'menu_name'         => __( 'Place Categories', 'visitarians' ),
	);

	$args = array(
		'hierarchical'      => true,
		'public'      		=> true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_in_menu' 		=> true,
	//  'show_in_nav_menus' => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'label' 			=> __('Place Categories','visitarians'),
		'singular_label' 	=> __('Place Category','visitarians'),
		'rewrite'           => array( 'slug' => 'places/categories', 'hierarchical' => true, 'with_front' => true),
	);

	register_taxonomy( 'place_categories', array( 'place' ), $args );

}

///////////////////////////////////////////////////////
/*  META BOXES  */
///////////////////////////////////////////////////////


  //hook to add a meta box
add_action( 'add_meta_boxes', 'visitarian_metaboxes' );

function visitarian_metaboxes() {
    //create a custom meta box
    add_meta_box( 'place-featured-meta', 'Featured Selector', 'visitarian_metaboxes_featured_function', array('event', 'place'), 'normal', 'default' );
    add_meta_box( 'place-organizer-meta', 'Organizer', 'visitarian_metaboxes_organizer_function', array('event'), 'normal', 'default' );
    add_meta_box( 'place-address-meta', 'Address for your place', 'visitarian_metaboxes_address_function', array('place'), 'normal', 'default' );
}

function visitarian_metaboxes_address_function( $post ) {
    $place_data = get_post_custom( $post->ID );
    echo 'Please enter address for your place.';
    ?>
   <p>
	    <label>Address:</label>
	    <input id="location-address" type="text" name="location_address" value="<?php echo $place_data["location_address"][0] ?>">
   </p> 
   <p>
    <label>City/Town:</label>
            <input type="text" name="location_town" value="<?php echo $place_data["location_town"][0] ?>" class="width99" placeholder="City/Town" />
   </p>
    <p>
    <label>State/County:</label>
            <input type="text" name="location_state" value="<?php echo $place_data["location_state"][0] ?>" class="s" placeholder="State/County"/>
    </p>
    <p>
    <label>Postcode:</label>
            <input type="text" name="location_postcode" value="<?php echo $place_data["location_postcode"][0] ?>" class="s" placeholder="Post code"/>
    </p>
    <p>
    <label>Region:</label>
            <input type="text" name="location_region" value="<?php echo $place_data["location_region"][0] ?>" class="s" placeholder="Place region"/>
    </p>
    <p>
    <label>Country:</label>
            <input type="text" name="location_country" value="<?php echo $place_data["location_country"][0] ?>" class="s" placeholder="Enter country"/>
    </p>
    <?php
}

function visitarian_metaboxes_organizer_function( $post ) {
    $event_organizer = get_post_meta( $post->ID, 'event_organizer', true );
    echo 'Enter event organizer';
    ?>
    <p>
	    <label>Organizer:</label>
	    <input id="event_organizer" type="text" name="event_organizer" value="<?php echo $event_organizer; ?>">
   </p> 
    <?php
}
function visitarian_metaboxes_featured_function( $post ) {
    $visitarian_featured = get_post_meta( $post->ID, 'visitarian_featured', true );
    echo 'Select yes below to make this featured post';
    ?>
    <p>Featured: 
    <select name="visitarian_featured">
        <option value="No" <?php selected( $visitarian_featured, 'No' ); ?>>No</option>
        <option value="Yes" <?php selected( $visitarian_featured, 'Yes' ); ?>>Yes</option>
    </select>
    </p>
    <?php
}

//hook to save the meta box data
add_action( 'save_post', 'visitarian_metaboxes_save_function' );
function visitarian_metaboxes_save_function( $post_ID ) {
    global $post;
    if( $post->post_type == "event" ) {
        if ( isset( $_POST ) ) {
            update_post_meta( $post_ID, 'visitarian_featured', strip_tags( $_POST['visitarian_featured'] ) );
            update_post_meta( $post_ID, 'event_organizer', strip_tags( $_POST['event_organizer'] ) );
        }
    }

    if( $post->post_type == "place") {
        if ( isset( $_POST ) ) {
        	update_post_meta( $post_ID, 'visitarian_featured', strip_tags( $_POST['visitarian_featured'] ) );
        	update_post_meta($post->ID, "location_address", $_POST["location_address"]);
			update_post_meta($post->ID, "location_town", $_POST["location_town"]);
			update_post_meta($post->ID, "location_state", $_POST["location_state"]);
			update_post_meta($post->ID, 'location_postcode', $_POST['location_postcode']);
			update_post_meta($post->ID, 'location_region', $_POST['location_region']);
        	update_post_meta( $post_ID, 'location_country', $_POST['location_country']);
        }
    }
}

/*
* GET LOCATIONS OF PLACE
*/

function get_location_of_place($place_id){
	global $wpdb;
	$place_data = get_post_custom( $post->ID );
	$location = [];
	$location['location_address'] = $place_data["location_address"][0];
	$location['location_town'] = $place_data["location_town"][0];
	$location['location_state'] = $place_data["location_state"][0];
	$location['location_postcode'] = $place_data["location_postcode"][0];
	$location['location_region'] = $place_data["location_region"][0];
	$location['location_country'] = $place_data["location_country"][0];
	$location['location'] = $place_data["location_address"][0] . ', ' .$place_data["location_region"][0];

	return $location;
	
}



add_filter( 'post_row_actions', 'mycustomtheme_remove_myposttype_row_actions' );
function mycustomtheme_remove_myposttype_row_actions( $action )
{
    if ('location' == get_post_type()) {
        unset($action['view']);
    }
    return $action;
}