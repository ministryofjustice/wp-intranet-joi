<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Config;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

function remove_menus(){
  //remove_menu_page( 'index.php' );                  //Dashboard
  //remove_menu_page( 'edit.php' );                   //Posts
  //remove_menu_page( 'upload.php' );                 //Media
  //remove_menu_page( 'edit.php?post_type=page' );    //Pages
  remove_menu_page( 'edit-comments.php' );          //Comments
  //remove_menu_page( 'themes.php' );                 //Appearance
  //remove_menu_page( 'plugins.php' );                //Plugins
  //remove_menu_page( 'users.php' );                  //Users
  //remove_menu_page( 'tools.php' );                  //Tools
  //remove_menu_page( 'options-general.php' );        //Settings
}
add_action( 'admin_menu', __NAMESPACE__ . '\\remove_menus' );

function remove_dashboard_meta() {
  //remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
  //remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
  //remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
  //remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
  remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
  //remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
  //remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
  //remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
  //remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
}
add_action( 'admin_init', __NAMESPACE__ . '\\remove_dashboard_meta' );

remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );
