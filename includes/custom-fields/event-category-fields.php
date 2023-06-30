<?php
$taxonomy = 'ccategory_taxonomy';
$args = array(
    'taxonomy'   => $taxonomy,
    'hide_empty' => false,
    'parent' => 0,
);

$categories = get_terms($args);

//echo "<pre>";print_r($categories);
?>
<div class="page-content-areaa">
	<div class="check-block">
		<div class="check-block-left">
			<div class="check-block-inner">
				<h6>Her kan du vælge hoved kategori</h6>
				<ul>
					<?php
					$primarycategory = explode(',', get_post_meta( $post->ID, 'primary_category', true ));

					//echo "<pre>";print_r($secondarycate->secondarycategory->secondary_category);
					foreach ($categories as $mainkey => $mainvalue){
						if(in_array($mainvalue->term_id, $primarycategory)){
							$checkedli = ' checked';
						}else{
							$checkedli = '';
						}
						
						echo '<li>
								<input type="checkbox" name="primary_category[]" value="'.$mainvalue->term_id.'" '.$checkedli.'>
								'.$mainvalue->name.'
							</li>';
					}

					?>
					
				</ul>
			</div>
		</div>
		<div class="check-block-right">
			<div class="check-block-inner">
				<h6>Her kan du vælge sekundær kategori</h6>
				<ul>
					<?php
					$secondarycategory = explode(',', get_post_meta( $post->ID, 'secondary_category', true ));

					//echo "<pre>";print_r($secondarycategory);
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
						//echo "<pre>";print_r($subcategory_array);
					}
					foreach ($subcategory_array as $subkey => $subvalue){
						   	$subsubcategories = get_terms(array(
							    'taxonomy' => $taxonomy,
							    'hide_empty' => false,
							    'parent' => $subvalue,
							));
						if(in_array($subvalue, $secondarycategory)){
							$checked_li = ' checked';
						}else{
							$checked_li = '';
						}
							$term_name = get_term( $subvalue )->name;
							echo '<li>
								<input type="checkbox" name="secondary_category[]" value="'.$subvalue.'" '.$checked_li.'>
								'.$term_name.'
							</li>';
							//echo "<pre>";print_r($subvalue);
						   }
					?>
					
				</ul>
			</div>
		</div>
	</div>
</div>
<style type="text/css">
	.check-block {
    display: flex;
    width: 100%;
    margin-top: -6px;
    margin-bottom: -12px;
}
.check-block>div {
    margin-right: 15px;
    padding-right: 15px;
    border-right: 1px solid #C6C6C6;
}
.check-block-inner {
    padding: 10px 0px;
}
.check-block-inner h6 {
    margin-top: 0px;
    margin-bottom: 10px;
    font-size: 11px;
}
.check-block-inner ul {
    margin: 0px;
    padding: 0px;
    list-style: none;
}
</style>