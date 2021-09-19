<?php
/**
 * Plugin Name: SCOT Custom Plugin
 * Description: A plugin that creates Custom Post types and taxonomies.
 * Version: 1.0
 * Author: Tiffany Cissel
 * Author URI: tiffany-cissel.com
 */

// How to disable the single view for a custom post type?
// https://wordpress.stackexchange.com/questions/128636/how-to-disable-the-single-view-for-a-custom-post-type/145471

// Gutenberg block templates
// https://www.billerickson.net/gutenberg-block-templates/

 function register_scot_board_cpt() {
     $post_type = 'scot_board_member';
     $labels = array(
         'name' => 'SCOT Board Members',
         'singular_name' => 'SCOT Board Member',
         'add_new' => __( 'Add New Board Member','scot_twentyseventeen' ),
         'add_new_item' => __( 'Add New Board Member','scot_twentyseventeen' ),
         'edit_item' => __( 'Edit Board Member','scot_twentyseventeen' ),
         'new_item' =>  __( 'New Board Member','scot_twentyseventeen' ),
         'view_item' =>  __( 'View Board Member','scot_twentyseventeen' ),
         'view_items' =>  __( 'View Board Members','scot_twentyseventeen' ),
         'archives' =>  __( 'Board Member Archives','scot_twentyseventeen' ),
     );
     $args = array(
         'labels' => $labels,
         'description' => __( 'SCOT Board Member Profiles', 'scot_twentyseventeen' ),
         'public' => true,
         'show_ui' => true,
         'show_in_rest' => true,
         'menu_icon' => 'dashicons-id-alt',
         'map_meta_cap' => true,
         'supports' => array(
            'title', 
            'editor', 
            'thumbnail', 
            // 'custom-fields',
         ),
         'taxonomies' => array(
           'scot_board_clans'
         ),
         'has_archive' => true,
         'rewrite' => array(
            'slug' => 'board'
         ),
         'query_var' => false,
         'template' => array(
             array( 'core/paragraph', array(
                 'placeholder' => 'Add Biography...'
             ) )
         ),
         'template_lock' => 'all',
     );

     register_post_type( $post_type, $args );
 }
 add_action( 'init', 'register_scot_board_cpt' );

 function register_scot_board_clan_taxonomy() {
    $taxonomy = 'scot_board_clans';
    $object = 'scot_board_member';
    $keyword = 'Clan';
    $labels = array(
        'name' => 'Clans',
        'singular_name' => $keyword,
        'search_items' => $keyword.'s',
        'all_items' => 'All '.$keyword.'s',
        'edit_item' => 'Edit '.$keyword,
        'view_item' => 'View '.$keyword,
        'update_item' => 'Update '.$keyword,
        'add_new_item' => 'Add New '.$keyword,
        'new_item_name' => 'New '.$keyword.' Name',
        'add_or_remove_items' => 'Add or remove '.$keyword,
        'choose_from_most_used' => 'Choose from the most used '.$keyword,
    );
    $args = array(
        'labels' => $labels,
        'description' => __( 'Clans represented by Board Members', 'scot_twentyseventeen' ),
        'public' => false,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_in_quick_edit' => true,
        'query_var' => false,
    );

    register_taxonomy( $taxonomy, $object, $args );
 }
 add_action( 'init', 'register_scot_board_clan_taxonomy' );


 // Change Title Placeholder
 // https://wordpress.stackexchange.com/questions/195627/custom-post-type-title-placeholder

 function change_title_field_placeholder( $title, $post ) {
    if( $post->post_type === 'scot_board_member' ):
        $my_title = 'Add Name...';
        return $my_title;
    endif;

    return $title;
 }

 add_filter( 'enter_title_here', 'change_title_field_placeholder', 10, 2 );

 /**
 * Function Name: register_scot_newsletter_cpt
 * Description: Defines and registers the SCOT Newsletter custom post type.
 * Version: 1.0
 * Author: Tiffany Cissel
 * Author URI: tiffany-cissel.com
 */
function register_scot_newsletter_cpt() 
{
    $post_type = 'scot_newsletter';
    $labels = array(
        'name' => 'SCOT Newsletter Articles',
        'singular_name' => 'SCOT Newsletter Article',
        'add_new' => __( 'Add New Newsletter Article', 'scot_twentyseventeen' ),
        'add_new_item' => __( 'Add New Newsletter Article', 'scot_twentyseventeen' ),
        'edit_item' => __( 'Edit Newsletter Article', 'scot_twentyseventeen' ),
        'new_item' =>  __( 'New Newsletter Article', 'scot_twentyseventeen' ),
        'view_item' =>  __( 'View Newsletter Article', 'scot_twentyseventeen' ),
        'view_items' =>  __( 'View Newsletter Articles', 'scot_twentyseventeen' ),
        'archives' =>  __( 'Newsletter Article Archives', 'scot_twentyseventeen' ),
    );
    $args = array(
        'labels' => $labels,
        'description' => __( 'Great Scot Newsletter Articles', 'scot_twentyseventeen' ),
        'public' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-media-text',
        'map_meta_cap' => true,
        'supports' => array(
            'title', 
            'editor', 
            'thumbnail',
        ),
        'taxonomies' => array(
            'scot_newsletter_issue',
            'scot_newsletter_topic'
        ),
        'has_archive' => true,
        'rewrite' => array(
            'slug' => 'newsletter'
        ),
        'query_var' => false,
    );

    register_post_type($post_type, $args);
}
add_action('init', 'register_scot_newsletter_cpt');

/**
 * Function Name: register_scot_newsletter_issue_taxonomy
 * Description: Defines and registers the SCOT Newsletter "issue" custom taxonomy.
 * Version: 1.0
 * Author: Tiffany Cissel
 * Author URI: tiffany-cissel.com
 */
function register_scot_newsletter_issue_taxonomy() 
{
    $taxonomy = 'scot_newsletter_issue';
    $object = 'scot_newsletter';
    $keyword = 'Issue';
    $labels = array(
        'name' => $keyword,
        'singular_name' => $keyword,
        'search_items' => $keyword.'s',
        'all_items' => 'All '.$keyword.'s',
        'edit_item' => 'Edit '.$keyword,
        'view_item' => 'View '.$keyword,
        'update_item' => 'Update '.$keyword,
        'add_new_item' => 'Add New '.$keyword,
        'new_item_name' => 'New '.$keyword.' Name',
        'add_or_remove_items' => 'Add or remove '.$keyword,
        'choose_from_most_used' => 'Choose from the most used '.$keyword,
    );
    $args = array(
        'labels' => $labels,
        'description' => __( 'Issues of Great SCOT Newsletter', 'scot_twentyseventeen' ),
        'public' => false,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_in_quick_edit' => true,
        'query_var' => false,
    );

    register_taxonomy($taxonomy, $object, $args);
}
add_action('init', 'register_scot_newsletter_issue_taxonomy');


/**
 * Function Name: register_scot_newsletter_topic_taxonomy
 * Description: Defines and registers the SCOT Newsletter "topic" custom taxonomy for individual articles.
 * Version: 1.0
 * Author: Tiffany Cissel
 * Author URI: tiffany-cissel.com
 */
function register_scot_newsletter_topic_taxonomy() 
{
    $taxonomy = 'scot_newsletter_topic';
    $object = 'scot_newsletter';
    $keyword = 'Newsletter Topic';
    $labels = array(
        'name' => $keyword . 's',
        'singular_name' => $keyword,
        'search_items' => $keyword.'s',
        'all_items' => 'All '.$keyword.'s',
        'edit_item' => 'Edit '.$keyword,
        'view_item' => 'View '.$keyword,
        'update_item' => 'Update '.$keyword,
        'add_new_item' => 'Add New '.$keyword,
        'new_item_name' => 'New '.$keyword.' Name',
        'add_or_remove_items' => 'Add or remove '.$keyword,
        'choose_from_most_used' => 'Choose from the most used '.$keyword,
    );
    $args = array(
        'labels' => $labels,
        'description' => __( 'Topics of Great SCOT Newsletter Articles', 'scot_twentyseventeen' ),
        'public' => false,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_in_quick_edit' => true,
        'query_var' => false,
    );

    register_taxonomy($taxonomy, $object, $args);
}
add_action('init', 'register_scot_newsletter_topic_taxonomy');