<?php 
get_header();
if($_GET['tab'] !=''){
?>
<div class="tabcontent-left-inner tabcontent-preview-page">
	<div class="images-grid">
		<?php 
		$args = array(
			'post_type' => 'event',
			'posts_per_page' => -1,
			'meta_query' => array(
				array(
					'key' => 'select_website',
					'value' => $_GET['tab'],
					'compare' => '='
				),
		        array(
		            'key' => 'ff_page',
		            'value' => 'yes',
		            'compare' => '='
		        )
			)
		);
		$posts = get_posts($args);
		foreach ($posts as $post){
			$tab_array[] = $post->ID;
		}
		global $wpdb;
		$table_name = $wpdb->prefix . 'frontpage_tab';
		$query = "SELECT * FROM $table_name WHERE get_tab_id = %s";
		$column1_value = 'tab-'.$_GET['tab'];
		$prepared_query = $wpdb->prepare($query, $column1_value);
		$results = $wpdb->get_row($prepared_query);
		if(!empty($results->post_ids)){
			$post_ids =json_decode($results->post_ids);
			foreach ($posts as $post){
				if (!in_array($post->ID, $post_ids)){
					$post_ids[] = $post->ID;
				}
			}
			$post_array = array();
			foreach ($post_ids as $key => $value) {
				if (in_array($value, $tab_array)){
					$post_array[] = $value;
				}
			}										
			$post_tab=json_decode($results->post_tab);

			?>
<div class="images-grid-inner">
	<div class="images-grid-item images-grid-item-left">
		<div class="image-one-col">
		<?php 
		foreach ($post_array as $key => $post){
			if($key == 0){
				$url = wp_get_attachment_url( get_post_thumbnail_id($post), 'thumbnail' );
				$post_url = get_post_permalink($post);
				?>
				<div class="img-col img-one">
					<?php 
					if(!empty($url)){
						?>
						<img src="<?php echo $url; ?>">
						<?php 
					}else{
						?>
						<img src="https://ssbad.dev.indicom.dk/wp-content/uploads/2022/06/povenik1.png">
						<?php 
					}
					?>
				<span><a href="<?php echo $post_url ?>"><?php echo ucfirst(get_the_title($post)); ?></a></span>
				</div>
			<?php } } ?>
		</div>
		<div class="image-three-col flex-col">
			<?php 
			foreach ($post_array as $key =>$post){
				if($key == 1 || $key == 2 || $key == 3){
					$url = wp_get_attachment_url( get_post_thumbnail_id($post), 'thumbnail' );
					$post_url = get_post_permalink($post);
					?>
					<div class="img-col">
						<?php 
						if(!empty($url)){
							?>
							<img src="<?php echo $url; ?>">
							<?php 
						}else{
							?>
							<img src="https://ssbad.dev.indicom.dk/wp-content/uploads/2022/06/povenik1.png">
							<?php 
						}
						?>
					<span><a href="<?php echo $post_url ?>"><?php echo ucfirst(get_the_title($post)); ?></a></span>
					</div>
				<?php } } ?>
			</div>
		</div>
	<div class="images-grid-item images-grid-right">
		<div class="image-two-col flex-col">
			<div class="img-col">
				<img src="https://ssbad.dev.indicom.dk/wp-content/uploads/2022/06/povenik1.png">
			</div>
			<div class="img-col">
				<img src="https://ssbad.dev.indicom.dk/wp-content/uploads/2022/06/povenik1.png">
			</div>
		</div>
		<div class="image-one-col">
			<?php 
			foreach ($post_array as $key => $post){
				if($key == 4){
					$url = wp_get_attachment_url( get_post_thumbnail_id($post), 'thumbnail' );
					$post_url = get_post_permalink($post);
					?>
					<div class="img-col img-one">
						<?php 
						if(!empty($url)){
							?>
							<img src="<?php echo $url; ?>">
							<?php 
						}else{
							?>
							<img src="https://ssbad.dev.indicom.dk/wp-content/uploads/2022/06/povenik1.png">
							<?php 
						}
						?>
					<span><a href="<?php echo $post_url ?>"><?php echo ucfirst(get_the_title($post)); ?></a></span>
					</div>
				<?php } } ?>
			</div>
		</div>
	</div>
	<div class="images-grid-inner">
		<div class="images-grid-item">
			<div class="image-one-col">
				<div class="img-col">
					<img src="https://ssbad.dev.indicom.dk/wp-content/uploads/2022/06/povenik1.png">
				</div>
			</div>
		</div>
	</div>
	<div class="images-grid-inner">
		<div class="images-grid-item">
			<div class="image-two-col flex-col">
				<div class="img-col">
					<img src="https://ssbad.dev.indicom.dk/wp-content/uploads/2022/06/povenik1.png">
				</div>
				<div class="img-col">
					<img src="https://ssbad.dev.indicom.dk/wp-content/uploads/2022/06/povenik1.png">
				</div>
			</div>
		</div>
	</div>
	<div class="images-grid-inner">
		<div class="images-grid-item images-grid-right">
			<div class="image-two-col flex-col">
				<?php 
				foreach ($posts as $key => $post){
					if($key == 5 || $key == 6){
						$url = wp_get_attachment_url( get_post_thumbnail_id($post), 'thumbnail' );
						$post_url = get_post_permalink($post);
						?>
						<div class="img-col">
							<?php 
							if(!empty($url)){ ?>
								<img src="<?php echo $url; ?>">
							<?php }else{
								?>
								<img src="https://ssbad.dev.indicom.dk/wp-content/uploads/2022/06/povenik1.png">
							<?php } ?>
						<span><a href="<?php echo $post_url ?>"><?php echo ucfirst(get_the_title($post)); ?></a></span>
						</div>
					<?php } } ?>
				</div>
			</div>
		<div class="images-grid-item images-grid-item-left">
			<div class="image-one-col">
				<div class="img-col">
					<img src="https://ssbad.dev.indicom.dk/wp-content/uploads/2022/06/povenik1.png">
				</div>
			</div>
		</div>	
	</div>
							<?php 
						}else{
							?>
	<div class="images-grid-inner">
		<div class="images-grid-item images-grid-item-left">
			<div class="image-one-col">
				<?php 
				foreach ($posts as $key => $post){
					if($key == 0){
						$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
						$post_url = get_post_permalink($post->ID);
						?>
						<div class="img-col img-one">
							<?php if(!empty($url)){
								?>
								<img src="<?php echo $url; ?>">
								<?php 
							}else{?>
								<img src="https://ssbad.dev.indicom.dk/wp-content/uploads/2022/06/povenik1.png">
							<?php }	?>
						<span><a href="<?php echo $post_url ?>"><?php echo ucfirst(get_the_title($post->ID)); ?></a></span>
						</div>
					<?php } } ?>
				</div>
				<div class="image-three-col flex-col">
					<?php 
					foreach ($posts as $key =>$post){
						if($key == 1 || $key == 2 || $key == 3){
							$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
							$post_url = get_post_permalink($post->ID);
							?>
							<div class="img-col">
								<?php if(!empty($url)){
									?>
									<img src="<?php echo $url; ?>">
									<?php 
								}else{?>
									<img src="https://ssbad.dev.indicom.dk/wp-content/uploads/2022/06/povenik1.png">
								<?php }	?>
							<span><a href="<?php echo $post_url ?>"><?php echo ucfirst(get_the_title($post->ID)); ?></a></span>
							</div>
						<?php } } ?>
					</div>
				</div>
			<div class="images-grid-item images-grid-right">
				<div class="image-two-col flex-col">
					<div class="img-col">
						<img src="https://ssbad.dev.indicom.dk/wp-content/uploads/2022/06/povenik1.png">
					</div>
					<div class="img-col">
						<img src="https://ssbad.dev.indicom.dk/wp-content/uploads/2022/06/povenik1.png">
					</div>
				</div>
				<div class="image-one-col">
					<?php 
					foreach ($posts as $key => $post){
						if($key == 4){
							$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
							$post_url = get_post_permalink($post->ID);
							?>
							<div class="img-col img-one">
								<?php if(!empty($url)){
									?>
									<img src="<?php echo $url; ?>">
									<?php 
								}else{?>
									<img src="https://ssbad.dev.indicom.dk/wp-content/uploads/2022/06/povenik1.png">
								<?php }	?>
							<span><a href="<?php echo $post_url ?>"><?php echo ucfirst(get_the_title($post->ID)); ?></a></span>
							</div>
						<?php } } ?>
					</div>
				</div>
			</div>
		<div class="images-grid-inner">
			<div class="images-grid-item">
				<div class="image-one-col">
					<div class="img-col">
						<img src="https://ssbad.dev.indicom.dk/wp-content/uploads/2022/06/povenik1.png">
					</div>
				</div>
			</div>
		</div>
		<div class="images-grid-inner">
			<div class="images-grid-item">
				<div class="image-two-col flex-col">
					<div class="img-col">
						<img src="https://ssbad.dev.indicom.dk/wp-content/uploads/2022/06/povenik1.png">
					</div>
					<div class="img-col">
						<img src="https://ssbad.dev.indicom.dk/wp-content/uploads/2022/06/povenik1.png">
					</div>
				</div>
			</div>
		</div>
		<div class="images-grid-inner">
			<div class="images-grid-item images-grid-right">
				<div class="image-two-col flex-col">
					<?php 
					foreach ($posts as $key => $post){
						if($key == 5 || $key == 6){
							$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
							$post_url = get_post_permalink($post->ID);
							?>
							<div class="img-col">
								<?php if(!empty($url)){
									?>
									<img src="<?php echo $url; ?>">
									<?php 
								}else{?>
									<img src="https://ssbad.dev.indicom.dk/wp-content/uploads/2022/06/povenik1.png">
								<?php }	?>
							<span><a href="<?php echo $post_url ?>"><?php echo ucfirst(get_the_title($post->ID)); ?></a></span>
							</div>
						<?php } } ?>
					</div>
				</div>
				<div class="images-grid-item images-grid-item-left">
					<div class="image-one-col">
						<div class="img-col">
							<img src="https://ssbad.dev.indicom.dk/wp-content/uploads/2022/06/povenik1.png">
						</div>
					</div>
				</div>	
			</div>
			<?php 
			}
			?>
	</div>
</div>
<?php 
}else{
 echo 'Please Add other tabs';
}
get_footer();
?>
