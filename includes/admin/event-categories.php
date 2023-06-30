<?php
$categories = get_EventCategories();


?>
<div class="main-layout-section">
		<div class="wrapper-inner">
			
			<div class="top-heading">
				<h2>Categories</h2>
			</div>
			<div class="Categories-row">
				<div class="cat-block">
					<form method="post" action="">
					<div class="cat-block-box active">
						<div class="event-manager-heading">
							<h3>Hovedkategorier</h3>
							<span class="arrow-down"></span>
						</div>
						<div class="cat-row-content">
							<div class="cat-row-list">
							<?php
							$num = 1;
							$taxonomy = 'ccategory_taxonomy';
							$args = array(
							    'taxonomy'   => $taxonomy,
							    'hide_empty' => false,
							    'parent' => 0,
							);

							$categories = get_terms($args);
							foreach ($categories as $key => $value){
								$subcategories = get_terms(array(
								    'taxonomy' => $taxonomy,
								    'hide_empty' => false,
								    'parent' => $value->term_id,
								));
								$activeClass = ($key == 0) ? 'active' : '';
								?>
								<div class="cat-list-col show_cat <?php echo $activeClass;?>" id="<?php echo $value->term_id;?>">
									<div class="cat-list-col-main">
										<div class="cat-list-col-main-left">
											<span><?php echo $num;?></span>
											<p><?php echo $value->name;?></p>
										</div>
										<div class="cat-list-col-main-right">
											<p>Sekundære kategorier:</p>
											<span class="count subcat_<?php echo $value->term_id;?>"><?php echo count($subcategories);?></span>
											<div class="arrow-box">
												<span class="arrow-left"></span>
											</div>
										</div> 
									</div>
									<div class="cat-list-col-sub" style="display: none;">
										<div class="cat-list-col-sub-col-add">
										<?php 
										foreach ($subcategories as $subkey => $subvalue){
										?>
										<div class="cat-list-col-sub-box ids_<?php echo $subvalue->term_id; ?>" data-cat_id="<?php echo $value->term_id;?>">
											<div class="sub-box-left">
												<p><?php echo $subvalue->name; ?></p>
											</div>
											<div class="sub-box-right">
												<span class="delete-btn delete-btn-category" data-cat_id="<?php echo $value->term_id;?>" id="<?php echo $subvalue->term_id; ?>" data-id="ids_<?php echo $subvalue->term_id; ?>"><img src="<?php echo plugins_url('../images/delete-img.png',__DIR__ );?>"></span>
											</div>
										</div>
										<?php } ?>
									</div>
										<div class="add-new-btn add-sub-category" id="<?php echo $value->term_id;?>">
											<a>Add New <img src="<?php echo plugins_url('../images/plus-symbol.png',__DIR__ );?>"></a>
										</div>
									</div>
								</div>

							<?php 
							$num++;
						} ?>

							</div>
							<div class="save-btn btn">
								<!-- <input type="submit" name="primary_category" value="Tilføj nye Hovedkategori"> -->
								<a href="javascript:void(0);" class="category_custom">Tilføj nye Hovedkategori</a>
								<p>Når du opretter en ny hovedkategori, vil den blive sendt til udvikling.</p>
							</div>
						</div>
						</form>
					</div>

				</div>
			</div>
			<div class="Categories-row subCetagory-row">
				<div class="cat-block">
					<form method="post" action="">
					<div class="cat-block-box active">
						<div class="event-manager-heading">
							<h3>Sekundaere kategorier</h3>
							<span class="arrow-down"></span>
						</div>
						<div class="cat-row-content">
							<div class="cat-row-list">
							<?php
							$num = 1;
							$taxonomy = 'ccategory_taxonomy';
							$args = array(
							    'taxonomy'   => $taxonomy,
							    'hide_empty' => false,
							    'parent' => 0,
							);

							$categories = get_terms($args);
							$subcategory_array = array();
							foreach ($categories as $key => $value){
								$subcategories = get_terms(array(
								    'taxonomy' => $taxonomy,
								    'hide_empty' => false,
								    'parent' => $value->term_id,
								));
							foreach ($subcategories as $subkey => $subcat){
									$subcategory_array[] = $subcat->term_id;
							}
						}
						//echo "<pre>";print_r($subcategories);
							foreach ($subcategory_array as $subkey => $subvalue){
								$image=get_term_meta($subvalue,'custom_taxonomy_image',true);
								$event_category=json_decode(get_term_meta($subvalue,'update_event_in_category',true));
							   	$term_name = get_term( $subvalue )->name;
								$activeClass = ($subkey == 0) ? 'active' : '';
								$arraycount = array();
								foreach ($event_category as $key => $value) {
									$ispostcount = get_post($value);
									if(!empty($ispostcount)){
										$arraycount[] = $ispostcount; 
									}
									
								}
							//echo "<pre>";print_r(count($arraycount));
								?>
								<div class="cat-list-col show_cat2 <?php echo $activeClass;?>" id="<?php echo $subvalue;?>" data-id="<?php echo 'cat_list_'.$subvalue;?>">
									<div class="cat-list-col-main">
										<div class="cat-list-col-main-left">
											<span><?php echo $num;?></span>
											<p><?php echo $term_name;?></p>
										</div>
										<div class="cat-list-col-main-right">
											<p>Sekundære kategorier:</p>
											<span class="count subcat_<?php echo $subvalue;?>"><?php echo count($arraycount);?></span>
											<div class="arrow-box">
												<span class="arrow-left"></span>
											</div>
										</div> 
										<div class="cat-list-col-main-right-image">
										  <input type="hidden" id="custom_taxonomy_image" name="custom_taxonomy_image" value="">
										  <button id="<?php echo $subvalue; ?>" class="button custom_taxonomy_image_upload_button">Background Image</button>
										  <?php if(!empty($image)){

										  	?>
										  	 <span class="custom_preview_image" style="display:block;" id="preview_<?php echo $subvalue; ?>"><img src="<?php echo $image; ?>" alt=""></span>
										  <?php }else{?>
										  	 <span class="custom_preview_image" id="preview_<?php echo $subvalue; ?>"></span>
										  <?php } ?>
										 
										  <span class="delete-btn delete-btn-category" data-cat_id="<?php echo $subvalue; ?>" id="<?php echo $subvalue; ?>" data-id="ids_<?php echo $subvalue; ?>"><img src="<?php echo plugins_url('../images/delete-img.png',__DIR__ );?>"></span>
										</div>
									</div>
									<div class="cat-list-col-sub" style="display: none;">
										<div class="cat-list-col-sub-col-add">
										<?php 
										if(!empty($event_category)){
										foreach ($event_category as $eventkey => $event_value){
											$ispost = get_post($event_value);
											if(!empty($ispost)){
											//echo "<pre>";print_r($event_value);
											$title=get_the_title($event_value);
											$url = wp_get_attachment_url( get_post_thumbnail_id($event_value), 'thumbnail' );
										?>
										<div class="cat-list-col-sub-box ids_<?php echo $event_value; ?>" data-cat_id="<?php echo $subvalue;?>">
											<div class="sub-box-left">
												<p><?php echo $title; ?></p>
											</div>
											<div class="cat-list-col-main-right-image">
												 <!--  <input type="hidden" id="custom_taxonomy_image" name="custom_taxonomy_image" value=""> -->
												  <!-- <button id="<?php echo $event_value; ?>" class="button custom_taxonomy_image_upload_button">Background Image</button> -->
												  <?php if(!empty($url)){

												  	?>
												  	 <span class="custom_preview_image" style="display:block;" id="preview_<?php echo $event_value; ?>"><img src="<?php echo $url; ?>" alt=""></span>
												  <?php }else{?>
												  	 <span class="custom_preview_image" id="preview_<?php echo $event_value; ?>"></span>
												  <?php } ?>
												 
												  <span class="delete-btn delete-btn-event" data-cat_id="<?php echo $subvalue;?>" id="<?php echo $event_value; ?>" data-id="ids_<?php echo $event_value; ?>"><img src="<?php echo plugins_url('../images/delete-img.png',__DIR__ );?>"></span>
											</div>
										</div>
										<?php }
									}
								} ?>
									</div>
									<div class="add-new-btn add-sub-category-event" id="<?php echo $subvalue;?>">
										<?php 
										$args = array(
												  'post_type' => 'event',
												  'posts_per_page' => -1,
												  'post_status'    =>'publish'
												);
												$post2 = get_posts($args);
										?>
										<select class="select_category_event" data-subId="<?php echo $subvalue;?>">
											  <option value="">Select Event</option>
											  <?php 
												  	if(!empty($post2)){
												  		foreach ($post2 as $post){
												  			$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
												  ?>
												  <option data-image="<?php echo $url; ?>" value="<?php echo $post->ID; ?>"<?php if ($post_array[$i] == $post->ID) echo ' selected'; if(in_array($post->ID,json_decode($results->post_ids))){echo ' disabled';} ?>><?php echo ucfirst($post->post_title); ?></option>
												  <?php 
													}
												  }
												  ?>
											</select>
									</div>
									</div>
								</div>

							<?php 
							$num++;
						  
						} ?>

							</div>
							<div class="save-btn btn">
								<!-- <input type="submit" name="primary_category" value="Tilføj nye Hovedkategori"> -->
								<a href="javascript:void(0);" class="category_custom2">Tilføj nye Sekundære kategori</a>
								<!-- <p>Når du opretter en ny hovedkategori, vil den blive sendt til udvikling.</p> -->
							</div>
						</div>
						</form>
					</div>

				</div>
			</div>
		</div>
	</div>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery(".show_cat").click(function(){
				var id = jQuery(this).attr("id");
				jQuery(".show_cat").removeClass('active');
				jQuery("#"+id).addClass('active');
			});
			jQuery(".show_cat2").click(function(e){
				e.preventDefault();
				jQuery(".show_cat2").removeClass('active');
				var id = jQuery(this).attr("data-id");
				console.log(id)
				jQuery(".show_cat2[data-id='"+id+"']").addClass('active');
			});

		    var max_fields      = 20;
		    var wrapper         = jQuery(".cat-list-col-sub");
		    var add_button      = jQuery(".add-sub-category");
		    var add_button2      = jQuery(".select_category_event");

		    var x = 1; 
		    jQuery(add_button).click(function(e){ 
		        e.preventDefault();
		        var ids = jQuery(this).attr("id");
		        if(x < max_fields){ 
		            x++;
		            jQuery("#"+ids+" .cat-list-col-sub-col-add").append('<div class="cat-list-col-sub-box ids_'+x+'"><div class="sub-box-left"><p><input type="text" name="subcategory_add_'+ids+'"></p></div><div class="sub-box-right"><span class="delete-btn delete-btn-category" data-id="ids_'+x+'"><img src="/wp-content/plugins/custom-events/images/delete-img.png"></span></div></div>');
		        }
		    });

		    jQuery(add_button2).on('change', function(){ 
		        //e.preventDefault();
		        var event_id = jQuery(this).val();
		        var event_text =  jQuery(this).find(":selected").text();
		        console.log(event_text);
		        var event_image =  jQuery(this).find(":selected").data('image');
		        var ids = jQuery(this).attr("data-subId");
		        if(x < max_fields){ 
		            x++;
		            jQuery(".show_cat2[data-id='cat_list_"+ids+"'] .cat-list-col-sub-col-add").append('<div class="cat-list-col-sub-box ids_'+x+'"><div class="sub-box-left"><p><input type="text" name="event_add_'+ids+'" id='+event_id+' value='+event_text+'></p></div><div class="cat-list-col-main-right-image"><span class="custom_preview_image" style="display:block;" id="preview_'+event_id+'"><img src='+event_image+'></span><span class="delete-btn delete-btn-event" data-cat_id='+ids+' id='+event_id+' data-id="ids_'+x+'"><img src="/wp-content/plugins/custom-events/images/delete-img.png"></span></div></div>');
		        }
		    });
		    jQuery(document).on("click",".delete-btn-category", function(e){ //alert("gdfgd");
		        e.preventDefault(); 
		        var data_id = jQuery(this).attr("data-id");
		        var cat_id = jQuery(this).attr("data-cat_id");
		        var subcat_id = jQuery(this).attr("id");
		        if(subcat_id == undefined){
		        	$('.'+data_id).remove(); x--;
		        }else{ //alert(subcat_id)
		        swal({
					  title: "Are you sure want to delete this category?",
					  text: "",
					  icon: "warning",
					  buttons: true,
				      dangerMode: true,
				      buttons: ['No', 'Yes'],
					  dangerMode: true,
					})
					.then((willDelete) =>{
					  if (willDelete){
					  	$.ajax({
					  		method: "POST",
					  		dataType: "json",
					  		url:'/wp-admin/admin-ajax.php', 
					  		data: {
					  			action: 'SSBAD_subcategory_delete',
					  			subcat_id:subcat_id },
					  			success: function(response) {
					  				console.log(response);
					  				if(response.status == '200'){
					  				$('.'+data_id).remove(); x--;
					  				var count_subcat = $('.subcat_'+cat_id).text();
					  				var total = count_subcat-1;
					  				$('.subcat_'+cat_id).text(total);
					  				}else if(response.status == '201'){
					  					$('.'+data_id).remove(); x--;
					  				}
					  			},
					  			error: function(xhr, status, error) {
					  				console.error("Error saving data: " + error);
					  			}
					  		});
					  	location.reload();
					  }else{
					    //swal("Subcategory not delete!");
					}

				});
				}
		    });
		    jQuery(document).on("click",".delete-btn-event", function(e){ //alert("gdfgd");
		        e.preventDefault(); 
		        var data_id = jQuery(this).attr("data-id");
		        var cat_id = jQuery(this).attr("data-cat_id");
		        var event_id = jQuery(this).attr("id");
		        if(event_id == undefined){
		        	$('.'+data_id).remove(); x--;
		        }else{ //alert(subcat_id)
		        swal({
					  title: "Are you sure want to delete this category?",
					  text: "",
					  icon: "warning",
					  buttons: true,
				      dangerMode: true,
				      buttons: ['No', 'Yes'],
					  dangerMode: true,
					})
					.then((willDelete) =>{
					  if (willDelete){
					  	$.ajax({
					  		method: "POST",
					  		dataType: "json",
					  		url:'/wp-admin/admin-ajax.php', 
					  		data: {
					  			action: 'SSBAD_event_category_delete',
					  			event_id:event_id ,cat_id:cat_id},
					  			success: function(response) {
					  				if(response.status == '200'){
					  				$('.'+data_id).remove(); x--;
					  				var count_subcat = $('.subcat_'+cat_id).text();
					  				var total = count_subcat-1;
					  				$('.subcat_'+cat_id).text(total);
					  				}else if(response.status == '201'){
					  					$('.'+data_id).remove(); x--;
					  				}
					  			},
					  			error: function(xhr, status, error) {
					  				console.error("Error saving data: " + error);
					  			}
					  		});
					  	
					  }else{
					    //swal("Subcategory not delete!");
					}

				});
				}
		    });
			jQuery('.category_custom').click(function(e){
				e.preventDefault(); 
				var myObject = [];
			    jQuery('.cat-list-col').each(function(){
			      var cat_id =jQuery(this).attr('id');
			      var inputValues = [];
			      var subcat_id = [];
			      jQuery('input[name="subcategory_add_'+cat_id+'"]').each(function(){
				      var subcat_ids = jQuery(this).attr('id');
				      //if(subcat_ids == undefined){
				      	var value = jQuery(this).val();
				      //} 
				      subcat_id.push(subcat_ids);
				      inputValues.push(value);
				    });
			       myObject.push({cat_id : cat_id,subcat_id:subcat_id,subcategory_name : inputValues});
			    });
			    $.ajax({
			    	method: "POST",
			    	dataType: "json",
			        url:'/wp-admin/admin-ajax.php', 
			      	data: {
			      		action: 'SSBAD_subcategory_create',
			      		myObject:myObject },
			      success: function(response) {
			      	if(response.status == 'update'){
						        location.reload();
			      	}else{
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
			    },
			    error: function(xhr, status, error){
			    	console.error("Error saving data: " + error);
			    }
			});

			});
		jQuery('.category_custom2').click(function(e){
				e.preventDefault(); 
				var myObject = [];
			    jQuery('.cat-list-col').each(function(){
			      var cat_id =jQuery(this).attr('id');
			      var inputValues = [];
			      var event_id = [];
			      jQuery('input[name="event_add_'+cat_id+'"]').each(function(){
				      var event_ids = jQuery(this).attr('id');
				      //if(subcat_ids == undefined){
				      	var value = jQuery(this).val();
				      //} 
				      event_id.push(event_ids);
				    });
			       myObject.push({cat_id : cat_id,event_id:event_id});
			    });
			    $.ajax({
			    	method: "POST",
			    	dataType: "json",
			        url:'/wp-admin/admin-ajax.php', 
			      	data: {
			      		action: 'SSBAD_subcategory_event_save',
			      		myObject:myObject },
			      success: function(response) {
			      	 //location.reload();
			   //    	if(response.status == '200'){
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
			   //    	}else{

			   //    	}
			    },
			    error: function(xhr, status, error){
			    	console.error("Error saving data: " + error);
			    }
			});

			});
		});
	</script>