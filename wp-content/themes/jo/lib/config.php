<?php

namespace Roots\Sage\Config;

use Roots\Sage\ConditionalTagCheck;
use Roots\Sage\Extras;

/**
 * Define which pages shouldn't have the sidebar
 */
function display_sidebar() {
  static $display;

  if (!isset($display)) {
    $conditionalCheck = new ConditionalTagCheck(
      /**
       * Any of these conditional tags that return true won't show the sidebar.
       * You can also specify your own custom function as long as it returns a boolean.
       *
       * To use a function that accepts arguments, use an array instead of just the function name as a string.
       *
       * Examples:
       *
       * 'is_single'
       * 'is_archive'
       * ['is_page', 'about-me']
       * ['is_tax', ['flavor', 'mild']]
       * ['is_page_template', 'about.php']
       * ['is_post_type_archive', ['foo', 'bar', 'baz']]
       *
       */
      [
        'is_404',
        'is_front_page',
        ['is_page_template', 'template-custom.php'],
        'is_search',
        'is_single',
        'is_home',
        __NAMESPACE__ . '\\no_children'
      ]
    );

    $display = apply_filters('sage/display_sidebar', $conditionalCheck->result);
  }

  return $display;
}

/**
 * Don't display sidebar if there are no children.
 */
function no_children() {
  global $post;
  $children = get_pages('child_of='.Extras\get_top_parent_ID());
  if(get_post_type($post->ID) == "page") {
    if(count($children) > 0) {
      return false;
    } else {
      return true;
    }
  }
}
