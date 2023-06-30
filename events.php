<?php
/* 

Plugin Name: Events

Plugin URI: https://ssbad.dev.indicom.dk/

Description: Events 

Version: 1.0
*/

define( 'EVENTS_PATH', dirname( __FILE__ ) );

add_action( 'admin_init','add_script_events');

function add_script_events() {
    wp_register_style('add_events_css', plugins_url('css/admin-style.css',__FILE__ ));
    //wp_register_style('add_bootstrapicons_css', plugins_url('css/bootstrapicons-iconpicker.css',__FILE__ ));
    wp_enqueue_script ( 'wc-plus-bootstrapicon-jquery-cdn', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js' );
   
    wp_enqueue_style('add_events_css');
}

function webroom_add_custom_js_file_to_admin() {
     //wp_enqueue_script ( 'wc-plus-bootstrapicon-jquery-cdn', 'https://code.jquery.com/jquery-3.6.0.min.js' );
    wp_enqueue_media();
     wp_enqueue_script( 'custom-taxonomy-image-upload', get_template_directory_uri() . '/js/custom-taxonomy-image-upload.js', array( 'jquery', 'media-editor'), '', true );
}
add_action('admin_enqueue_scripts', 'webroom_add_custom_js_file_to_admin');

// add_action("admin_menu", "events_Menu");

// function events_Menu() {
//     add_menu_page("My Menu", "Events", -1, "get-event", "event_start_page", plugins_url('/checkout-woocom/img/icon_menus.svg',__DIR__));
//     add_submenu_page("get-event", "Events", "Events", 0, "get-event-menu", "event_start_page");
//     add_submenu_page("get-event", "Add Event", "Add Event", 0, "add-event", "add_new_event");
//     add_submenu_page("get-event", "Event Categories", "Event Categories", 0, "event-categories", "event_categories");
//     add_submenu_page("get-event", "Front Page", "Front Page", 0, "front-page", "event_front_page");
   
// }



add_action( 'init', 'ht_custom_post_custom_article' );
// The custom function to register a custom article post type
function ht_custom_post_custom_article() {
    // Set the labels. This variable is used in the $args array
    $labels = array(
        'name'               => __( 'Events' ),
        'singular_name'      => __( 'Event' ),
        'add_new'            => __( 'Add Event' ),
        'add_new_item'       => __( 'Add New Event' ),
        'edit_item'          => __( 'Edit Custom Event' ),
        'new_item'           => __( 'New Custom Event' ),
        'all_items'          => __( 'All Events' ),
        'view_item'          => __( 'View Custom Event' ),
        'search_items'       => __( 'Search Custom Event' )
    );
// The arguments for our post type, to be entered as parameter 2 of register_post_type()
    $args = array(
        'labels'            => $labels,
        'description'       => 'Holds our custom event post specific data',
        'public'            => true,
        'menu_position'     => 20,
        'taxonomies'          => array( 'genres' ),
        'supports'          => array( 'title', 'thumbnail', 'excerpt', 'custom-fields' ),
        'has_archive'       => true,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'query_var'         => true,
    );
    // Call the actual WordPress function
    // Parameter 1 is a name for the post type
    // Parameter 2 is the $args array
    register_post_type('event', $args);
}

function create_custom_taxonomy() {
    $labels = array(
        'name'                       => 'Categories1',
        'singular_name'              => 'Category',
        'menu_name'                  => 'Categories1',
        'all_items'                  => 'All Categories1',
        'parent_item'                => 'Parent Category',
        'parent_item_colon'          => 'Parent Category:',
        'new_item_name'              => 'New Category Name',
        'add_new_item'               => 'Add New Category',
        'edit_item'                  => 'Edit Category',
        'update_item'                => 'Update Category',
        'view_item'                  => 'View Category',
        'separate_items_with_commas' => 'Separate categories with commas',
        'add_or_remove_items'        => 'Add or remove categories',
        'choose_from_most_used'      => 'Choose from the most used categories',
        'popular_items'              => 'Popular Categories',
        'search_items'               => 'Search Categories',
        'not_found'                  => 'No categories found.',
        'no_terms'                   => 'No categories',
        'items_list'                 => 'Categories list',
        'items_list_navigation'      => 'Categories list navigation',
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => false,
        'query_var'         => true,
        'show_in_menu'       => false,
        'rewrite'           => array( 'slug' => 'event-category' ),
    );

    register_taxonomy( 'ccategory_taxonomy', 'event', $args );
}
add_action( 'init', 'create_custom_taxonomy' );
//add image upload code
function add_ccategory_taxonomy_image_field( $taxonomy ) {
    $image=get_term_meta($_GET['tag_ID'],'custom_taxonomy_image',true);
    ?>
    <div class="form-field term-group">
        <input type="hidden" id="custom_taxonomy_image" name="custom_taxonomy_image" value="">
        <div id="custom_taxonomy_image_preview" style="width: 200px;height: 200px;"><img src="<?php if(!empty($image)){echo $image;} ?>" style="width: 200px;height: 200px;"></div>
        <button id="custom_taxonomy_image_upload_button" class="button">Upload Image</button>
        <button id="custom_taxonomy_image_remove_button" class="button" style="display: none;">Remove Image</button>
    </div>
    <?php
}
add_action( 'ccategory_taxonomy_add_form_fields', 'add_ccategory_taxonomy_image_field', 10, 2 );
add_action( 'ccategory_taxonomy_edit_form_fields', 'add_ccategory_taxonomy_image_field', 10, 2 );
function save_ccategory_taxonomy_image( $term_id, $tt_id, $taxonomy ) {
    if ( isset( $_POST['custom_taxonomy_image'] ) ) {
        $image_url = sanitize_text_field($_POST['custom_taxonomy_image'] );
        update_term_meta( $term_id, 'custom_taxonomy_image', $image_url );
    }
}
add_action( 'edited_ccategory_taxonomy', 'save_ccategory_taxonomy_image', 10, 3 );
add_action( 'create_ccategory_taxonomy', 'save_ccategory_taxonomy_image', 10, 3 );

function create_custom_taxonomy2() {
    $args = array(
        'labels' => array(
            'name' => 'Tags',
            'singular_name' => 'Tag',
        ),
        'public' => true,
        'show_in_menu'       => false,
        'rewrite' => array('slug' => 'custom-tags'),
    );
    register_taxonomy('event_tag', 'event', $args);
}
add_action('init', 'create_custom_taxonomy2');
add_action("admin_menu", "events_Menu");

function events_Menu() {
     add_submenu_page("edit.php?post_type=event", "Event Dashboard", "Event Dashboard", 0, "get-event-menu", "event_start_page");
    add_submenu_page("edit.php?post_type=event", "Categories", "Categories", 0, "event-categories", "event_categories");
    add_submenu_page("edit.php?post_type=event", "Front Pages", "Front Pages", 0, "front-page", "event_front_page");
    add_submenu_page("edit.php?post_type=event", "Manage Events", "Manage Events", 0, "manage-events", "event_manage_events");
    add_submenu_page("edit.php?post_type=event", "Tags", "Tags", 0, "event-tags", "event_tags");
    //add_submenu_page("edit.php?post_type=event", "Preview Page", "Preview Page", 0, "preview-front-page", "event_preview_page");
   
}
require_once EVENTS_PATH . '/includes/class-events.php';

function get_EventTag(){
    global $wpdb;
    $table_name = $wpdb->prefix . 'events_tags';
    $get_results = $wpdb->get_results("SELECT * FROM $table_name");
    return $get_results;
}

function get_EventCategories(){
    global $wpdb;
    $table_name = $wpdb->prefix . 'events_main_category';
    $get_results = $wpdb->get_results("SELECT * FROM $table_name");
    return $get_results;
}

function get_EventSecondaryCategories($cat_id=NULL){
    global $wpdb;
    $table_name = $wpdb->prefix . 'events_secondary_category';
    //echo "SELECT * FROM $table_name where cat_id = $cat_id";
    $get_results = $wpdb->get_results("SELECT * FROM $table_name where cat_id = $cat_id");
    return $get_results;
}

function get_EventSubCategories($cat_id=NULL){
   
}

function event_start_page(){
	global $wpdb;
	$plugin = new Plugin_events();
	$plugin->events_dashboard();
}

function add_new_event(){
	global $wpdb;
	$plugin = new Plugin_events();
	$plugin->add_events();
}

function event_categories(){
	global $wpdb;
	$plugin = new Plugin_events();
	$plugin->event_categories();
}

function event_manage_events(){
	global $wpdb;
	$plugin = new Plugin_events();
	$plugin->event_manageevent();
}

function event_tags(){
    global $wpdb;
    $plugin = new Plugin_events();
    $plugin->event_tags();
}

function event_front_page(){
	global $wpdb;
	$plugin = new Plugin_events();
	$plugin->event_frontPage();
}

// function event_preview_page(){
//     global $wpdb;
//     $plugin = new Plugin_events();
//     $plugin->event_preview_page();
// }

// Event Date
function hcf_register_event_date() {
    add_meta_box( 'event-date-1', __( 'Event Dato', 'event' ), 'hcf_display_callback', 'event' );
}
add_action( 'add_meta_boxes', 'hcf_register_event_date' );


function hcf_display_callback( $post ) {
    include EVENTS_PATH . '/includes/custom-fields/event-date.php';
}
// Event Tag
function hcf_register_event_tag() {
    add_meta_box( 'event-tag-2', __( 'Tags:', 'event' ), 'event_tag_display_callback', 'event' );
}
add_action( 'add_meta_boxes', 'hcf_register_event_tag' );

function event_tag_display_callback( $post ) {
    include EVENTS_PATH . '/includes/custom-fields/event-tags-fields.php';
}

// Event Page Content
function hcf_register_event_page_content() {
    add_meta_box( 'event-content-3', __( 'Page Content', 'event' ), 'page_content_display_callback', 'event' );
}
add_action( 'add_meta_boxes', 'hcf_register_event_page_content' );

function page_content_display_callback( $post ) {
    include EVENTS_PATH . '/includes/custom-fields/event-page-content-fields.php';
}

// Event Option
function hcf_register_event_option() {
    add_meta_box( 'event-content-4', __( 'Event Options', 'event' ), 'event_option_display_callback', 'event' );
}
add_action( 'add_meta_boxes', 'hcf_register_event_option' );

function event_option_display_callback( $post ) {
    include EVENTS_PATH . '/includes/custom-fields/event-option-fields.php';
}

// Category Option
function hcf_register_event_category_option() {
    add_meta_box( 'event-content-5', __( 'Category', 'event' ), 'category_option_display_callback', 'event' );
}
add_action( 'add_meta_boxes', 'hcf_register_event_category_option' );

function category_option_display_callback( $post ) {
    include EVENTS_PATH . '/includes/custom-fields/event-category-fields.php';
}

// Save Post Function
function hcf_save_meta_box( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( $parent_id = wp_is_post_revision( $post_id ) ) {
        $post_id = $parent_id;
    }
    //echo "<pre>";print_r($_POST);die;
    $fields = [
        'event_tags',
        'ff_page',
        'option_category',
        'month',
        'year',
        'day',
        'nodate',
        'text_block_main',
        'content_title',
        'ticket_blocks',
        'block_photo',
        'programs_block',
        'program_block_title',
        'blocks_days',
        'select_website',
        'primary_category',
        'secondary_category',
        'save_text',
        'save_photo',
        'save_ticket',
        'save_program',
        'textcount',
    ];
    if(!isset($_POST['nodate'])){
            $_POST['nodate'] = 0;    
        }
    $ticketarray = array();
    $ticketarray['ticket_block']['tickettitle'] = $_POST['tickettitle'];
    $ticketarray['ticket_block']['ticketlink'] = $_POST['ticketlink'];
    $ticketarray['ticket_block']['ticketmonth'] = $_POST['ticketmonth'];
    $ticketarray['ticket_block']['ticketday'] = $_POST['ticketday'];
    $ticketarray['ticket_block']['ticketyear'] = $_POST['ticketyear'];
    $ticketarray['ticket_block']['tickethours'] = $_POST['tickethours'];
    $ticketarray['ticket_block']['ticketminutes'] = $_POST['ticketminutes'];
    $ticketarray['ticket_block']['ticketnodatenodate'] = $_POST['ticketnodatenodate'];
    $_POST['ticket_blocks'] = json_encode($ticketarray);
    // $_POST['ticketlink'] =  implode(',', $_POST['ticketlink']);
    // $_POST['ticketmonth'] =  implode(',', $_POST['ticketmonth']);
    // $_POST['ticketday'] =  implode(',', $_POST['ticketday']);
    // $_POST['ticketyear'] =  implode(',', $_POST['ticketyear']);
    // $_POST['tickethours'] =  implode(',', $_POST['tickethours']);
    // $_POST['ticketminutes'] =  implode(',', $_POST['ticketminutes']);
    // $_POST['ticketnodatenodate'] =  implode(',', $_POST['ticketnodatenodate']);
    // $_POST['block_day'] =  implode(',', $_POST['block_day']);
    // $_POST['timehours'] =  implode(',', $_POST['timehours']);
    // $_POST['timeminutes'] =  implode(',', $_POST['timeminutes']);

    $program_block = array();
    $program_block['program_block']['timehours'] = $_POST['timehours'];
    $program_block['program_block']['timeminutes'] = $_POST['timeminutes'];
    $program_block['program_block']['ticket_description'] = $_POST['ticket_description'];
    $_POST['programs_block'] = json_encode($program_block);

    $_POST['text_block_main'] = json_encode($_POST['text_block_main']);
    $_POST['block_photo'] = json_encode($_POST['block_photo']);

    // $block_days = array();
    // $block_days['block_days']['block_day'] = $_POST['block_day'];
    

    $fullarray = array();
    $keynum = 1;
    foreach ($_POST['block_day'] as $key => $value) {
        $timsss = $keynum."timehours";
        $timeminutes = $keynum."timeminutes";
        $ticket_description = $keynum."ticket_description";
        //echo $_POST[$timsss];
        $fullarray[] = array(
            'day'=>$value,
            $_POST[$timsss],
            $_POST[$timeminutes],
            $_POST[$ticket_description],
        );
       $keynum++;
    }
    $_POST['blocks_days'] = json_encode($fullarray);
    $_POST['save_text'] = json_encode($_POST['text']);
    $_POST['save_photo'] = json_encode($_POST['photo']);
    $_POST['save_ticket'] = json_encode($_POST['ticket']);
    $_POST['save_program'] = json_encode($_POST['program']);
      //echo "<pre>";print_r($_POST);die;
// die;
    //$primarycate = array();
    // for ($i=1; $i <= $_POST['textcount']; $i++) { 
    
        
    // }
   // die;
    //$primarycate['primarycategory']['primary_category'] = $_POST['primary_category'];
    $_POST['primary_category'] = implode(',', $_POST['primary_category']);
    //$_POST['primary_category'] = json_encode($primarycate);

    //$secondarycategory = array();
    //$secondarycategory['secondarycategory']['secondary_category'] = $_POST['secondary_category'];
    //$_POST['secondary_category'] = json_encode($secondarycategory);
    $_POST['secondary_category'] = implode(',', $_POST['secondary_category']);

    
    //echo "<pre>";print_r($_POST);die;
    foreach ( $fields as $field ){
        if ( array_key_exists( $field, $_POST ) ) {
            update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
        }
     }
}
add_action( 'save_post', 'hcf_save_meta_box' );

// function hcf_display_callback( $post ) {
//     include EVENTS_PATH . '/includes/custom-fields/event-date.php';
// }
//$getEvent_tag = get_EventTag()

//create tempate for search
add_filter( 'page_template', 'create_Template_For_Search' );
function create_Template_For_Search( $page_template )
{
    if ( is_page( 'events-search' ) ) {
         $page_template = dirname( __FILE__ ) . '/templates/events-search-template.php';
    }
    return $page_template;
}

function wpb_upcoming_posts($postid) { 
    //echo "<pre>";print_r($postid);die;
    // The query to fetch future posts
    $main_post = get_the_id();
    $the_query = new WP_Query(array( 
        'post_status' => 'future',
        'posts_per_page' => 10,
        'post_type'      => 'event',
        'orderby' => 'date',
        'order' => 'ASC'
    ));
 
// The loop to display posts
if ( $the_query->have_posts() ) {
    echo '<ul>';
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        //$output .= '<li>' . get_the_title() .' ('.  get_the_time('d-M-Y') . ')</li>';
        $post_id = get_the_ID();
      //echo  wp_get_shortlink($post_id, $context = 'post', $allow_slugs = true);

        if($main_post != $post_id){
        $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post_id) ); 
        $content = get_field('short_description');
        $output .= '<div class="event_list event_list_'.$post_id.'">
            <h3></h3>
            <div class="event_block">
            <div class="img"><img decoding="async" src="'.$feat_image.'" alt=""></div>
            <div class="desc">
            <h4>' . get_the_title() .'</h4>
            <p>' . $content .'</p>
            <p><a class="learn_more_link" href="'.get_post_permalink().'" target="" rel="noopener">Læs mere</a></p>
            </div>
            </div>
            </div>';
        }
    }
    echo '</ul>';
 
} else {
    // Show this when no future posts are found
    $output .= '<p>No posts planned yet.</p>';
}
 
// Reset post data
wp_reset_postdata();
 
// Return output
 
return $output; 
} 
// Add shortcode
add_shortcode('upcoming_posts', 'wpb_upcoming_posts'); 
// Enable shortcode execution inside text widgets
//add_filter('widget_text', 'do_shortcode');
function ccategory_taxonomy_template($template) {
    if (is_tax('ccategory_taxonomy')) { // Replace 'custom_taxonomy' with the slug of your custom taxonomy
        $new_template = plugin_dir_path(__FILE__) . 'templates/single-taxonomy-template.php'; // Replace 'templates/single-taxonomy-template.php' with the path to your custom template file

        if (file_exists($new_template)) {
            return $new_template;
        }
    }

    return $template;
}
add_filter('template_include', 'ccategory_taxonomy_template');

require_once EVENTS_PATH . '/includes/custom-function.php';