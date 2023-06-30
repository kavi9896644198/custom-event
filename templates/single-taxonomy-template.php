<?php
/**
 * Template Name: custom texonomy Page
 * Template Post Type:Page
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 */

get_header('new');
$term = get_queried_object();
//echo "<pre>";print_r($term->slug);die;
//badeland
if(!empty($term)){
 $term_id = $term->term_id;
}else{
	return 'Not found Event';
}
if($term->slug =='badeland'){
?>
<div id="home_content_1" class="home_content_badeland">
    	<div class="container">
    		<?php 
					$args = array(
					    'post_type' => 'event',
					    'post_status' => 'publish',
					    'posts_per_page' => 7,
					    'meta_query' => array(
					        array(
								'key' => 'option_category',
								'value' => $term_id,
								'compare' => '='
							)
					    ),
					);
					$posts = get_posts($args);
					global $wpdb;
					$table_name = $wpdb->prefix . 'frontpage_tab';
					$query = "SELECT * FROM $table_name WHERE get_tab_id = %s";
					$column1_value = 'tab-1';
					$prepared_query = $wpdb->prepare($query, $column1_value);
					$results = $wpdb->get_row($prepared_query);
					$post_ids =json_decode($results->post_ids);
					if(!empty($post_ids)){
    				?>
    		<div class="home_top">
    			<div class="home_top_left">
    				<?php 
    				foreach ($post_ids as $key => $post){
    					if($key == 0){
    						$url = wp_get_attachment_url( get_post_thumbnail_id($post), 'thumbnail' );
							$post_url = get_post_permalink($post);
							$post_content = get_field( 'short_description', $post );
							if(!empty($url)){
								$url = wp_get_attachment_url( get_post_thumbnail_id($post), 'thumbnail' );
							}else{
								$url = '/wp-content/uploads/2023/05/backgroundimg.png';
							}
    				?>
    				<div class="hometop_img_big_block_1 big_height_1 winter_block" style="background-image:url('<?php echo $url; ?>');">
    					<div class="cap">
    						<a href="<?php echo $post_url ?>" target=""> <h1><?php echo ucfirst(get_the_title($post)); ?></h1></a>
    						<p></p>
    						<a href="<?php echo $post_url ?>" target="" class="btn">Læs mere</a>
    					</div>
    				</div>
    			<?php } } ?>
    				<div class="home_top_left_inn">
    					<?php 
							foreach ($post_ids as $key =>$post){
							if($key == 1 || $key == 2 || $key == 3){
								$url = wp_get_attachment_url( get_post_thumbnail_id($post), 'thumbnail' );
								$post_url = get_post_permalink($post);
								if(!empty($url)){
								$url = wp_get_attachment_url( get_post_thumbnail_id($post), 'thumbnail' );
								}else{
									$url = '/wp-content/uploads/2023/05/backgroundimg.png';
								}
								?>
    					<div class="block">
    						<div class="hometop_img_small_block_3 small_height_1 obs_block" style="background-image:url('<?php echo $url; ?>');">
    							<div class="cap">
    								<a href="<?php echo $post_url; ?>" target=""><h4><?php echo ucfirst(get_the_title($post)); ?></h4></a>
    							</div>
    							<a href="<?php echo $post_url; ?>" target="" class="see_more_link">Læs mere</a>
    						</div>
    					</div>
    				<?php }} ?>
    				</div>
    			</div>
    			<div class="home_top_right">
    				<div class="home_top_right_inn">
    					<div class="block">
    						<div class="hometop_img_small_block_1 covid_block small_height_1 " style="background-color: #2F75C5;">
    							<div class="cap">
    								<a href="https://order.lifepeaks.dk/slotssobadet---dronning-dorotheas-badstue-og-sct-jorgensgaard" target=""><h4>COVID 19</h4></a>
    								<h4>SlotssøBadet holder åbent</h4>
    								<p>Husk gyldigt <br>coronapas samt</p>
    								<div class="covid_icon">
    									<img src="/wp-content/uploads/2023/06/covid-img.png" alt="billeter ssbad">
    								</div>
    							</div>
    							<a href="https://order.lifepeaks.dk/slotssobadet---dronning-dorotheas-badstue-og-sct-jorgensgaard" target="" class="see_more_link">Se mere</a>
    						</div>
    					</div>

    					<div class="block">
    						<div class="hometop_img_small_block_2 hometop_img_small_block_2_timing small_height_1">
    							<div class="clock_img"><img src="/wp-content/uploads/2022/12/clock_img_2.png" alt=""></div>
    							<div class="cap">
    								<a href="/slotsso-badet/aabningstider/" target=""><h4>Åbningstider</h4></a>
    								<p>Se alle åbningstider i SlotssøBadet på hverdage og…</p>
    							</div>
    							<a href="/slotsso-badet/aabningstider/" target="" class="see_more_link">Se mere</a>
    						</div>
    					</div>
    				</div>
    				<?php 
					foreach ($post_ids as $key => $post){
						if($key == 4){
							$url = wp_get_attachment_url( get_post_thumbnail_id($post), 'thumbnail' );
							$post_url = get_post_permalink($post);
							if(!empty($url)){
								$url = wp_get_attachment_url( get_post_thumbnail_id($post), 'thumbnail' );
							}else{
								$url = '/wp-content/uploads/2023/05/backgroundimg.png';
							}
							?>
    				<div class="dolphin_block big_height_1" style="background-image:url('<?php echo $url; ?>'); background-position: center right; background-size:cover;">                    	
    					<div class="desc">
    						<a href="<?php echo $post_url ?>" target=""><h2><?php echo ucfirst(get_the_title($post)); ?></h2></a>
    						<!-- <p>Tilmeld dit barn til en af vores populære delfinuger i SlotssøBadet</p> -->
    					</div>
    					<a href="<?php echo $post_url ?>" target="" class="see_more_link">Læs mere</a>
    				</div>
    			<?php }} ?>
    			</div>
    		</div>
    		<div class="delfinweekend_block">
    			<div class="img">
    				<a href="/koncerter/" target=""><img src="/wp-content/uploads/2022/12/danny-howe-bn-D2bCvpik-unsplash1.jpg" alt=""></a>
    			</div>
    			<div class="desc">
    				<a href="/koncerter/" target=""><h3>Koncerter</h3></a>
    				<p>Køb billet til vores koncerter</p>
    				<a href="/koncerter/" target="" class="btn">Læs mere</a>
    			</div>
    		</div>
    		<div class="home_bot">
    			<div class="home_bot_left">
    				<div class="gift_card_block small_height_1">
    					<div class="img">
    						<img src="/wp-content/uploads/2022/12/img_10.png" alt="">
    					</div>
    					<div class="desc">
    						<div class="desc_inn">
    							<a href="/slotsso-badet/gavekort-til-slotssoebadet/" target=""><h4>Gavekort/Eventbillet til SlotssøBadet</h4></a>
    							<p>Giv den perfekte gave. Et gavekort til SlotssøBadet kan bruges i alle vores afdelinger.</p>
    						</div>
    					</div>
    					<a href="/slotsso-badet/gavekort-til-slotssoebadet/" target="" class="see_more_link">Se mere</a>
    				</div>
    			</div>
    			<div class="home_bot_right">
    				<div class="home_bot_right_inn">
    					<div class="block">
    						<div class="homebot_img_small_block_1 small_height_1" style="background-image:url(/wp-content/uploads/2022/09/blamandag1.png);">
    							<div class="cap">
    								<a href="/slotsso-badet/bla-mandag/" target=""><h4>Blå Mandag Kolding 2023</h4></a>
    							</div>
    							<a href="/slotsso-badet/bla-mandag/" target="" class="see_more_link white_arr">Se mere</a>
    						</div>
    					</div>
    					<div class="block">
    						<div class="homebot_img_small_block_1 small_height_1 concert_block">
    							<div class="cap">
    								<a href="/slotsso-badet/oftest-stillede-spoergsmaal/" target=""><h4>Oftest stillede spørgsmål</h4></a>
    							</div>
    							<div class="que_icon">
    								<img src="/wp-content/uploads/2022/12/img_12.png" alt="">
    							</div>
    							<a href="/slotsso-badet/oftest-stillede-spoergsmaal/" target="" class="see_more_link">Se mere</a>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>

    		<div class="home_bot">
    			<div class="home_bot_right">
    				<div class="home_bot_right_inn">
    					<?php 
						foreach ($post_ids as $key => $post){
							if($key == 5 || $key == 6){
								$url = wp_get_attachment_url( get_post_thumbnail_id($post), 'thumbnail' );
								$post_url = get_post_permalink($post);
								if(!empty($url)){
								$url = wp_get_attachment_url( get_post_thumbnail_id($post), 'thumbnail' );
								}else{
									$url = '/wp-content/uploads/2023/05/backgroundimg.png';
								}
								?>
    					<div class="block">
    						<div class="homebot_img_small_block_1 small_height_1 " style="background-image:url('<?php echo $url; ?>');">
    							<div class="cap">
    								<a href="<?php echo $post_url ?>" target=""><h4><?php echo ucfirst(get_the_title($post)); ?></h4></a>
    							</div>
    							<a href="<?php echo $post_url ?>" target="" class="see_more_link white_arr">Se mere</a>
    						</div>
    					</div>
    				<?php }} ?>
    				</div>
    			</div>
    			<div class="home_bot_left">
    				<div class="gift_card_block small_height_1">
    					<div class="img">
    						<img src="/wp-content/uploads/2022/10/outdoorsauna1.png" alt="">
    					</div>
    					<div class="desc">
    						<div class="desc_inn">
    							<a href="/slotsso-badet/slotssobadet-outdoor/" target=""><h4>Prøv SlotssøBadet Outdoor</h4></a>
    							<p>Vi har åbnet en af de flottest beliggende udendørs pool samt Sauna BellaVista med udsigt til Koldinghus.</p>
    						</div>
    					</div>
    					<a href="/slotsso-badet/slotssobadet-outdoor/" target="" class="see_more_link">Book saunagus online</a>
    				</div>
    			</div>
    		</div>
			<?php } ?>
        </div>
    </div>
<?php }else{
	if($_GET['ids']){
		//include '/inner-category-page.php';
		include EVENTS_PATH . '/templates/inner-category-page.php';
	}else{
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

		//$categories = get_terms($args);
		///foreach ($categories as $key => $value){
			$subcategories = get_terms(array(
			    'taxonomy' => $taxonomy,
			    'hide_empty' => false,
			    'parent' => $term_id,
			));
			// foreach ($subcategories as $subkey => $subvalue){
			// 	echo "<pre>";print_r($subvalue);
			// }
		//}
	?>
	<div class="topbanner" style="background: url('<?php echo $image; ?>');">
	<div class="container">
		<div class="text-block">
			<h2><?php echo $term->name; ?></h2>
		</div>
	</div>
</div>
<div class="cat-single_page">
	<div class="back-btn">
		<a href="<?php echo site_url(); ?>"><svg xmlns="http://www.w3.org/2000/svg" width="20.56" height="20.039" viewBox="0 0 20.56 20.039"><path id="Icon_awesome-arrow-left" data-name="Icon awesome-arrow-left" d="M11.815,21.344,10.8,22.363a1.1,1.1,0,0,1-1.556,0L.32,13.447a1.1,1.1,0,0,1,0-1.556L9.241,2.971a1.1,1.1,0,0,1,1.556,0l1.019,1.019A1.1,1.1,0,0,1,11.8,5.563l-5.53,5.268H19.455a1.1,1.1,0,0,1,1.1,1.1V13.4a1.1,1.1,0,0,1-1.1,1.1H6.267L11.8,19.77A1.1,1.1,0,0,1,11.815,21.344Z" transform="translate(0.004 -2.647)" fill="#00a2c8"/></svg>back</a>
	</div>
	<div class="home-grid-section grid-space">
    <?php 
        $taxonomy = 'ccategory_taxonomy';
            $args = array(
			    'post_type' => 'event',
			    'post_status' => 'publish',
			    'posts_per_page' => -1,
			    'orderby'    => 'ID',
                'order'      => 'DESC',
			    'meta_query' => array(
			        array(
						'key' => 'option_category',
						'value' => $term_id,
						'compare' => '='
					),
			    ),
			);
           // echo "<pre>";print_r($args);
            $posts = get_posts($args);
            //if(!empty($posts)){
                foreach ($subcategories as $key => $value){
                	$url = wp_get_attachment_url( get_post_thumbnail_id($value->term_id), 'thumbnail' );
					$post_url = get_category_link($value->term_id);
					$post_content = get_field( 'short_description', $value->term_id );
					$images = get_term_meta( $value->term_id, 'custom_taxonomy_image', true );
                    if(!empty($images)){
			            $images = get_term_meta( $value->term_id, 'custom_taxonomy_image', true );
			         }else{
			              $images = '/wp-content/uploads/2023/06/DSCF129.png';  
			         }
			          //  echo $term_id;
    ?>
    <div class="home-grid-col">
        <div class="home-grid-col-content" data-category_id="<?php echo $value->term_id;?>">
            <img src="<?php echo $images; ?>">
            <div class="grid_overlay-content">
                <h2><?php echo $value->name;?></h2>
                <div class="see-more"><a href="<?php echo $post_url ?>?ids=<?php echo $value->term_id;?>" target="" class="">SE MERE</a></div>
            </div>
        </div>
    </div>
    <?php 
	}
//}
    ?>

</div>
</div>
<?php } ?>

<?php if( have_rows('header_top_menu','option') ){ ?>
    <div id="<?php if ( is_front_page() || is_singular( 'slotss_badet' ) || is_post_type_archive( 'kongeaabadet' ) || is_singular( 'kongeaabadet' )){ ?>top_menu_1<?php } ?><?php if ( is_post_type_archive('forum_kolding') || is_singular( 'forum_kolding' ) ){ ?>top_menu_2<?php } ?><?php if ( is_post_type_archive( 'dorotheas_badstue' ) || is_singular( 'dorotheas_badstue' ) ){ ?>top_menu_3<?php } ?><?php if ( is_post_type_archive( 'sct_jrgens_gaard' ) || is_singular( 'sct_jrgens_gaard' ) ){ ?>top_menu_4<?php } ?><?php if ( is_post_type_archive( 'danhostel' ) || is_singular( 'danhostel' ) ){ ?>top_menu_5<?php } ?>" class="top_menu home-top_menu">
        <div class="container">
            <a href="#" id="top_menubtn"><img src="https://ssbad.dk/wp-content/uploads/2022/03/clicking.png" alt="" width="32" height="32" size-full wp-image-2364 />VORES STEDER</a>
            <ul>
                <?php while( have_rows('header_top_menu','option') ) { the_row(); $link = get_sub_field('link'); $lurl = $link['url'] == 'https://ssbad.dk/' ? 'https://ssbad.dk/slotsso-badet/' : $link['url']; ?>
                    <li <?php if(!$arrd && explode('/', str_ireplace(array('https://', 'https://'), '', $lurl))[1] == $root){ echo 'class="current-menu-item"'; $arrd = true; } ?>><a href="<?php echo $link['url']; ?>" style="background-image:url(<?php the_sub_field('bg_image'); ?>);"><?php echo $link['title']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <?php } ?>
	
	<?php 
} get_footer(); ?>
