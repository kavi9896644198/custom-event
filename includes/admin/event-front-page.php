<div class="main-layout-section">
	<div class="wrapper-inner">
		<div class="top-heading">
			<h2>Frontpages</h2>
		</div>
		<div class="frontpage-tab">
			<div class="tab">
			  <button class="tablinks active" data-tab="tab-1">SSBAD</button>
			  <button class="tablinks" data-tab="tab-2">FORUM KOLDING</button>
			  <button class="tablinks" data-tab="tab-3">DOROTHEAS BADSTUE</button>
			  <button class="tablinks" data-tab="tab-4">SCT. JØRGENS GAARD</button>
			  <button class="tablinks" data-tab="tab-5">KONGEÅBADET</button>
			</div>
		<div class="frontpage-tab-inner">
			<div class="tab-content">
				<?php 
				for ($x=1; $x <= 5; $x++){
				if($x == '1'){
					$addclass = 'active';
				}else{
					$addclass = ' ';
				}
				?>
				<div id="tab-<?php echo $x; ?>" class="tabcontent <?php echo $addclass; ?>">
					<div class="tabcontent-inner">
						<div class="tabcontent-left">
							<div class="tabcontent-left-inner">
								<div class="images-grid">
									<?php 
								$args = array(
								  'post_type' => 'event',
								  'posts_per_page' => 7
								);
								$posts = get_posts($args);
								foreach ($posts as $post){
									$tab_array[] = $post->ID;
								}
								global $wpdb;
								$table_name = $wpdb->prefix . 'frontpage_tab';
								$query = "SELECT * FROM $table_name WHERE get_tab_id = %s LIMIT 7";
								$column1_value = 'tab-'.$x;
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
											$j=1;
											foreach ($post_array as $key => $post){
											if($key == 0){
												$url = wp_get_attachment_url( get_post_thumbnail_id($post), 'thumbnail' );
												?>
												<div class="img-col img-one">
													<img src="/wp-content/uploads/2023/06/front-image-<?php echo $j; ?>.png">
													<!-- <span><?php echo ucfirst(get_the_title($post)); ?></span> -->
												</div>
											<?php break;} $j++;} ?>
											</div>
											<div class="image-three-col flex-col">
											<?php 
												$j=1;
												foreach ($post_array as $key =>$post){
													if($key == 1 || $key == 2 || $key == 3){
													$url = wp_get_attachment_url( get_post_thumbnail_id($post), 'thumbnail' );
												?>
												<div class="img-col">
													<img src="/wp-content/uploads/2023/06/front-image-<?php echo $j; ?>.png">
													<!-- <span><?php echo ucfirst(get_the_title($post)); ?></span> -->
												</div>
											<?php } $j++;} ?>
											</div>
										</div>
										<div class="images-grid-item images-grid-right">
											<div class="image-two-col flex-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
											</div>
											<div class="image-one-col">
												<?php 
												$j=1;
												foreach ($post_array as $key => $post){
													if($key == 4){
													$url = wp_get_attachment_url( get_post_thumbnail_id($post), 'thumbnail' );
												?>
												<div class="img-col img-one">
													<img src="/wp-content/uploads/2023/06/front-image-<?php echo $j; ?>.png">
													<!-- <span><?php echo ucfirst(get_the_title($post)); ?></span> -->
												</div>
											<?php } $j++;} ?>
											</div>
										</div>
									</div>
									<div class="images-grid-inner">
										<div class="images-grid-item">
											<div class="image-one-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
											</div>
										</div>
									</div>
									<div class="images-grid-inner">
										<div class="images-grid-item">
											<div class="image-two-col flex-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
											</div>
										</div>
									</div>
									<div class="images-grid-inner">
										<div class="images-grid-item images-grid-right">
											<div class="image-two-col flex-col">
											<?php 
											$j=1;
											foreach ($post_array as $key => $post){
												if($key == 5 || $key == 6){
												$url = wp_get_attachment_url( get_post_thumbnail_id($post), 'thumbnail' );
											?>
											<div class="img-col">
												<img src="/wp-content/uploads/2023/06/front-image-<?php echo $j; ?>.png">											
												<!-- <span><?php echo ucfirst(get_the_title($post)); ?></span> -->
											</div>
											<?php } $j++;} ?>
											</div>
										</div>
										<div class="images-grid-item images-grid-item-left">
											<div class="image-one-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
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
												$j=1; 
												foreach ($posts as $key => $post){
													if($key == 0){
												$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
												?>
												<div class="img-col img-one">
												<img src="/wp-content/uploads/2023/06/front-image-<?php echo $j; ?>.png">
													<!-- <span><?php echo ucfirst(get_the_title($post->ID)); ?></span> -->
												</div>
											<?php } $j++;} ?>
											</div>
											<div class="image-three-col flex-col">
												<?php 
												$j = 1;
												foreach ($posts as $key =>$post){
													if($key == 1 || $key == 2 || $key == 3){
													$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
												?>
												<div class="img-col">
												<img src="/wp-content/uploads/2023/06/front-image-<?php echo $j; ?>.png">
													<!-- <span><?php echo ucfirst(get_the_title($post->ID)); ?></span> -->
												</div>
											<?php } $j++;} ?>
											</div>
										</div>
										<div class="images-grid-item images-grid-right">
											<div class="image-two-col flex-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
											</div>
											<div class="image-one-col">
												<?php 
												$j = 1;
												foreach ($posts as $key => $post){
													if($key == 4){
													$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
												?>
												<div class="img-col img-one">
												<img src="/wp-content/uploads/2023/06/front-image-<?php echo $j; ?>.png">
													<!-- <span><?php echo ucfirst(get_the_title($post->ID)); ?></span> -->
												</div>
											<?php } $j++;} ?>
											</div>
										</div>
									</div>
									<div class="images-grid-inner">
										<div class="images-grid-item">
											<div class="image-one-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
											</div>
										</div>
									</div>
									<div class="images-grid-inner">
										<div class="images-grid-item">
											<div class="image-two-col flex-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
											</div>
										</div>
									</div>
									<div class="images-grid-inner">
										<div class="images-grid-item images-grid-right">
											<div class="image-two-col flex-col">
												<?php 
												$j=1;
												foreach ($posts as $key => $post){
													if($key == 5 || $key == 6){
													$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
												?>
												<div class="img-col">
												<img src="/wp-content/uploads/2023/06/front-image-<?php echo $j; ?>.png">
													<!-- <span><?php echo ucfirst(get_the_title($post->ID)); ?></span> -->
												</div>
											<?php } $j++;} ?>
											</div>
										</div>
										<div class="images-grid-item images-grid-item-left">
											<div class="image-one-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
											</div>
										</div>	
									</div>
									<?php 
								}
									?>
								</div>
							</div>
						</div>
						<div class="tabcontent-right">
							<div class="tabcontent-right-row tabcontent_tab-<?php echo $x; ?>">
							<?php
							$args = array(
							  'post_type' => 'event',
							  'posts_per_page' => -1,
							  // 'meta_query' => array(
							  //       array(
							  //           'key' => 'select_website',
							  //           'value' => $x,
							  //           'compare' => '='
							  //       ),
							  //       array(
							  //           'key' => 'ff_page',
							  //           'value' => 'yes',
							  //           'compare' => '='
							  //       )
							  //   )
							);
							$tab_array = array();
							$posts = get_posts($args);
							foreach ($posts as $post){
								$tab_array[] = $post->ID;
							}
							global $wpdb;
							$table_name = $wpdb->prefix . 'frontpage_tab';
							$query = "SELECT * FROM $table_name WHERE get_tab_id = %s LIMIT 7";
							$column1_value = 'tab-'.$x;
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
								//echo '<pre>';print_r($post_array);die;										
								$post_tab=json_decode($results->post_tab);
								$j=1;
								for ($i=0; $i < count($post_array);$i++) {
									$url = wp_get_attachment_url( get_post_thumbnail_id($post_array[$i]), 'thumbnail' );
									?>
									<div data-id="<?php echo $j; ?>" data-post_id="<?php echo $post_array[$i]; ?>" data-post_title="<?php echo ucfirst(get_the_title($post_array[$i])); ?>" data-post_image="<?php echo $url; ?>" class="tabcontent-right-col">
										<div class="tabcontent-col_left">
											<span><?php echo $j; ?></span>
										</div>
										<div class="tabcontent-col_right">
											<div class="tabcontent-col_right_inner custom_flex_div">
												<p><?php echo ucfirst(get_the_title($post_array[$i])); ?></p>
												<div class="arrow-box arrow_box_button">
													<!-- <span class="arrow-left"></span> -->
													<?php 
													$args = array(
														  'post_type' => 'event',
														  'posts_per_page' => -1,
														  // 'meta_query' => array(
														  //       array(
														  //           'key' => 'select_website',
														  //           'value' => $x,
														  //           'compare' => '='
														  //       ),
														  //       array(
														  //           'key' => 'ff_page',
														  //           'value' => 'yes',
														  //           'compare' => '='
														  //       )
														  //   )
														);
													$post2 = get_posts($args);
													?>
													<select class="select_event_class">
													  <option value="" disabled>Select Event</option>
													  <?php 
													  	if(!empty($post2)){
													  		foreach ($post2 as $post){
													  ?>
													  <option value="<?php echo $post->ID; ?>" <?php if ($post_array[$i] == $post->ID) echo ' selected'; if(in_array($post->ID,json_decode($results->post_ids))){echo ' disabled-sddsd';} ?>><?php echo ucfirst($post->post_title); ?></option>
													  <?php 
														}
													  }
													  ?>
													</select>
												</div>
											</div>
										</div>
									</div>
									<?php 
									$j++;
									if($i ==6){
										break;
									}
								}
								}else{
								if(!empty($posts)){
									$i =1;
									foreach ($posts as $post){
										setup_postdata($post);
									$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
								?>
								<div data-id="<?php echo $i; ?>" data-post_id="<?php echo $post->ID; ?>" data-post_title="<?php echo ucfirst($post->post_title); ?>" data-post_image="<?php echo $url; ?>" class="tabcontent-right-col">
									<div class="tabcontent-col_left">
										<span><?php echo $i; ?></span>
									</div>
									<div class="tabcontent-col_right">
										<div class="tabcontent-col_right_inner">
											<p><?php echo ucfirst($post->post_title); ?></p>
											<div class="arrow-box">
												<?php 
												$args = array(
														  'post_type' => 'event',
														  'posts_per_page' => -1,
														  // 'meta_query' => array(
														  //       array(
														  //           'key' => 'select_website',
														  //           'value' => $x,
														  //           'compare' => '='
														  //       ),
														  //       array(
														  //           'key' => 'ff_page',
														  //           'value' => 'yes',
														  //           'compare' => '='
														  //       )
														  //   )
														);
													$post2 = get_posts($args);
												?>
												<select class="select_event_class">
												  <option value="" disabled>Select Event</option>
												  <?php 
													  	if(!empty($post2)){
													  		foreach ($post2 as $post){
													  ?>
													  <option value="<?php echo $post->ID; ?>" <?php if ($post_array[$i] == $post->ID) echo ' selected'; if(in_array($post->ID,json_decode($results->post_ids))){echo ' disabled-ssd';} ?>><?php echo ucfirst($post->post_title); ?></option>
													  <?php 
														}
													  }
													  ?>
												</select>
											</div>
										</div>
									</div>
								</div>
								<?php
								    $i++; 
									}
								}
							}
								?>
							</div>
						</div>
					</div>
					<div class="frontpage-button">
						<a href="<?php echo get_permalink('5082'); ?>?tab=<?php echo $x; ?>" target="_blank" class="preview-btn" data-button='preview'>Preview</a>
						<a href="javascript:void(0)" data-button='save' class="gem-btn saveButton">Gem</a>
					</div>
				</div>
				<?php 
			}
				?>
				<!-- <div id="tab-2" class="tabcontent">
					<div class="tabcontent-inner">
						<div class="tabcontent-left">
							<div class="tabcontent-left-inner">
								<div class="images-grid">
									<?php 
								$args = array(
								  'post_type' => 'event',
								  'posts_per_page' => -1,
								  'meta_query' => array(
								        array(
								            'key' => 'select_website',
								            'value' => 2,
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
								$column1_value = 'tab-2';
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
												?>
												<div class="img-col img-one">
												<?php if(!empty($url)){
													?>
												<img src="<?php echo $url; ?>">
													<?php 
												}else{?>
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												<?php }	?>
													<span><?php echo ucfirst(get_the_title($post)); ?></span>
												</div>
											<?php } } ?>
											</div>
											<div class="image-three-col flex-col">
												<?php 
												foreach ($post_array as $key =>$post){
													if($key == 1 || $key == 2 || $key == 3){
													$url = wp_get_attachment_url( get_post_thumbnail_id($post), 'thumbnail' );
												?>
												<div class="img-col">
													<?php if(!empty($url)){
													?>
												<img src="<?php echo $url; ?>">
													<?php 
												}else{?>
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												<?php }	?>
													<span><?php echo ucfirst(get_the_title($post)); ?></span>
												</div>
											<?php } } ?>
											</div>
										</div>
										<div class="images-grid-item images-grid-right">
											<div class="image-two-col flex-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
											</div>
											<div class="image-one-col">
												<?php 
												foreach ($post_array as $key => $post){
													if($key == 4){
													$url = wp_get_attachment_url( get_post_thumbnail_id($post), 'thumbnail' );
												?>
												<div class="img-col img-one">
													<?php if(!empty($url)){
													?>
												<img src="<?php echo $url; ?>">
													<?php 
												}else{?>
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												<?php }	?>
													<span><?php echo ucfirst(get_the_title($post)); ?></span>
												</div>
											<?php } } ?>
											</div>
										</div>
									</div>
									<div class="images-grid-inner">
										<div class="images-grid-item">
											<div class="image-one-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
											</div>
										</div>
									</div>
									<div class="images-grid-inner">
										<div class="images-grid-item">
											<div class="image-two-col flex-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
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
												?>
												<div class="img-col">
													<?php if(!empty($url)){
													?>
												<img src="<?php echo $url; ?>">
													<?php 
												}else{?>
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												<?php }	?>
													<span><?php echo ucfirst(get_the_title($post)); ?></span>
												</div>
											<?php } } ?>
											</div>
										</div>
										<div class="images-grid-item images-grid-item-left">
											<div class="image-one-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
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
												?>
												<div class="img-col img-one">
													<?php if(!empty($url)){
													?>
												<img src="<?php echo $url; ?>">
													<?php 
												}else{?>
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												<?php }	?>
													<span><?php echo ucfirst(get_the_title($post->ID)); ?></span>
												</div>
											<?php } } ?>
											</div>
											<div class="image-three-col flex-col">
												<?php 
												foreach ($posts as $key =>$post){
													if($key == 1 || $key == 2 || $key == 3){
													$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
												?>
												<div class="img-col">
													<?php if(!empty($url)){
													?>
												<img src="<?php echo $url; ?>">
													<?php 
												}else{?>
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												<?php }	?>
													<span><?php echo ucfirst(get_the_title($post->ID)); ?></span>
												</div>
											<?php } } ?>
											</div>
										</div>
										<div class="images-grid-item images-grid-right">
											<div class="image-two-col flex-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
											</div>
											<div class="image-one-col">
												<?php 
												foreach ($posts as $key => $post){
													if($key == 4){
													$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
												?>
												<div class="img-col img-one">
													<?php if(!empty($url)){
													?>
												<img src="<?php echo $url; ?>">
													<?php 
												}else{?>
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												<?php }	?>
													<span><?php echo ucfirst(get_the_title($post->ID)); ?></span>
												</div>
											<?php } } ?>
											</div>
										</div>
									</div>
									<div class="images-grid-inner">
										<div class="images-grid-item">
											<div class="image-one-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
											</div>
										</div>
									</div>
									<div class="images-grid-inner">
										<div class="images-grid-item">
											<div class="image-two-col flex-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
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
												?>
												<div class="img-col">
													<?php if(!empty($url)){
													?>
												<img src="<?php echo $url; ?>">
													<?php 
												}else{?>
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												<?php }	?>
													<span><?php echo ucfirst(get_the_title($post->ID)); ?></span>
												</div>
											<?php } } ?>
											</div>
										</div>
										<div class="images-grid-item images-grid-item-left">
											<div class="image-one-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
											</div>
										</div>	
									</div>
									<?php 
								}
									?>
								</div>
							</div>
						</div>
						<div class="tabcontent-right">
							<div class="tabcontent-right-row tabcontent_tab-2">
								<?php 
								$args = array(
								  'post_type' => 'event',
								  'posts_per_page' => -1,
								  'meta_query' => array(
								        array(
								            'key' => 'select_website',
								            'value' => 2,
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
								$tab_array = array();
								$posts = get_posts($args);
								foreach ($posts as $post){
									$tab_array[] = $post->ID;
								}

								
								global $wpdb;
								$table_name = $wpdb->prefix . 'frontpage_tab';
								$query = "SELECT * FROM $table_name WHERE get_tab_id = %s";
								$column1_value = 'tab-2';
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
									$j=1;
									for ($i=0; $i < count($post_array); $i++) {
										$url = wp_get_attachment_url( get_post_thumbnail_id($post_array[$i]), 'thumbnail' );
										?>
										<div data-id="<?php echo $j; ?>" data-post_id="<?php echo $post_array[$i]; ?>" data-post_title="<?php echo ucfirst(get_the_title($post_array[$i])); ?>" data-post_image="<?php echo $url; ?>" class="tabcontent-right-col">
											<div class="tabcontent-col_left">
												<span><?php echo $j; ?></span>
											</div>
											<div class="tabcontent-col_right">
												<div class="tabcontent-col_right_inner">
													<p><?php echo ucfirst(get_the_title($post_array[$i])); ?></p>
													<div class="arrow-box">
														<span class="arrow-left"></span>
													</div>
												</div>
											</div>
										</div>
										<?php 
										$j++;
									}
								}else{
								
								if(!empty($posts)){
									$i =1;
									foreach ($posts as $post){
										setup_postdata($post);
										$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
								?>
								<div data-id="<?php echo $i; ?>" data-post_id="<?php echo $post->ID; ?>" data-post_title="<?php echo ucfirst(get_the_title($post->ID)); ?>" data-post_image="<?php echo $url; ?>" class="tabcontent-right-col">
									<div class="tabcontent-col_left">
										<span><?php echo $i; ?></span>
									</div>
									<div class="tabcontent-col_right">
										<div class="tabcontent-col_right_inner">
											<p><?php echo ucfirst($post->post_title); ?></p>
											<div class="arrow-box">
												<span class="arrow-left"></span>
											</div>
										</div>
									</div>
								</div>
								<?php
								    $i++; 
									}
								}
							}
								?>
							</div>
						</div>
					</div>
					<div class="frontpage-button">
						<a href="<?php echo get_permalink('5082'); ?>?tab=2" class="preview-btn" target="_blank">Preview</a>
						<a href="javascript:void(0)" class="gem-btn saveButton">Gem</a>
					</div>
				</div>
				<div id="tab-3" class="tabcontent">
					<div class="tabcontent-inner">
						<div class="tabcontent-left">
							<div class="tabcontent-left-inner">
								<div class="images-grid">
									<?php 
								$args = array(
								  'post_type' => 'event',
								  'posts_per_page' => -1,
								  'meta_query' => array(
								        array(
								            'key' => 'select_website',
								            'value' => 3,
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
								$column1_value = 'tab-3';
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
												?>
												<div class="img-col img-one">
													<?php if(!empty($url)){
													?>
												<img src="<?php echo $url; ?>">
													<?php 
												}else{?>
												<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												<?php }	?>
													<span><?php echo ucfirst(get_the_title($post)); ?></span>
												</div>
											<?php } } ?>
											</div>
											<div class="image-three-col flex-col">
												<?php 
												foreach ($post_array as $key =>$post){
													if($key == 1 || $key == 2 || $key == 3){
													$url = wp_get_attachment_url( get_post_thumbnail_id($post), 'thumbnail' );
												?>
												<div class="img-col">
													<?php if(!empty($url)){
													?>
												<img src="<?php echo $url; ?>">
													<?php 
												}else{?>
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												<?php }	?>
													<span><?php echo ucfirst(get_the_title($post)); ?></span>
												</div>
											<?php } } ?>
											</div>
										</div>
										<div class="images-grid-item images-grid-right">
											<div class="image-two-col flex-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
											</div>
											<div class="image-one-col">
												<?php 
												foreach ($post_array as $key => $post){
													if($key == 4){
													$url = wp_get_attachment_url( get_post_thumbnail_id($post), 'thumbnail' );
												?>
												<div class="img-col img-one">
													<?php if(!empty($url)){
													?>
												<img src="<?php echo $url; ?>">
													<?php 
												}else{?>
												<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												<?php }	?>
													<span><?php echo ucfirst(get_the_title($post)); ?></span>
												</div>
											<?php } } ?>
											</div>
										</div>
									</div>
									<div class="images-grid-inner">
										<div class="images-grid-item">
											<div class="image-one-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
											</div>
										</div>
									</div>
									<div class="images-grid-inner">
										<div class="images-grid-item">
											<div class="image-two-col flex-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
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
												?>
												<div class="img-col">
													<?php if(!empty($url)){
													?>
												<img src="<?php echo $url; ?>">
													<?php 
												}else{?>
												<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												<?php }	?>
													<span><?php echo ucfirst(get_the_title($post)); ?></span>
												</div>
											<?php } } ?>
											</div>
										</div>
										<div class="images-grid-item images-grid-item-left">
											<div class="image-one-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
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
												?>
												<div class="img-col img-one">
													<?php if(!empty($url)){
													?>
												<img src="<?php echo $url; ?>">
													<?php 
												}else{?>
												<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												<?php }	?>
													<span><?php echo ucfirst(get_the_title($post->ID)); ?></span>
												</div>
											<?php } } ?>
											</div>
											<div class="image-three-col flex-col">
												<?php 
												foreach ($posts as $key =>$post){
													if($key == 1 || $key == 2 || $key == 3){
													$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
												?>
												<div class="img-col">
													<img src="<?php echo $url; ?>">
													<span><?php echo ucfirst(get_the_title($post->ID)); ?></span>
												</div>
											<?php } } ?>
											</div>
										</div>
										<div class="images-grid-item images-grid-right">
											<div class="image-two-col flex-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
											</div>
											<div class="image-one-col">
												<?php 
												foreach ($posts as $key => $post){
													if($key == 4){
													$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
												?>
												<div class="img-col img-one">
													<?php if(!empty($url)){
													?>
												<img src="<?php echo $url; ?>">
													<?php 
												}else{?>
												<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												<?php }	?>
													<span><?php echo ucfirst(get_the_title($post->ID)); ?></span>
												</div>
											<?php } } ?>
											</div>
										</div>
									</div>
									<div class="images-grid-inner">
										<div class="images-grid-item">
											<div class="image-one-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
											</div>
										</div>
									</div>
									<div class="images-grid-inner">
										<div class="images-grid-item">
											<div class="image-two-col flex-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
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
												?>
												<div class="img-col">
													<?php if(!empty($url)){
													?>
												<img src="<?php echo $url; ?>">
													<?php 
												}else{?>
												<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												<?php }	?>
													<span><?php echo ucfirst(get_the_title($post->ID)); ?></span>
												</div>
											<?php } } ?>
											</div>
										</div>
										<div class="images-grid-item images-grid-item-left">
											<div class="image-one-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
											</div>
										</div>	
									</div>
									<?php 
								}
									?>
								</div>
							</div>
						</div>
						<div class="tabcontent-right">
							<div class="tabcontent-right-row tabcontent_tab-3">
								<?php 
								$args = array(
								  'post_type' => 'event',
								  'posts_per_page' => -1,
								  'meta_query' => array(
								        array(
								            'key' => 'select_website',
								            'value' => 3,
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
								$tab_array = array();
								$posts = get_posts($args);
								foreach ($posts as $post){
									$tab_array[] = $post->ID;
								}
								global $wpdb;
								$table_name = $wpdb->prefix . 'frontpage_tab';
								$query = "SELECT * FROM $table_name WHERE get_tab_id = %s";
								$column1_value = 'tab-3';
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
									$j=1;
									for ($i=0; $i < count($post_array); $i++) {
										$url = wp_get_attachment_url( get_post_thumbnail_id($post_array[$i]), 'thumbnail' );
										?>
										<div data-id="<?php echo $j; ?>" data-post_id="<?php echo $post_array[$i]; ?>" data-post_title="<?php echo ucfirst(get_the_title($post_array[$i])); ?>" data-post_image="<?php echo $url; ?>" class="tabcontent-right-col">
											<div class="tabcontent-col_left">
												<span><?php echo $j; ?></span>
											</div>
											<div class="tabcontent-col_right">
												<div class="tabcontent-col_right_inner">
													<p><?php echo ucfirst(get_the_title($post_array[$i])); ?></p>
													<div class="arrow-box">
														<span class="arrow-left"></span>
													</div>
												</div>
											</div>
										</div>
										<?php 
										$j++;
									}
								}else{
								
								if(!empty($posts)){
									$i =1;
									foreach ($posts as $post){
										setup_postdata($post);
										$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
								?>
								<div data-id="<?php echo $i; ?>" data-post_id="<?php echo $post->ID; ?>" data-post_title="<?php echo ucfirst(get_the_title($post->ID)); ?>" data-post_image="<?php echo $url; ?>" class="tabcontent-right-col">
									<div class="tabcontent-col_left">
										<span><?php echo $i; ?></span>
									</div>
									<div class="tabcontent-col_right">
										<div class="tabcontent-col_right_inner">
											<p><?php echo ucfirst($post->post_title); ?></p>
											<div class="arrow-box">
												<span class="arrow-left"></span>
											</div>
										</div>
									</div>
								</div>
								<?php
								    $i++; 
									}
								}
							}
						?>
							</div>
						</div>
					</div>
					<div class="frontpage-button">
						<a href="<?php echo get_permalink('5082'); ?>?tab=3" class="preview-btn" target="_blank">Preview</a>
						<a href="javascript:void(0)" class="gem-btn saveButton">Gem</a>
					</div>
				</div>
				<div id="tab-4" class="tabcontent">
					<div class="tabcontent-inner">
						<div class="tabcontent-left">
							<div class="tabcontent-left-inner">
								<div class="images-grid">
									<?php 
								$args = array(
								  'post_type' => 'event',
								  'posts_per_page' => -1,
								  'meta_query' => array(
								        array(
								            'key' => 'select_website',
								            'value' => 4,
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
								$column1_value = 'tab-4';
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
												?>
												<div class="img-col img-one">
													<?php if(!empty($url)){
													?>
												<img src="<?php echo $url; ?>">
													<?php 
												}else{?>
												<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												<?php }	?>
													<span><?php echo ucfirst(get_the_title($post)); ?></span>
												</div>
											<?php } } ?>
											</div>
											<div class="image-three-col flex-col">
												<?php 
												foreach ($post_array as $key =>$post){
													if($key == 1 || $key == 2 || $key == 3){
													$url = wp_get_attachment_url( get_post_thumbnail_id($post), 'thumbnail' );
												?>
												<div class="img-col">
													<?php if(!empty($url)){
													?>
												<img src="<?php echo $url; ?>">
													<?php 
												}else{?>
												<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												<?php }	?>
													<span><?php echo ucfirst(get_the_title($post)); ?></span>
												</div>
											<?php } } ?>
											</div>
										</div>
										<div class="images-grid-item images-grid-right">
											<div class="image-two-col flex-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
											</div>
											<div class="image-one-col">
												<?php 
												foreach ($post_array as $key => $post){
													if($key == 4){
													$url = wp_get_attachment_url( get_post_thumbnail_id($post), 'thumbnail' );
												?>
												<div class="img-col img-one">
													<?php if(!empty($url)){
													?>
												<img src="<?php echo $url; ?>">
													<?php 
												}else{?>
												<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												<?php }	?>
													<span><?php echo ucfirst(get_the_title($post)); ?></span>
												</div>
											<?php } } ?>
											</div>
										</div>
									</div>
									<div class="images-grid-inner">
										<div class="images-grid-item">
											<div class="image-one-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
											</div>
										</div>
									</div>
									<div class="images-grid-inner">
										<div class="images-grid-item">
											<div class="image-two-col flex-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
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
												?>
												<div class="img-col">
													<?php if(!empty($url)){
													?>
												<img src="<?php echo $url; ?>">
													<?php 
												}else{?>
												<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												<?php }	?>
													<span><?php echo ucfirst(get_the_title($post)); ?></span>
												</div>
											<?php } } ?>
											</div>
										</div>
										<div class="images-grid-item images-grid-item-left">
											<div class="image-one-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
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
												?>
												<div class="img-col img-one">
													<?php if(!empty($url)){
													?>
												<img src="<?php echo $url; ?>">
													<?php 
												}else{?>
												<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												<?php }	?>
													<span><?php echo ucfirst(get_the_title($post->ID)); ?></span>
												</div>
											<?php } } ?>
											</div>
											<div class="image-three-col flex-col">
												<?php 
												foreach ($posts as $key =>$post){
													if($key == 1 || $key == 2 || $key == 3){
													$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
												?>
												<div class="img-col">
													<?php if(!empty($url)){
													?>
												<img src="<?php echo $url; ?>">
													<?php 
												}else{?>
												<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												<?php }	?>
													<span><?php echo ucfirst(get_the_title($post->ID)); ?></span>
												</div>
											<?php } } ?>
											</div>
										</div>
										<div class="images-grid-item images-grid-right">
											<div class="image-two-col flex-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
											</div>
											<div class="image-one-col">
												<?php 
												foreach ($posts as $key => $post){
													if($key == 4){
													$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
												?>
												<div class="img-col img-one">
													<?php if(!empty($url)){
													?>
												<img src="<?php echo $url; ?>">
													<?php 
												}else{?>
												<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												<?php }	?>
													<span><?php echo ucfirst(get_the_title($post->ID)); ?></span>
												</div>
											<?php } } ?>
											</div>
										</div>
									</div>
									<div class="images-grid-inner">
										<div class="images-grid-item">
											<div class="image-one-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
											</div>
										</div>
									</div>
									<div class="images-grid-inner">
										<div class="images-grid-item">
											<div class="image-two-col flex-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
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
												?>
												<div class="img-col">
													<?php if(!empty($url)){
													?>
												<img src="<?php echo $url; ?>">
													<?php 
												}else{?>
												<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												<?php }	?>
													<span><?php echo ucfirst(get_the_title($post->ID)); ?></span>
												</div>
											<?php } } ?>
											</div>
										</div>
										<div class="images-grid-item images-grid-item-left">
											<div class="image-one-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
											</div>
										</div>	
									</div>
									<?php 
								}
									?>
								</div>
							</div>
						</div>
						<div class="tabcontent-right">
							<div class="tabcontent-right-row tabcontent_tab-4">
								<?php 
								$args = array(
								  'post_type' => 'event',
								  'posts_per_page' => -1,
								  'meta_query' => array(
								        array(
								            'key' => 'select_website',
								            'value' => 4,
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
								$tab_array = array();
								$posts = get_posts($args);
								foreach ($posts as $post){
									$tab_array[] = $post->ID;
								}

								global $wpdb;
								$table_name = $wpdb->prefix . 'frontpage_tab';
								$query = "SELECT * FROM $table_name WHERE get_tab_id = %s";
								$column1_value = 'tab-4';
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
									$j=1;
									for ($i=0; $i < count($post_array); $i++){
										$url = wp_get_attachment_url( get_post_thumbnail_id($post_array[$i]), 'thumbnail' );
										?>
										<div data-id="<?php echo $j; ?>" data-post_id="<?php echo $post_array[$i]; ?>" data-post_title="<?php echo ucfirst(get_the_title($post_array[$i])); ?>" data-post_image="<?php echo $url; ?>" class="tabcontent-right-col">
											<div class="tabcontent-col_left">
												<span><?php echo $j; ?></span>
											</div>
											<div class="tabcontent-col_right">
												<div class="tabcontent-col_right_inner">
													<p><?php echo ucfirst(get_the_title($post_array[$i])); ?></p>
													<div class="arrow-box">
														<span class="arrow-left"></span>
													</div>
												</div>
											</div>
										</div>
										<?php 
										$j++;
									}
								}else{
								
								if(!empty($posts)){
									$i =1;
									foreach ($posts as $post){
										setup_postdata($post);
										$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
								?>
								<div data-id="<?php echo $i; ?>" data-post_id="<?php echo $post->ID; ?>" data-post_title="<?php echo ucfirst(get_the_title($post->ID)); ?>" data-post_image="<?php echo $url; ?>" class="tabcontent-right-col">
									<div class="tabcontent-col_left">
										<span><?php echo $i; ?></span>
									</div>
									<div class="tabcontent-col_right">
										<div class="tabcontent-col_right_inner">
											<p><?php echo ucfirst($post->post_title); ?></p>
											<div class="arrow-box">
												<span class="arrow-left"></span>
											</div>
										</div>
									</div>
								</div>
								<?php
								    $i++; 
									}
								}
							}
						?>
							</div>
						</div>
					</div>
					<div class="frontpage-button">
						<a href="<?php echo get_permalink('5082'); ?>?tab=4" class="preview-btn" target="_blank">Preview</a>
						<a href="javascript:void(0)" class="gem-btn saveButton">Gem</a>
					</div>
				</div>
				<div id="tab-5" class="tabcontent">
					<div class="tabcontent-inner">
						<div class="tabcontent-left">
							<div class="tabcontent-left-inner">
								<div class="images-grid">
									<?php 
								$args = array(
								  'post_type' => 'event',
								  'posts_per_page' => -1,
								  'meta_query' => array(
								        array(
								            'key' => 'select_website',
								            'value' => 5,
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
								$column1_value = 'tab-5';
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
												?>
												<div class="img-col img-one">
													<?php if(!empty($url)){
													?>
												<img src="<?php echo $url; ?>">
													<?php 
												}else{?>
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												<?php }	?>
													<span><?php echo ucfirst(get_the_title($post)); ?></span>
												</div>
											<?php } } ?>
											</div>
											<div class="image-three-col flex-col">
												<?php 
												foreach ($post_array as $key =>$post){
													if($key == 1 || $key == 2 || $key == 3){
													$url = wp_get_attachment_url( get_post_thumbnail_id($post), 'thumbnail' );
												?>
												<div class="img-col">
													<?php if(!empty($url)){
													?>
												<img src="<?php echo $url; ?>">
													<?php 
												}else{?>
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												<?php }	?>
													<span><?php echo ucfirst(get_the_title($post)); ?></span>
												</div>
											<?php } } ?>
											</div>
										</div>
										<div class="images-grid-item images-grid-right">
											<div class="image-two-col flex-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
												<div class="img-col">
												<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
											</div>
											<div class="image-one-col">
												<?php 
												foreach ($post_array as $key => $post){
													if($key == 4){
													$url = wp_get_attachment_url( get_post_thumbnail_id($post), 'thumbnail' );
												?>
												<div class="img-col img-one">
													<?php if(!empty($url)){
													?>
												<img src="<?php echo $url; ?>">
													<?php 
												}else{?>
												<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												<?php }	?>
													<span><?php echo ucfirst(get_the_title($post)); ?></span>
												</div>
											<?php } } ?>
											</div>
										</div>
									</div>
									<div class="images-grid-inner">
										<div class="images-grid-item">
											<div class="image-one-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
											</div>
										</div>
									</div>
									<div class="images-grid-inner">
										<div class="images-grid-item">
											<div class="image-two-col flex-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
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
												?>
												<div class="img-col">
													<?php if(!empty($url)){
													?>
												<img src="<?php echo $url; ?>">
													<?php 
												}else{?>
												<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												<?php }	?>
													<span><?php echo ucfirst(get_the_title($post)); ?></span>
												</div>
											<?php } } ?>
											</div>
										</div>
										<div class="images-grid-item images-grid-item-left">
											<div class="image-one-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
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
												?>
												<div class="img-col img-one">
													<?php if(!empty($url)){
													?>
												<img src="<?php echo $url; ?>">
													<?php 
												}else{?>
												<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												<?php }	?>
													<span><?php echo ucfirst(get_the_title($post->ID)); ?></span>
												</div>
											<?php } } ?>
											</div>
											<div class="image-three-col flex-col">
												<?php 
												foreach ($posts as $key =>$post){
													if($key == 1 || $key == 2 || $key == 3){
													$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
												?>
												<div class="img-col">
													<?php if(!empty($url)){
													?>
												<img src="<?php echo $url; ?>">
													<?php 
												}else{?>
												<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												<?php }	?>
													<span><?php echo ucfirst(get_the_title($post->ID)); ?></span>
												</div>
											<?php } } ?>
											</div>
										</div>
										<div class="images-grid-item images-grid-right">
											<div class="image-two-col flex-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
											</div>
											<div class="image-one-col">
												<?php 
												foreach ($posts as $key => $post){
													if($key == 4){
													$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
												?>
												<div class="img-col img-one">
												<?php if(!empty($url)){
													?>
												<img src="<?php echo $url; ?>">
													<?php 
												}else{?>
												<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												<?php }	?>
													<span><?php echo ucfirst(get_the_title($post->ID)); ?></span>
												</div>
											<?php } } ?>
											</div>
										</div>
									</div>
									<div class="images-grid-inner">
										<div class="images-grid-item">
											<div class="image-one-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
											</div>
										</div>
									</div>
									<div class="images-grid-inner">
										<div class="images-grid-item">
											<div class="image-two-col flex-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
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
												?>
												<div class="img-col">
													<?php if(!empty($url)){
													?>
												<img src="<?php echo $url; ?>">
													<?php 
												}else{?>
												<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												<?php }	?>
													<span><?php echo ucfirst(get_the_title($post->ID)); ?></span>
												</div>
											<?php }else{?>
												<div class="img-col">
												<img src="/wp-content/uploads/2023/05/backgroundimg.png">
													<span><?php echo ucfirst(get_the_title($post->ID)); ?></span>
												</div>
											<?php } } ?>
											</div>
										</div>
										<div class="images-grid-item images-grid-item-left">
											<div class="image-one-col">
												<div class="img-col">
													<img src="/wp-content/uploads/2023/05/backgroundimg.png">
												</div>
											</div>
										</div>	
									</div>
									<?php 
								}
									?>
								</div>
							</div>
						</div>
						<div class="tabcontent-right">
							<div class="tabcontent-right-row tabcontent_tab-5">
								<?php 
								$args = array(
								  'post_type' => 'event',
								  'posts_per_page' => -1,
								  'meta_query' => array(
								        array(
								            'key' => 'select_website',
								            'value' => 5,
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
								$tab_array = array();
								$posts = get_posts($args);
								foreach ($posts as $post){
									$tab_array[] = $post->ID;
								}

								global $wpdb;
								$table_name = $wpdb->prefix . 'frontpage_tab';
								$query = "SELECT * FROM $table_name WHERE get_tab_id = %s";
								$column1_value = 'tab-5';
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
									$j=1;
									for ($i=0; $i < count($post_array); $i++){
										$url = wp_get_attachment_url( get_post_thumbnail_id($post_array[$i]), 'thumbnail' );
										?>
										<div data-id="<?php echo $j; ?>" data-post_id="<?php echo $post_array[$i]; ?>" data-post_title="<?php echo ucfirst(get_the_title($post_array[$i])); ?>" data-post_image="<?php echo $url; ?>" class="tabcontent-right-col">
											<div class="tabcontent-col_left">
												<span><?php echo $j; ?></span>
											</div>
											<div class="tabcontent-col_right">
												<div class="tabcontent-col_right_inner">
													<p><?php echo ucfirst(get_the_title($post_array[$i])); ?></p>
													<div class="arrow-box">
														<span class="arrow-left"></span>
													</div>
												</div>
											</div>
										</div>
										<?php 
										$j++;
									}
								}else{
								
								if(!empty($posts)){
									$i =1;
									foreach ($posts as $post){
										setup_postdata($post);
										$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
								?>
								<div data-id="<?php echo $i; ?>" data-post_id="<?php echo $post->ID; ?>" data-post_title="<?php echo ucfirst(get_the_title($post->ID)); ?>" data-post_image="<?php echo $url; ?>" class="tabcontent-right-col">
									<div class="tabcontent-col_left">
										<span><?php echo $i; ?></span>
									</div>
									<div class="tabcontent-col_right">
										<div class="tabcontent-col_right_inner">
											<p><?php echo ucfirst($post->post_title); ?></p>
											<div class="arrow-box">
												<span class="arrow-left"></span>
											</div>
										</div>
									</div>
								</div>
								<?php
								    $i++; 
									}
								}
							}
						?>
							</div>
						</div>
					</div>
					<div class="frontpage-button">
						<a href="<?php echo get_permalink('5082'); ?>?tab=5" class="preview-btn" target="_blank">Preview</a>
						<a href="javascript:void(0)" class="gem-btn saveButton">Gem</a>
					</div>
				</div> -->
			</div>
		</div>
	</div>
</div>
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script>
		$(document).ready(function(){
			
	    	 $('.select_event_class').on('change', function() {
      			var selectedEvent = $(this).val();
      			var selectedText = $(this).find('option:selected').text();
      			$(this).parent().siblings("p").text(selectedText);
      			$(this).parent().parent().parent().parent().attr('data-post_id',selectedEvent);
    		});
		$('div.tab .tablinks').click(function(){
			var tab_id = $(this).attr('data-tab');
			$('div.tab .tablinks').removeClass('active');
			$('.tabcontent').removeClass('active');
			$(this).addClass('active');
			$("#"+tab_id).addClass('active');
		});
		var get_tab_id= $('.tabcontent.active').attr('id');
		$( ".tabcontent-right-row" ).sortable({
			   update: function(event, ui) {
			  var post_image =[]; 
			  x=1;
		      var sortedDataIDs = $(this).find(".tabcontent-right-col").map(function(index, element){
		      	$(this).find('.tabcontent-col_left').html('<span>'+x+'</span>');
		      	post_image.push($(this).data("post_image"));
		      	x++;
		        return $(this).data("post_title");
		      }).get();
		      console.log(sortedDataIDs);
		   var html = '';
		   var value1 = '';
		   var value2 = '';
		   var value3 = '';
		   var value4 = '';
		     img_count = 1;
			$.each(sortedDataIDs, function(key, value){
			  if (key === 0) {
			  	value1 +='<div class="img-col img-one"><img src="/wp-content/uploads/2023/06/front-image-'+img_count+'.png"></div>';
			  }
			  if (key === 1 || key === 2 || key === 3){
			  	value2 +='<div class="img-col"><img src="/wp-content/uploads/2023/06/front-image-'+img_count+'.png"></div>';
			  }
			  if (key === 4) {
			  	value3 +='<div class="img-col img-one"><img src="/wp-content/uploads/2023/06/front-image-'+img_count+'.png"></div>';
			  }
			  if (key === 5 || key === 6) {
			  	value4 +='<div class="img-col"><img src="/wp-content/uploads/2023/06/front-image-'+img_count+'.png"></div>';
			  }
			  img_count++;
			});
			html +='<div class="images-grid-inner">';
		    html +='<div class="images-grid-item images-grid-item-left">';
		    html +='<div class="image-one-col">';
		    html +=value1;
		    html +='</div>';
		    html +='<div class="image-three-col flex-col">';
		    html +=value2;
		    html +='</div>';
			html +='</div>';
			html +='<div class="images-grid-item images-grid-right">';
			html +='<div class="image-two-col flex-col"><div class="img-col"><img src="/wp-content/uploads/2023/05/backgroundimg.png"></div><div class="img-col"><img src="/wp-content/uploads/2023/05/backgroundimg.png"></div></div>';
			html +='<div class="image-one-col">';
			html +=value3;
			html +='</div>';
			html +='</div>';
			html +='</div>';
			html +='<div class="images-grid-inner"><div class="images-grid-item"><div class="image-one-col"><div class="img-col"><img src="/wp-content/uploads/2023/05/backgroundimg.png"></div></div></div></div>';
			html +='<div class="images-grid-inner"><div class="images-grid-item"><div class="image-two-col flex-col"><div class="img-col"><img src="/wp-content/uploads/2023/05/backgroundimg.png"></div><div class="img-col"><img src="/wp-content/uploads/2023/05/backgroundimg.png"></div></div></div></div>';
			html +='<div class="images-grid-inner">';
			html +='<div class="images-grid-item images-grid-right"><div class="image-two-col flex-col">';
			html +=value4;
			html +='</div></div>';
			html +='<div class="images-grid-item images-grid-item-left"><div class="image-one-col"><div class="img-col"><img src="/wp-content/uploads/2023/05/backgroundimg.png"></div></div></div>';
			html +='</div>';
			$('.tabcontent.active .images-grid').html(html);

		    }
		});
			$(".saveButton,.preview-btn").click(function(){
				var button = $(this).data('button');
				var sortedData = [];
				var post_id_data = [];
				var get_tab_id= $('.tabcontent.active').attr('id');
				$(".tabcontent_"+get_tab_id+" .tabcontent-right-col").each(function(){
					var id = $(this).data("id");
					var post_id = $(this).data("post_id");
					if(id != undefined){
							sortedData.push($(this).data("id"));
							var postId = $(this).data("post_id");
							if(postId !=''){
								post_id_data.push($(this).data("post_id"));
							}
						    
						}
				});
				console.log(post_id_data);
			    $.ajax({
			    	method: "POST",
			    	dataType: "json",
			        url:'/wp-admin/admin-ajax.php', // Replace with the server-side script URL
			      	data: {
			      		action: 'SSBAD_right_tab_function',
			      		get_tab_id:get_tab_id,
			      		post_id_data:post_id_data,
			      	    sortedData: sortedData },
			      success: function(response) {
			      	if(button == 'save'){
			      	if(response.status == 'update'){
			      		swal({
						  title: "Success!",
						  text: "Successfully Update!",
						  icon: "success",
						  button: "Ok!",
						}).then((reloadpage) =>{
			      			setTimeout(function() { 
						        location.reload();
						    }, 1000);
			      		});
						
			      	}
			      	if(response.status == 'insert'){
			      		swal({
						  title: "Success!",
						  text: "Successfully Insert!",
						  icon: "success",
						  button: "Ok!",
						});
			      	}
			      }
			    },
			    error: function(xhr, status, error) {
			    	console.error("Error saving data: " + error);
			        // Handle any error scenarios or display error message
			    }
			});
		 });
	});
	</script>