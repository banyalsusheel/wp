<?php
add_action( 'comment_form_top', 'wpcr_change_comment_form_defaults');
function wpcr_change_comment_form_defaults( ) {
	global $check;
	global $wpdb;
    
	//// get rating value from database
	$ratingValues = $wpdb->get_results( "SELECT meta_value FROM ".$wpdb->prefix."commentmeta WHERE meta_key = 'rating'");
	$results = $wpdb->get_results( "SELECT option_value FROM ".$wpdb->prefix."options WHERE option_name = 'wpcr_settings'");
	//var_dump(unserialize($results[0]->option_value));
	$a = unserialize($results[0]->option_value);
	$b = $a['checkbox1'];
	$check = $a['checkbox1'];
	$stars_label = $a['rtlabel'];
	if($stars_label !== ''){
		$st_label = $stars_label;
	}else{
		$st_label = 'Please rate this media';
	}
	
	if($b == 'yes'){
			
    echo '<fieldset class="rating">
    <legend>'.$st_label.'<span class="required">*</span></legend>
    <input required type="radio" id="star5" name="rating" value="5" /><label for="star5" title="Rocks!">5 stars</label>
    <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Pretty good">4 stars</label>
    <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Meh">3 stars</label>
    <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Kinda bad">2 stars</label>
    <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Sucks big time">1 star</label>
	</fieldset>';
		
	}
}
 

//////// save comment meta data ////////
add_action( 'comment_post', 'wpcr_save_comment_meta_data' );

function wpcr_save_comment_meta_data( $comment_id ) {
	$rating =  (empty($_POST['rating'])) ? FALSE : $_POST['rating'];
    add_comment_meta( $comment_id, 'rating', $rating );
    update_average_rating($_POST['comment_post_ID']);
}


function update_average_rating($post_id) {
    global $wpdb;
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
	update_post_meta( $post_id, 'post_average_rating', round($result, 2) );
}

///////// validate meta field /////////
$review_setting = get_option( 'woocommerce_enable_review_rating' );
$options = get_option( 'wpcr_settings' );
if ( $options['checkbox1'] == 'yes' ) {
	
	add_filter( 'preprocess_comment', 'wpcr_verify_comment_meta_data' );
	
}
function wpcr_verify_comment_meta_data( $commentdata ) {
	
	if ( ! isset( $_POST['rating'] ) )
		if($_POST['comment_parent'] == 0)
			if ( 'product' != get_post_type() ) 			
        wp_die( __( 'Error: Please rate this media.' ) );
				
    return $commentdata;
}

//////// add average rating with post meta tags /////////
function wpcr_tag_aggr() {
	
	global $passedtext , $post;
	
	$args = array('post_id' => $post->ID);
	
	$comments = get_comments($args);
	//var_dump($comments);
	
	$sum = 0;
	$count=0;
	//if(is_single()){
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
	global $wpdb;
	$chkresults = $wpdb->get_results( "SELECT option_value FROM ".$wpdb->prefix."options WHERE option_name = 'wpcr_settings'");
	$check2 = unserialize($chkresults[0]->option_value);
	$check_val = $check2['checkbox2'];
	
	$passedtext = $check_val;
	
	if($check_val == 'yes'){
		if($count != 0){ 
	echo '<a class="wpcr_tooltip" title="Average rating is '.round($result, 2).' out of 5"><span class="wpcr_stars" title="">';
	echo 'Average rating:';
	echo '</span>';
	echo '<span class="wpcr_averageStars" data-rating="'.$result.'"></span>';
	echo '</a>';
	} }
//}
}

add_filter( "the_tags", 'wpcr_tag_aggr' );


///// show rating stars with visitors comment /////////
add_filter('comment_text','wpcr_comment_tut_add_title_to_text',99,2);
function wpcr_comment_tut_add_title_to_text($text,$comment){ 
    
	global $passedtext;
	global $wpdb;
	$results = $wpdb->get_results( "SELECT option_value FROM ".$wpdb->prefix."options WHERE option_name = 'wpcr_settings'");
	$a = unserialize($results[0]->option_value);
	$check1 = $a['checkbox1'];
	
		
    if($title=get_comment_meta($comment->comment_ID,'rating',true))
    {
		
		if($check1 == 'yes' ){
        	$title='<span class="wpcr_author_stars" data-rating="'.$title.'" ></span>';
			$text=$title.$text;
		}else{
			 $text=$text;
		}
        
    }
    return $text;
}
