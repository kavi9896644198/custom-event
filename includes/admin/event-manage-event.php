<?php
	$posts = get_posts([
	  'post_type' => 'event',
	  'post_status' => array('publish','draft'),
	  'numberposts' => -1
	  // 'order'    => 'ASC'
	]);
	//echo "<pre>";print_r($posts);die;
?>
<div class="main-layout-section">
		<div class="wrapper-inner">
			<div class="top-heading">
				<h2>Events Manager</h2>
			</div>
			<div class="event-manager-block active">
				<div class="event-manager-heading">
					<h3>Events</h3>
					<span class="arrow-down"></span>
				</div>
				<div class="event-manager-content">
					<table>
						<thead>
							<tr>
								<th></th>
								<th>Event title</th>
								<th>Website</th>
								<th>Category</th>
								<th>State</th>
								<th></th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php
							$num = 1;
							foreach ($posts as $key => $value) {
								$taxonomy = 'ccategory_taxonomy';
								$select_website = get_post_meta($value->ID, 'select_website',true);
								$category_id = esc_attr( get_post_meta( $value->ID, 'option_category', true ) );
								if(!empty($category_id)){
									$category_name = get_term($category_id)->name;
								}else{
									$category_name = 'Not select';
								}
								
								if($select_website == 1){
									$Website = 'SSBAD';
								}else if($select_website ==2){
									$Website = 'FORUM KOLDING';
								}else if($select_website ==3){
									$Website = 'DOROTHEAS BADSTUE';
								}else if($select_website ==4){
									$Website = 'SCT. JØRGENS GAARD';
								}else if($select_website ==5){
									$Website = 'KONGEÅBADET';
								}else{
									$Website = 'Not select';
								}
								$class = ($value->post_status == 'publish') ? 'green' : 'red';
								$status = ($value->post_status == 'publish') ? 'Publish' : 'Unpublish';
								$status2 = ($value->post_status != 'publish') ? 'Publish' : 'Unpublish';
								echo '<tr id="tr_'.$value->ID.'">
								<td>'.$num.'</td>
								<td>'.$value->post_title.'</td>
								<td>'.$Website.'</td>
								<td>'.$category_name.'</td>
								<td class="'.$class.' publish_'.$value->ID.'">'.$status.'</td>
								<td class="btn-td">
									<a href="/wp-admin/post.php?post='.$value->ID.'&action=edit" class="table-btn">edit</a>
								</td>
								<td class="btn-td">
									<a href="#" class="table-btn publish-event-btn unplublish_'.$value->ID.'" data-id='.$value->ID.'>'.$status2.'</a>
								</td>
								<td class="btn-td">
									<a class="table-btn delete-btn" data-id="'.$value->ID.'">Delete</a>
								</td>
							</tr>
							<tr height="10"></tr>';
							$num++;
							}
							?>
							
						</tbody>
					</table>
					<div class="btn">
						<a href="/wp-admin/post-new.php?post_type=event">Add New Event</a>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script type="text/javascript">
		jQuery(function($) {
		jQuery('.delete-btn').click(function (e){
				var postid = jQuery(this).attr("data-id");
		        var urls = '/wp-admin/admin-ajax.php';
	            var data = {
			        "postid": postid,
			        "action": "remove_event_post"
			       }
			 swal({
			  title: "Are you sure want to delete this Event?",
			  text: "",
			  icon: "warning",
			  buttons: true,
		      dangerMode: true,
		      buttons: ['No', 'Yes'],
			  dangerMode: true,
			}).then((willDelete) =>{
			  	if (willDelete){
			  		ajax_call_postdelete(data, urls);
				}

			});
			    
		    
        });
        jQuery('.publish-event-btn').click(function (e){
				var postid = jQuery(this).attr("data-id");
		        var urls = '/wp-admin/admin-ajax.php';
	            var data = {
			        "postid": postid,
			        "action": "publish_unpublish_event_post"
			       }
			    ajax_call_postpublish_unpublish(data, urls);
		    
        });

	});
	function ajax_call_postdelete(data, urls){
		
		jQuery.ajax({
	        url: urls,
	        type: 'POST',
	        dataType: "json",
	        data: data,
	        beforeSend: function () {
	            jQuery(".preloader_back").show();
	        },
	        success: function (response) {
	        	jQuery(".preloader_back").hide();
	        	jQuery("#tr_"+response).remove();
	        	//jQuery("#tagId").empty().html(response);
	        	console.log(response);
	        	//togglePopup();
	        	//setTimeout(function(){ togglePopup(); }, 3000);
	        }
	    });


    }
    function ajax_call_postpublish_unpublish(data, urls){
    	jQuery.ajax({
            url: urls,
            type: 'POST',
            dataType: "json",
            data: data,
            beforeSend: function () {
                jQuery(".preloader_back").show();
            },
            success: function (response) {
            	jQuery(".preloader_back").hide();
            	if(response.status == 'Publish'){
            	 jQuery('.unplublish_'+response.post_id).text('Unpublish');
            	 jQuery('.publish_'+response.post_id).removeClass("red");
            	 jQuery('.publish_'+response.post_id).addClass("green");
            	}else{
            		jQuery('.unplublish_'+response.post_id).text('Publish');
            		jQuery('.publish_'+response.post_id).removeClass("green");
            	    jQuery('.publish_'+response.post_id).addClass("red");
            	}
            	jQuery('.publish_'+response.post_id).text(response.status);
            	console.log(response);
            }
        });
    }
	</script>