<?php
get_header('new');

global $wpdb;
$wpdb_prefix = $wpdb->prefix;

$search = $_GET['search'];
if(isset($_GET['tagid'])){
	$tagid = $_GET['tagid'];

	 $args=array(
	 	's'=> $search,
	 	'post_type' => 'event',
	 	'order'=> 'DESC',
	 	'posts_per_page'=> '-1',
	 		'meta_query' => array(
		        array(
		            'key' => 'event_tags',
		            'value' => $_GET['tagid'],
		            'compare' => 'LIKE',
		        ),
		    ),
	 	);
	$query = new WP_Query( $args );
	$allpost = array_column($query->posts, ID);

}else{
	$get_results = $wpdb->get_results("SELECT ID FROM ".$wpdb_prefix."posts WHERE `post_title` LIKE '%".$search."%' AND post_type = 'event'");
	$allpost = array_column($get_results, ID);
}
?>
<div class="topbanner">
	<div class="container">
		<div class="text-block">
			<h2>Search Page</h2>
		</div>
	</div>
</div>
<?php
//$get_results = $wpdb->get_results("SELECT ID FROM ".$wpdb_prefix."posts WHERE `post_title` LIKE '%".$search."%' AND post_type = 'event'");
// echo "SELECT ID FROM ".$wpdb_prefix."posts WHERE `post_title` LIKE '%".$search."%' AND post_type = 'event'";
// echo "<pre>";print_r($get_results);
//$post2 = get_posts($args);
// $args = array(
//     'post_type' => 'event',
//     'post_title' => $search,
//     'meta_query' => array(
//         array(
//             'key' => 'event_tags',
//             'value' => $_GET['tagid'],
//             'compare' => 'IN',
//         )
//     )
//     );
// $the_query = new WP_Query($args);
// $post2 = get_posts($args);
// echo "<pre>";print_r($the_query);
// $allpost = array_column($get_results, ID);
?>
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
			echo '<li class="'.$tagactive.'"><a href="?search='.$search.'&tagid='.$tagvalue->term_id.'">'.$tagvalue->name.'</a></li>';

		}
		?>
	</ul>

</div>
<!-- <h3><?php ///echo $search;?></h3> -->
<div class="main-section row">

	<div class="col-sm-8">
		<div class="tab-content-row">
	<?php
	if(!empty($allpost)){
	foreach ($allpost as $key => $value) {
		$event_tags = get_post_meta( $post->ID, 'event_tags', true );
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
	
	<?php } 
}else{
	echo "No Events Found";
}
?>
</div>
	</div>
	<div class="col-sm-4">
		<div class="sidebar-box">
			<h2>Other upcoming events</h2>
			<?php
			
			 echo do_shortcode( '[upcoming_posts]' );
			?>
		</div>
	</div>
</div>

<?php 
 get_template_part('customfooter/slotssø-badet-footer');
get_footer(); ?>