<?php
$getEvent_tag = get_EventTag();
?>
<style>
  .event-list-item {
    position: relative;
  }

  .event-delete-button {
    display: none;
    position: absolute;
    top: 0;
    right: 0;
    padding: 5px;
    background-color: grey;
    color: white;
    cursor: pointer;
    font-weight: 600;
}
 /* .event-delete-button {
    position: absolute;
    top: -7px;
    right: -8px;
    width: 20px;
    height: 20px;
    border-radius: 100%;
    display: flex !important;
    align-items: center;
    justify-content: center;
    line-height: normal;
    cursor: pointer;
}*/
  .event-delete-button {
  margin-left: 5px;
}

  .event-list-item:hover .event-delete-button {
    display: block;
    position: absolute;
    top: -7px;
    right: -7px;
    width: 16px;
    height: 16px;
    border-radius: 100%;
    display: flex !important;
    align-items: center;
    justify-content: center;
    line-height: normal;
    cursor: pointer;
}
</style>
<div class="main-layout-section">
		<div class="wrapper-inner">
			
			<div class="top-heading">
				<h2>tags</h2>
			</div>
			<div class="event-manager-block active">
				<div class="event-manager-heading">
					<h3>Tags</h3>
					<span class="arrow-down"></span>
				</div>
				<div class="tag-content">
					<div class="tag-input-row">
						<input type="text" name="eventname" id="event_name" placeholder="Tilføj nye tag">
					</div>
					<div class="tag-list-row">
						<ul id="tagId">
							<?php
							$taxonomy = 'event_tag';
							$tags = get_terms(array(
						        'taxonomy' => $taxonomy,
						        'hide_empty' => false,
						    ));
							if(!empty($tags)){
								foreach ($tags as $key => $value) {
									echo '<li class="event-list-item delete_'.$value->term_id.'" id="'.$value->term_id.'">'.$value->name.'<span class="event-delete-button" id="'.$value->term_id.'">&times;</span></li>';
								}
							}else{
								echo '<li>Not Found</li>';
							}
							?>
							
						</ul>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script type="text/javascript">
		jQuery(function($) {

		//jQuery('body').on('click', '#event_name', function() { alert("fsf");
		jQuery('#event_name').keydown(function (e){
			if(e.keyCode == 13){
		        var eventname = jQuery("input[name='eventname']").val();
		        var urls = '/wp-admin/admin-ajax.php';
	            var data = {
			        "eventname": eventname,
			        "action": "create_event_tag"
			       }
			    ajax_call_data(data, urls);
		    }
		    //ajax_call_data(data);
        });
        jQuery('.event-delete-button').click(function(e){
        	e.preventDefault(); 
        	var tag_id = jQuery(this).attr('id');
        	if(tag_id !=''){
        		var data = {
			        "tag_id": tag_id,
			        "action": "delete_event_tag"
			       }
        		jQuery.ajax({
	            url: '/wp-admin/admin-ajax.php',
	            type: 'POST',
	            dataType: "json",
	            data: data,
	            success: function (response) {
	            	if(response.status == 200){
	            		jQuery(".preloader_back").hide();
	            		jQuery('.delete_'+response.term_id).css('display','none');
	            	}else{
	            		swal("Something went wrong! Please try again");
	            	}
	            }
	        });
        	}else{
        		alert('term id not exist');
        	}

        });

	});
	function ajax_call_data(data, urls){
    	jQuery.ajax({
            url: urls,
            type: 'POST',
            dataType: "json",
            data: data,
            beforeSend: function () {
                jQuery(".preloader_back").show();
            },
            success: function (response) {
            	if(response.status == 200){
            		jQuery(".preloader_back").hide();
            		jQuery("#event_name").val('');
            		jQuery("#tagId").append(response.content);
            		console.log(response.content);
            		location.reload();
            	}else if(response.status == 201){
            		swal("Already exist tag");
            	}
            	//togglePopup();
            	//setTimeout(function(){ togglePopup(); }, 3000);
            }
        });
    }
	</script>