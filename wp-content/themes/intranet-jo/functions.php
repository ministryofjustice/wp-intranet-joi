<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = array(
  'lib/utils.php',                 // Utility functions
  'lib/init.php',                  // Initial theme setup and constants
  'lib/wrapper.php',               // Theme wrapper class
  'lib/config.php',                // Configuration
  'lib/assets.php',                // Scripts and stylesheets
  'lib/titles.php',                // Page titles
  'lib/cpt.php',
  'lib/custom_fields.php',
  'lib/extras.php',                // Custom functions
);

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

/* Display child pages on parent page  */

function wpb_list_child_pages() {
  global $post;
  $string = "";
  if ( is_page() && $post->post_parent ) {
    $parent = get_post($post->post_parent);
    if ($parent->post_parent) {
      $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $parent->post_parent . '&echo=0' );
    } else {
      $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0' );
    }
  } else {
    $childpages = wp_list_pages( 'sort_column=menu_order&depth=1&title_li=&child_of=' . $post->ID . '&echo=0' );
  }

  if ( $childpages ) {
    $string = '<ul id="sub-nav">' . $childpages . '</ul>';
  }

  return $string;
}
