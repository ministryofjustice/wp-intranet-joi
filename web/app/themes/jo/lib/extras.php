<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Config;
use Roots\Sage\CPT;

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return '';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

function custom_excerpt_length( $length ) {
  return 20;
}
add_filter( 'excerpt_length', __NAMESPACE__ . '\\custom_excerpt_length', 999 );

function nav_class($classes, $item){
     if( in_array('current-menu-item', $classes) ){
             $classes[] = 'active ';
     }
     return $classes;
}
add_filter('nav_menu_css_class' , __NAMESPACE__ . '\\nav_class' , 10 , 2);

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
 * Remove post menus
 */
function remove_post_menus() {
  remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category');
  remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');
}
add_action('admin_menu',  __NAMESPACE__ . '\\remove_post_menus');

/**
 * Remove post metaboxes
 */
function remove_post_metaboxes() {
  remove_meta_box( 'categorydiv','post','normal' );
  remove_meta_box( 'tagsdiv-post_tag','post','normal' );
}
add_action('admin_menu', __NAMESPACE__ . '\\remove_post_metaboxes');

/**
 * Remove filters for imported content
 */
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );

// READ THIS: https://github.com/jjgrainger/wp-custom-post-type-class/blob/master/README.md
$events = new CPT\CPT('event', array(
  'menu_icon'       => 'dashicons-calendar-alt',
  'supports'        => false,
  'has_archive'     => true,
  'rewrite'         => array(
    'slug'            =>  'calendar'
  ),
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
 * Add custom querys for events
 */
function add_custom_query_var( $vars ){
  $vars[] = "event_year";
  $vars[] = "event_month";
  return $vars;
}
add_filter( 'query_vars', __NAMESPACE__ . '\\add_custom_query_var' );

/**
 * Add custom rewrite rules
 */
function custom_rewrite() {
  add_rewrite_rule('^calendar/([0-9]+)/([0-9]+)/?', 'index.php?post_type=event&event_year=$matches[1]&event_month=$matches[2]', 'top');
}
add_action('init', __NAMESPACE__ . '\\custom_rewrite');

/**
 * Query for Events archive
 */
function event_query() {
  $event_year = get_query_var('event_year');
  if(empty($event_year)) {
    $event_year = date('Y');
  }

  $event_month = get_query_var('event_month');
  if(empty($event_month)) {
    $event_month = date('m');
  }

  $args = array(
    'post_type' => 'event',
    'meta_query' => array(
      array(
        'key'     => 'date',
        'value'   => $event_year . $event_month,
        'compare' => 'LIKE',
      ),
    ),
    'orderby'   => 'meta_value_num',
    'meta_key'  => 'date',
    'order'   => 'ASC',
    'posts_per_page' => -1
  );
  $query = new \WP_Query($args);
  return $query;
}

/**
 * Update events title to content for acf title field
 */
function update_events_title( $post_id ) {
  $current_post = get_post($post_id);
  if(get_post_type($post_id) == "event") {
    $post['ID'] = $post_id;
    $post['post_title'] = substr(strip_tags(get_field('title'), $post_id), 0, 100);
    $post['post_name'] = sanitize_title(substr(strip_tags(get_field('title'), $post_id), 0, 100));
    update_field('field_55659a7b0cbc1', strip_tags(get_field('field_55659a7b0cbc1', $post_id), "<a>"), $post_id);
    wp_update_post( $post );
  }
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

/**
 * Get ID by slug
 */
function get_ID_by_slug($page_slug) {
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
}

/**
 * Match a month to a link
 */
function month_match($url_month, $link_month) {
  $url_month = (int) $url_month;
  if($url_month == $link_month) {
    return "active";
  }
}

/**
 * Get the most top parent ID
 */
function get_top_parent_ID() {
  global $post;
  $parents = get_post_ancestors( $post->ID );
  $id = ($parents) ? $parents[count($parents)-1]: $post->ID;
  return $id;
}

/**
 * If URL has external link return it rather than permalink
 */
function replace_link($url) {
  $id = url_to_postid( $url );
  $link = get_field('link', $id);
  $post = get_post_type($id);
  if(!empty($id) && $post == "post" && !empty($link)) {
    $url = $link;
  }
  return $url;
}
add_filter('the_permalink', __NAMESPACE__ . '\\replace_link');


function special_nav_class($classes, $item){
  //var_dump($item);
  if( strpos(get_permalink(), $item->url) ){
    $classes[] = 'current-menu-item menu-item-has-children active ';
  }
  return $classes;
}
add_filter('nav_menu_css_class' , __NAMESPACE__ . '\\special_nav_class' , 10 , 2);

/**
 * Show all parents regardless of post status.
 * See: http://www.mightyminnow.com/2014/09/include-privatedraft-pages-in-parent-dropdowns/
 *
 * @param   array  $args  Original get_pages() $args.
 * @return  array  $args  Args set to also include posts with pending, draft, and private status.
 */
function dropdown_pages( $args ) {
  $args['post_status'] = array( 'publish', 'pending', 'draft', 'private' );
  return $args;
}
add_filter('page_attributes_dropdown_pages_args', __NAMESPACE__ . '\\dropdown_pages');
add_filter('quick_edit_dropdown_pages_args', __NAMESPACE__ . '\\dropdown_pages');
