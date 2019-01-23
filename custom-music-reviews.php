<?php
/**
* Plugin Name: Reviews
* Plugin URI: https://www.homepower.tk/
* Description: A review plugin.
* Version: 1.0
* Author: Danyal Mehrbanilayegh
* Author URI: http://kindhand.ml/
**/

function register_cpt_review() {
 
    $labels = array(
        'name' => _x( 'Reviews', 'review' ),
        'singular_name' => _x( 'Review', 'review' ),
        'add_new' => _x( 'Add New', 'review' ),
        'add_new_item' => _x( 'Add New Review', 'review' ),
        'edit_item' => _x( 'Edit Review', 'review' ),
        'new_item' => _x( 'New Review', 'review' ),
        'view_item' => _x( 'View Review', 'review' ),
        'search_items' => _x( 'Search Reviews', 'review' ),
        'not_found' => _x( 'No reviews found', 'review' ),
        'not_found_in_trash' => _x( 'No reviews found in Trash', 'review' ),
        'parent_item_colon' => _x( 'Parent Review:', 'review' ),
        'menu_name' => _x( 'Reviews', 'review' ),
    );
 
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'reviews filterable by genre',
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes' ),
        'taxonomies' => array( 'genres' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-feedback',
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );
 
    register_post_type( 'music_review', $args );
}
 
add_action( 'init', 'register_cpt_review' );
 
function genres_taxonomy() {
    register_taxonomy(
        'genres',
        'review',
        array(
            'hierarchical' => true,
            'label' => 'Genres',
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'genre',
                'with_front' => false
            )
        )
    );
}
add_action( 'init', 'genres_taxonomy');


// Function used to automatically create Music Reviews page.
function create_review_pages()
  {
   //post status and options
    $post = array(
          'comment_status' => 'open',
          'ping_status' =>  'closed' ,
          'post_date' => date('Y-m-d H:i:s'),
          'post_name' => 'music_review',
          'post_status' => 'publish' ,
          'post_title' => 'Reviews',
          'post_type' => 'page',
    );
    //insert page and save the id
    $newvalue = wp_insert_post( $post, false );
    //save the id in the database
    update_option( 'mrpage', $newvalue );
  }
// // Activates function if plugin is activated
register_activation_hook( __FILE__, 'create_review_pages');
