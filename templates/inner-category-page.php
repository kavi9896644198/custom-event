<?php
get_header('new');
$term = get_queried_object();
//echo "<pre>";print_r($term->parent);die;
//badeland
if(!empty($term)){
 $term_id = $term->term_id;
}
//echo $term_id;
global $wpdb;
$wpdb_prefix = $wpdb->prefix;
$sub_cat = $_GET['ids'];

// if(isset($_GET['tagid'])){
// 	$tagid = $_GET['tagid'];

// 	 $args=array(
// 	 	'post_type' => 'event',
// 	 	'order'=> 'DESC',
// 	 	'posts_per_page'=> '-1',
// 	 		'meta_query' => array(
// 		        array(
// 		            'key' => 'event_tags',
// 		            'value' => $_GET['tagid'],
// 		            'compare' => 'LIKE',
// 		        ),
// 		    ),
// 	 	);
// 	$query = new WP_Query( $args );
// 	$allpost = array_column($query->posts, ID);
	
// }else{

	$allpost = json_decode(get_term_meta($term_id,'update_event_in_category',true));
	//$allpost = implode(',', $update_event_category); 
	//echo "<pre>";print_r($allpost);
	
	// $result = $wpdb->get_results("SELECT post_id FROM `".$wpdb_prefix."postmeta` WHERE `meta_key` = 'secondary_category' AND FIND_IN_SET(".$sub_cat.", `meta_value`) AND post_type = 'event'");
	// $allpost = array_column($result, post_id);
//}
//echo "<pre>";print_r($allpost);
$image = get_term_meta( $term_id, 'custom_taxonomy_image', true );
	if(!empty($image)){
            $image = get_term_meta( $term_id, 'custom_taxonomy_image', true );
        }else{
             $image = '/wp-content/uploads/2023/06/DSCF129.png';  
        }
        $taxonomy = 'ccategory_taxonomy';
		$args = array(
		    'taxonomy'   => $taxonomy,
		    'hide_empty' => false,
		    'parent' => 0,
		);

		$categories = get_terms($args);
		
	?>
	<div class="topbanner" style="background: url('<?php echo $image; ?>');">
	<div class="container">
		<div class="text-block">
			<?php
			//foreach ($categories as $key => $value){ 
				//echo "<pre>";print_r($value);
				//if($value->term_id == $term->parent){
				?>
			<h2><?php echo $term->name; ?></h2>
		<?php// } 
	//}
	?>
		</div>
	</div>
</div>
<div class="tab-list">
	<ul>
		<?php
		$taxonomy = 'event_tag';
		$tags = get_terms(array(
	        'taxonomy' => $taxonomy,
	        'hide_empty' => false,
	    ));
		foreach ($tags as $tagkey => $tagvalue) {
			//echo "<pre>";print_r($tagvalue);
			$tagactive = ($_GET['tagid'] == $tagvalue->term_id) ? "active" : "";
			echo '<li class="'.$tagactive.'"><a href="?ids='.$sub_cat.'&tagid='.$tagvalue->term_id.'">'.$tagvalue->name.'</a></li>';

		}
		?>
		<!-- <li><a href="#">BADELAND</a></li>
		<li><a href="#">TRÆNING OG MOTION</a></li>
		<li><a href="#">WELLNESS OG SAUNA</a></li>
		<li><a href="#">FESTER OG SELSKABER</a></li>
		<li><a href="#">KONCERTER</a></li>
		<li><a href="#">OUTDOOR</a></li>
		<li><a href="#">MØDER OG KONFERENCER</a></li> -->
	</ul>
</div>
<div class="main-section row">
	<div class="col-sm-8">
		<div class="tab-content-row">
	<?php
	if(!empty($allpost)){
	foreach ($allpost as $key => $value) {
		if(isset($_GET['tagid'])){
			if($post->post_status != 'trash' && $post->post_status != 'draft'){
			$event_tags = explode(',',get_post_meta( $value, 'event_tags', true ));
			if(in_array($_GET['tagid'], $event_tags)){
				$url = wp_get_attachment_url( get_post_thumbnail_id($value), 'thumbnail' );
				$post_url = get_post_permalink($value);
				$post_content = get_field( 'short_description', $value );
		        if(!empty($url)){
		            $image = wp_get_attachment_url( get_post_thumbnail_id($value), 'thumbnail' );
		        }else{
		          $image = '/wp-content/uploads/2023/06/DSCF129.png';  
		        }
		        $post = get_post( $value );
		        $post_title = isset( $post->post_title ) ? $post->post_title : '';
		        ?>
	<div class="tab-content-col">
		<a href="<?php echo $post_url ?>">
        <div class="home-grid-col-content" data-category_id="<?php echo $value;?>">
            <img src="<?php echo $image; ?>">
            <div class="grid_overlay-content">
                <h2><?php echo $post_title; ?></h2>
                
            </div>
        </div>
        <div class="main-desc-section">
        	<div class="date-icon">
        		<span><img src="/wp-content/uploads/2023/06/calend.png"><?php echo get_the_date('d F', $value); ?></span>
        	</div>
        	<p><?php echo get_post_meta( $post->ID, 'short_description', true );?></p>
        	<div class="row location-icon">
        		<div class="col-sm-6">
        			<div class="date-icon">
		        		<span><img src="/wp-content/uploads/2023/06/lock.png">Slotssø Badet</span>
		        	</div>
        		</div>
        		<div class="col-sm-6">
        			<div class="date-icon">
		        		<span><img src="/wp-content/uploads/2023/06/Clock.png">Kl. 18.00</span>
		        	</div>
        		</div>
        	</div>

        </div>
        </a>
         <div class="see-more"><a href="<?php echo $post_url ?>" target="" class="">SE MERE</a></div>

    </div>
		        <?php
		    }
			}
			
		}else{ 
			$post = get_post($value);
			//echo "<prE>";print_r($post->post_status);
			if(!empty($post)){
				if($post->post_status != 'trash' && $post->post_status != 'draft'){
			$url = wp_get_attachment_url( get_post_thumbnail_id($value), 'thumbnail' );
			$post_url = get_post_permalink($value);
			//echo $post_url;
			$post_content = get_field( 'short_description', $value );
	        if(!empty($url)){
	            $image = wp_get_attachment_url( get_post_thumbnail_id($value), 'thumbnail' );
	        }else{
	          $image = '/wp-content/uploads/2023/06/DSCF129.png';  
	        }
	        //$post = get_posts($value);
	        $post_title = isset( $post->post_title ) ? $post->post_title : '';
	        ?>
	<div class="tab-content-col">
		<a href="<?php echo $post_url ?>">
        <div class="home-grid-col-content" data-category_id="<?php echo $value;?>">
            <img src="<?php echo $image; ?>">
            <div class="grid_overlay-content">
                <h2><?php echo $post_title; ?></h2>
                
            </div>
        </div>
        <div class="main-desc-section">
        	<div class="date-icon">
        		<span><img src="/wp-content/uploads/2023/06/calend.png"><?php echo get_the_date('d F', $value); ?></span>
        	</div>
        	<p><?php echo get_post_meta( $post->ID, 'short_description', true );?></p>
        	<div class="row location-icon">
        		<div class="col-sm-6">
        			<div class="date-icon">
		        		<span><img src="/wp-content/uploads/2023/06/lock.png">Slotssø Badet</span>
		        	</div>
        		</div>
        		<div class="col-sm-6">
        			<div class="date-icon">
		        		<span><img src="/wp-content/uploads/2023/06/Clock.png">Kl. 18.00</span>
		        	</div>
        		</div>
        	</div>

        </div>
        </a>
         <div class="see-more"><a href="<?php echo $post_url ?>" target="" class="">SE MERE</a></div>

    </div>
	        <?php
	    }
	      }
		}
		//echo "<pre>";print_r($event_tags);
		
	?>
	
	
	<?php } 
}else{
	echo "No Events";
}
?>
</div>
	</div>
	<div class="col-sm-4">
		<div class="sidebar-box">
			<h2>Other upcoming events</h2>
			<?php
			
			 echo do_shortcode( '[upcoming_posts]' );
			// $posts = $wpdb->get_results("SELECT post_id FROM $wpdb->postmeta WHERE meta_key = 'month' AND  meta_value = '3' LIMIT 1", ARRAY_A);
			// echo "<pre>";print_r($posts);
			?>
		</div>
	</div>
</div>
