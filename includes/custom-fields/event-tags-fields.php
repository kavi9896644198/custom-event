<?php
$getEvent_tag = get_EventTag();

$event_tags = esc_attr( get_post_meta( $post->ID, 'event_tags', true ) ); 
$eventtag = explode(',', $event_tags);
?>
<div class="tag-layout-section">
		<ul id="tagIdevent">
							<?php
							$taxonomy = 'event_tag';
							$tags = get_terms(array(
						        'taxonomy' => $taxonomy,
						        'hide_empty' => false,
						    ));
							if(!empty($tags)){
								foreach ($tags as $key => $value) {
									//echo '<li>'.$value->name.'</li>';
									$checked = in_array($value->term_id, $eventtag) ? 'checked' : '';
									echo '<li><input name="event_tag[]" class="tag_check" type="checkbox" id="ids-'.$value->term_id.'" value="'.$value->term_id.'" '.$checked.'><span>'.$value->name.' </span></li>';
								}
							}else{
								echo '<li>Not Found</li>';
							}
							?>
					<input type="hidden" name="event_tags" id="tag_checkbox">
						</ul>
					
		</div>
		<div class="btn tag-btn">
						<a href="/wp-admin/edit.php?post_type=event&page=event-tags">Manage Tags</a>
					</div>

<script type="text/javascript">
	jQuery(document).ready(function() {

		jQuery('.tag_check').click(function() {
		    var id = jQuery(this).attr("id");

	   		if(jQuery('#'+id).is(':checked')){ 
			   var searchIDs = jQuery('input.tag_check:checked').map(function(){
        			return jQuery(this).val();
				}).toArray();
			    jQuery("#tag_checkbox").val(searchIDs.join(","));
		   }else{
		   	var searchIDs = jQuery('input.tag_check:checked').map(function(){
        			return jQuery(this).val();
				}).toArray();
			    jQuery("#tag_checkbox").val(searchIDs.join(","));
		   } 
		});
	});
</script>
	
	