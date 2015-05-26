<?php

namespace Roots\Sage\Assets;

function assets() {
  global $wp_styles;

  if ( is_page('home')) {
  wp_enqueue_style('styles-home', trailingslashit(get_template_directory_uri()) . "styles-home.css", false, null);
} else {
  wp_enqueue_style('added', trailingslashit(get_template_directory_uri()) . "added.css", false, null);
  wp_enqueue_style('grid', trailingslashit(get_template_directory_uri()) . "grid.css", false, null);
}
  wp_enqueue_style( 'ie7', trailingslashit(get_template_directory_uri()) . "ie7.css", false, null  );
  $wp_styles->add_data( 'ie7', 'conditional', 'IE 7' );
  wp_enqueue_style( 'print', trailingslashit(get_template_directory_uri()) . "print.css", false, null, 'print'  );
 wp_enqueue_script( 'jquery-1.4', get_template_directory_uri() . '/scripts/jquery-1.4.js', false, null );
 wp_enqueue_script( 'easySlider1-7', get_template_directory_uri() . '/scripts/easySlider1-7.js', false, null );
 wp_enqueue_script( 'searchbox', get_template_directory_uri() . '/scripts/searchbox.js', false, null );
}

add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);

function add_head() {
  echo '
<!-- Scripts -->
<script type="text/javascript">
    $(document).ready(function(){   
            $("#slider").easySlider({
                auto: true,
                continuous: true,
                nextId: "slider1next",
                prevId: "slider1prev"
            });
            $("#slider2").easySlider({ 
                numeric: true
            });
        }); 
    </script>' . "\n";
}
add_action( 'wp_head', __NAMESPACE__ . '\\add_head' );
