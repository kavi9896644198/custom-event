<?php $select_website = esc_attr( get_post_meta( $post->ID, 'select_website', true ) ); 
    $ff_page = esc_attr( get_post_meta( $post->ID, 'ff_page', true ) ); 
    $category_option = esc_attr( get_post_meta( $post->ID, 'option_category', true ) ); 
?>
<div class="event-options">
    <div class="event-options-col" style="display: none;">
    	<p>Website:</p>
        <select name="select_website">
            <option value="">Select Website</option>
            <option value="1" <?php if($select_website == 1){ echo 'selected';}?>>SSBAD</option>
            <option value="2" <?php if($select_website == 2){ echo 'selected';}?>>FORUM KOLDING</option>
            <option value="3" <?php if($select_website == 3){ echo 'selected';}?>>DOROTHEAS BADSTUE</option>
            <option value="4" <?php if($select_website == 4){ echo 'selected';}?>>SCT. JØRGENS GAARD</option>
            <option value="5" <?php if($select_website == 5){ echo 'selected';}?>>KONGEÅBADET</option>
        </select>
    </div>
    <div class="event-options-col">
    	<p>Category:</p>
        <?php 
            $taxonomy = 'ccategory_taxonomy';
            $args = array(
                    'taxonomy'   => $taxonomy,
                    'hide_empty' => false,
                    'parent' => 0,
                );
            $categories = get_terms($args);
        ?>
        <select name="option_category">
            <option value="">Select Category</option>
            <?php
            if(!empty($categories)){
            foreach ($categories as $key => $value){
            ?>
            <option value="<?php echo $value->term_id; ?>" <?php if($category_option == $value->term_id){ echo 'selected';}?>><?php echo ucfirst($value->name); ?></option>
            <?php 
            }
        }else{
            echo '<option value="">No category found</option>';
        }
            ?>
        </select>
    </div>
    <div class="event-options-col">
    	<p>Show on FF Page:</p>
        <select name="ff_page">
            <option value="">Select</option>
            <option value="yes" <?php if($ff_page == 'yes'){ echo 'selected';}?>>Yes</option>
            <option value="no" <?php if($ff_page == 'no'){ echo 'selected';}?>>No</option>
        </select>
    </div>
</div>