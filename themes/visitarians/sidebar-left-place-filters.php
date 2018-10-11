<div class="filter-box">
	<h3 class="sub-heading">Place Filter</h3>
	<ul class="filter-list">
	<?php 
	$taxonomy = 'place_categories';
	$terms = get_terms($taxonomy);
	foreach ($terms as $term) {
		$page_object = get_queried_object(); 
		if($page_object->slug == $term->slug){
			$class= 'active';
		}else{
			$class= '';
		}
	    echo '<li><a class="'.$class.'" href="'.get_term_link($term->slug, $taxonomy).'">
	    <span>'.$term->name.'</span><i class="fa fa-angle-right" aria-hidden="true"></i></a>
	    </li>';
	}
	?>
	</ul>
</div>
