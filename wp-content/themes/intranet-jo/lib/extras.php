<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Config;
use Roots\Sage\CPT as CPT;

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

/**
 * Remove admin menus
 */
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

/**
 * Remove dashboard widgets
 */
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

/**
 * Remove filters for imported content
 */
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );

// READ THIS: https://github.com/jjgrainger/wp-custom-post-type-class/blob/master/README.md
$events = new CPT\CPT('event', array(
  'menu_icon'   => 'dashicons-calendar-alt',
  'supports' => false
));

$events->columns(array(
  'cb' => '<input type="checkbox" />',
  'title' => __('Title'),
  'event_date' => __('Event Date'),
  'date' => __('Publish Date')
));

$events->populate_column('event_date', function($column, $post) {
  echo get_field('date');
});

$events->sortable(array(
  'event_date' => array('date', true),
));

/**
 * Update events title to content for acf title field
 */
function update_events_title( $post_id ) {
  $current_post = get_post($post_id);
  $post['ID'] = $post_id;
  $post['post_title'] = substr(strip_tags(get_field('title'), $post_id), 0, 100);
  update_field('field_55659a7b0cbc1', strip_tags(get_field('field_55659a7b0cbc1', $post_id), "<a>"), $post_id);
  wp_update_post( $post );
}
add_action('acf/save_post', __NAMESPACE__ . '\\update_events_title', 20);

/**
 * Only allow link/unlink in events toolbar
 */
function toolbars( $toolbars )
{
  $toolbars['Simple' ] = array();
  $toolbars['Simple' ][1] = array('link' , 'unlink' );

  return $toolbars;
}
add_filter( 'acf/fields/wysiwyg/toolbars' , __NAMESPACE__ . '\\toolbars'  );
