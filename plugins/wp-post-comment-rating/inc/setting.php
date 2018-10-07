<?php
add_action('wp_head', 'wpcr_style_options'); 

/////// change rating stars ///////
function wpcr_style_options() { 
	global $check;
	global $wpdb;
    
	$results = $wpdb->get_results( "SELECT option_value FROM ".$wpdb->prefix."options WHERE option_name = 'wpcr_settings'");
	$val = unserialize($results[0]->option_value);
	$label_color = $val['txtcolor'];
	$ratingimage = $val['rateimage'];
	
	if($ratingimage == "grateimg"){
		$ratingimg = 'stars';
	}elseif($ratingimage == "orateimg"){
		$ratingimg = 'stars-orange';
	}else{
		$ratingimg = 'stars';
	}
	
	?>
	<style type="text/css">
		fieldset.rating > legend{
			color:<?php echo $label_color;?>
		}

		.comment-form-comment, .comment-notes {clear:both;}
		.rating {
			float:left;
		}

		/* :not(:checked) is a filter, so that browsers that don’t support :checked don’t 
		   follow these rules. Every browser that supports :checked also supports :not(), so
		   it doesn’t make the test unnecessarily selective */
		.rating:not(:checked) > input {
			position:absolute;
			/*top:-9999px;*/
			clip:rect(0,0,0,0);
		}

		.rating:not(:checked) > label {
			float:right;
			width:1em;
			padding:0 .1em;
			overflow:hidden;
			white-space:nowrap;
			cursor:pointer;
			font-size:150%;
			line-height:1.2;
			color:#ddd;
			text-shadow:1px 1px #bbb, 2px 2px #666, .1em .1em .2em rgba(0,0,0,.5);
		}

		.rating:not(:checked) > label:before {
			content: '★ ';
		}

		.rating > input:checked ~ label {
			color: #f70;
			text-shadow:1px 1px #c60, 2px 2px #940, .1em .1em .2em rgba(0,0,0,.5);
		}

		.rating:not(:checked) > label:hover,
		.rating:not(:checked) > label:hover ~ label {
			color: gold;
			text-shadow:1px 1px goldenrod, 2px 2px #B57340, .1em .1em .2em rgba(0,0,0,.5);
		}

		.rating > input:checked + label:hover,
		.rating > input:checked + label:hover ~ label,
		.rating > input:checked ~ label:hover,
		.rating > input:checked ~ label:hover ~ label,
		.rating > label:hover ~ input:checked ~ label {
			color: #ea0;
			text-shadow:1px 1px goldenrod, 2px 2px #B57340, .1em .1em .2em rgba(0,0,0,.5);
		}

		.rating > label:active {
			position:relative;
			top:2px;
			left:2px;
		}
		p.logged-in-as {clear:both;}
		span.wpcr_author_stars, span.wpcr_author_stars span {
			display: block;
			background: url(<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'images/'.$ratingimg.'.png'?>) 0 -16px repeat-x;
			width: 80px;
			height: 16px;
		}

		span.wpcr_author_stars span {
			background-position: 0 0;
		}
		span.wpcr_averageStars, span.wpcr_averageStars span {
			display: block;
			background: url(<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'images/'.$ratingimg.'.png'?>) 0 -16px repeat-x;
			width: 80px;
			height: 16px;
		}

		span.wpcr_averageStars span {
			background-position: 0 0;
		}

		/*for tooltip*/
		.wpcr_tooltip{
			display: inline;
			position: relative;
			width:100%;
			float:left;
			font-size: 14px;
		}
		a.wpcr_tooltip span.wpcr_stars {float:left;}
		a.wpcr_tooltip span.wpcr_averageStars {float:left; margin-left:5px; margin-right:5px;}
		.wpcr_tooltip:hover:after{
			background: #333;
			background: rgba(0,0,0,.8);
			border-radius: 5px;
			bottom: 26px;
			color: #fff;
			content: attr(title);
			left: 20%;
			padding: 5px 15px;
			position: absolute;
			z-index: 98;
			width: 220px;
		}
		.wpcr_tooltip:hover:before{
			border: solid;
			border-color: #333 transparent;
			border-width: 6px 6px 0 6px;
			bottom: 20px;
			content: "";
			left: 50%;
			position: absolute;
			z-index: 99;
		}
		#hide-stars {display:none;}
		#review_form .rating {display:none;}
		#reviews .wpcr_author_stars {display:none;}
	</style>
<?php
}
