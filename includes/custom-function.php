<?php
add_action('wp_ajax_create_event_tag', 'create_event_tag');
add_action('wp_ajax_nopriv_create_event_tag', 'create_event_tag');

function create_event_tag() {
	global $wpdb;
    $taxonomy = 'event_tag';
    $name = $_POST['eventname'];
    $term = term_exists($name, $taxonomy);
	if (!$term) {
        $term = wp_insert_term($name, $taxonomy);
        if (!is_wp_error($term) && isset($term['term_id'])) {
		    $tags = get_terms(array(
		        'taxonomy' => $taxonomy,
		        'hide_empty' => false,
		    ));
		    //foreach ($tags as $key => $value) {
		    $term_name = get_term( $term['term_id'])->name;
				$content = '<li class="event-list-item delete_'.$term['term_id'].'">'.$term_name.'<span class="event-delete-button" id="'.$term['term_id'].'">&times;</span></li>';
			//}
			echo json_encode(array('status' =>'200','content'=>$content ));
        }
    }else{
        echo json_encode(array('status' =>'201'));  
    }
	
	//echo "1";
	wp_die();
}

//delete event tags
add_action('wp_ajax_delete_event_tag', 'delete_event_tag');
add_action('wp_ajax_nopriv_delete_event_tag', 'delete_event_tag');
function delete_event_tag() {
	global $wpdb;
    $name = $_POST['tag_id'];
   	if(!empty($_POST['tag_id'])){
  		$taxonomy = 'event_tag';
  		$result = wp_delete_term($_POST['tag_id'], $taxonomy);
  		$content = '';
  		if (is_wp_error($result)) {
		    echo json_encode(array("status" => '201','message'=>$result->get_error_message()));
		}else{
			
			echo json_encode(array('status' =>'200','term_id'=>$_POST['tag_id']));
		}
	  }else{
	  	 echo json_encode(array("status" => '202'));
	  }
	wp_die();
}
add_action('wp_ajax_remove_event_post', 'remove_event_post');
add_action('wp_ajax_nopriv_remove_event_post', 'remove_event_post');

function remove_event_post(){
	global $wpdb;
    $postid = $_POST['postid'];
    wp_delete_post($postid);
	echo json_encode( $postid );
	//echo "1";
	wp_die();
}

//publish unpublish btn
add_action('wp_ajax_publish_unpublish_event_post', 'publish_unpublish_event_post');
add_action('wp_ajax_nopriv_publish_unpublish_event_post', 'publish_unpublish_event_post');

function publish_unpublish_event_post(){
	global $wpdb;
    $postid = $_POST['postid'];
    $post_status = get_post_status($postid);
    if($post_status == 'publish'){
    	$post_data = array(
		    'ID' => $postid,
		    'post_status' => 'draft',
		);
		$update_result = wp_update_post($post_data);
		echo json_encode(array('status'=>'Unpublish','post_id'=>$postid));
    }else{
    	$post_data = array(
		    'ID' => $postid,
		    'post_status' => 'publish',
		);
		$update_result = wp_update_post($post_data);
		echo json_encode(array('status'=>'Publish','post_id'=>$postid));
    }

	//echo json_encode( $postid );
	//echo "1";
	wp_die();
}
//publish unpublish btn
add_action('wp_ajax_SSBAD_right_tab_function', 'SSBAD_right_tab_function');
add_action('wp_ajax_nopriv_SSBAD_right_tab_function', 'SSBAD_right_tab_function');
function SSBAD_right_tab_function(){
	global $wpdb;
	if(!empty($_POST['sortedData'])){
		$postids = json_encode($_POST['post_id_data']);
	    $sortedData = json_encode($_POST['sortedData']);
	    $get_tab_id = $_POST['get_tab_id'];
	    $data = array(
		  'post_ids' => $postids,
		  'post_tab' => $sortedData,
		  'get_tab_id'=>$get_tab_id
		);
		$table_name = $wpdb->prefix . 'frontpage_tab';

		$query = "SELECT * FROM $table_name WHERE get_tab_id = %s";
		$column1_value = $get_tab_id;
		$prepared_query = $wpdb->prepare($query, $column1_value);
		$results = $wpdb->get_results($prepared_query);
		if($results){
			$data_update = array(
			  'post_ids' => $postids,
			  'post_tab' => $sortedData,
			);
			$where = array(
			  'get_tab_id' => $get_tab_id,
			);
			$result = $wpdb->update($table_name, $data_update, $where);
			  echo json_encode(array("status" => 'update'));
		}else{
			$result = $wpdb->insert($table_name, $data);
			   echo json_encode(array("status" => 'insert'));
			
		}
	}else{
	  echo json_encode(array("status" => '201'));
	}
	die;
}

add_action('wp_ajax_SSBAD_subcategory_create', 'SSBAD_subcategory_create');
add_action('wp_ajax_nopriv_SSBAD_subcategory_create', 'SSBAD_subcategory_create');
function SSBAD_subcategory_create(){
	global $wpdb;
	if(!empty($_POST['myObject'])){
		$update_succes = 0;
		$array_cat2 = array();
		foreach ($_POST['myObject'] as $key => $value){
			if(!empty($value['subcategory_name'])){
				$i=0;
				$array_cat=array();
				foreach ($value['subcategory_name'] as $key => $sub_value){
					if(!empty($sub_value)){
						$taxonomy = 'ccategory_taxonomy';
						$parent_term = get_term(trim($value['cat_id']), $taxonomy);
						if (!is_wp_error($parent_term)){
    						$existing_subcategory = get_term_by('name', $sub_value, $taxonomy);
    						$existing_subcatid = get_term_by('term_id', $value['subcat_id'][$i], $taxonomy);
						    if (!$existing_subcategory && $existing_subcatid ==''){
						        $subcategory_data = array(
						            'name'        => $sub_value,
						            'slug'        => sanitize_title($sub_value),
						            'parent'      => $value['cat_id'],
						        );
						        $result = wp_insert_term($subcategory_data['name'], $taxonomy, $subcategory_data);
						        if(!is_wp_error($result)){
						            $subcat_id = $result['term_id'];
						            $array_cat['sub_catid'][]=$result['term_id'];
						            $array_cat['catid']=$value['cat_id'];
						            $update_succes++;
						        }
						    }else{
						    	$subcategory_data = array(
                                    'name'   => $sub_value,
                                    'slug'   => sanitize_title($sub_value),
                                    'parent' => $value['cat_id'],
                                );
                                $result = wp_update_term($existing_subcatid->term_id, $taxonomy, $subcategory_data);
                                if (!is_wp_error($result)) {
                                    $subcat_id = $result['term_id'];
                                    $update_succes++;
                                }
						    }
						}else{
						    echo json_encode(array("status" => '201',"message"=>'Parent term does not exist.'));
						}
					}
					$i++;
				}
				$array_cat2[]=$array_cat;
			}
		}
		if($update_succes > 0){
			echo json_encode(array("status" => 'update','categorieids'=>$array_cat2));
		}else{
			echo json_encode(array("status" => '201'));
		}
	}
	die;
}


add_action('wp_ajax_SSBAD_subcategory_delete', 'SSBAD_subcategory_delete');
add_action('wp_ajax_nopriv_SSBAD_subcategory_delete', 'SSBAD_subcategory_delete');
function SSBAD_subcategory_delete(){
  if(!empty($_POST['subcat_id'])){
  		$taxonomy = 'ccategory_taxonomy';
  		$result = wp_delete_term($_POST['subcat_id'], $taxonomy);
  		if (is_wp_error($result)) {
		    echo 'Error deleting subcategory: ' . $result->get_error_message();
		}else{
			echo json_encode(array("status" => '200'));
		}
  }else{
  	 echo json_encode(array("status" => '201'));
  }
  die;
}

add_action('wp_ajax_SSBAD_event_category_delete', 'SSBAD_event_category_delete');
add_action('wp_ajax_nopriv_SSBAD_event_category_delete', 'SSBAD_event_category_delete');
function SSBAD_event_category_delete(){
  if(!empty($_POST['event_id'])){
  		$get_term = json_decode(get_term_meta($_POST['cat_id'],'update_event_in_category',true));
  		$array = array();
  		foreach ($get_term as $value) {
  			if ($_POST['event_id'] == $value) {
		        continue;
		    }
		    $array[] = $value; 
  		}
  		update_term_meta($_POST['cat_id'],'update_event_in_category',json_encode($array));
  		echo json_encode(array("status" => '200'));
  }else{
  	 echo json_encode(array("status" => '201'));
  }
  die;
}

add_action('wp_ajax_SSBAD_subcategory_image_upload', 'SSBAD_subcategory_image_upload');
add_action('wp_ajax_nopriv_SSBAD_subcategory_image_upload', 'SSBAD_subcategory_image_upload');
function SSBAD_subcategory_image_upload(){
  if(!empty($_POST['subcat_id'])){
        $image_url = sanitize_text_field($_POST['img_url'] );
        update_term_meta( $_POST['subcat_id'], 'custom_taxonomy_image', $image_url );
  }else{
  	 echo json_encode(array("status" => '201'));
  }
  die;
}


add_action('wp_ajax_SSBAD_subcategory_event_save', 'SSBAD_subcategory_event_save');
add_action('wp_ajax_nopriv_SSBAD_subcategory_event_save', 'SSBAD_subcategory_event_save');
function SSBAD_subcategory_event_save(){
	global $wpdb;
	if(!empty($_POST['myObject'])){
		foreach ($_POST['myObject'] as $key => $value) {
			if(isset($value['event_id'])){
				$events = $value['event_id'];
				$get_term = json_decode(get_term_meta($value['cat_id'],'update_event_in_category',true));
				if(isset($get_term)){
					$term_merge=array_unique(array_merge($get_term,$events));
				}else{
				    $term_merge=array_unique($events);	
				}
				update_term_meta($value['cat_id'], 'update_event_in_category', json_encode($term_merge));
				echo json_encode(array("status" => '200','cate_id'=>$value['cat_id'],'count'=>count($value['event_id'])));
		    }
		}
	}
	die;
}

//save post html content
add_action('wp_ajax_save_post_content_block_function', 'save_post_content_block_function');
add_action('wp_ajax_nopriv_save_post_content_block_function', 'save_post_content_block_function');
function save_post_content_block_function(){
  
  if(!empty($_POST['post_id'])){
  		$encodedData = $_POST['encodedData'];
  		$htmlContent = $encodedData;
		update_post_meta($_POST['post_id'],'save_post_htmlcontent',$htmlContent);
		echo json_encode(array("status" => '200'));
	}
	die;
}

?>