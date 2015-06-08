<?php

namespace Roots\Sage\Init;

use Roots\Sage\Assets;

/**
 * Theme setup
 */
function setup() {
  add_theme_support('title-tag');

  register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'sage')
  ]);

  add_image_size( 'slides', 350, 230, true );
  add_image_size( 'image-grid', 250, 124, true );

  //add_editor_style(trailingslashit(get_template_directory_uri()) . 'styles/editor-style.css');
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');
