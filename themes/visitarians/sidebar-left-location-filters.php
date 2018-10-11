<div class="filter-box">
	<h3 class="sub-heading">Event Locations</h3>
	<ul class="filter-list">
<?php
$args = array(
    'post_type' => 'location',
    'orderby' => 'ID',
    'order' => 'DESC',
);
$location_of_post = get_post_meta($post->ID, '_location_id', true);
$location = new WP_Query($args);

while ($location->have_posts()) {
    $location->the_post();

	$location_id = get_post_meta(get_the_ID(), '_location_id', true);
	
    if ($location_id == $location_of_post) {
        $class = 'active';
    } else {
        $class = '';
    }
	 
    echo '<li><a class="'.$class.'" href="'.esc_url( get_permalink() ).'"><span>'.get_the_title().'</span><i class="fa fa-angle-right" aria-hidden="true"></i></a>
    </li>';
}
?>
	</ul>
</div>
