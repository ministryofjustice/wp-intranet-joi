<?php

namespace Roots\Sage\Assets;

function assets() {
  global $wp_styles;
  if ( is_page(5)) {
  wp_enqueue_style('styles-home', trailingslashit(get_template_directory_uri()) . "styles-home.css", false, null);
} else {
  wp_enqueue_style('added', trailingslashit(get_template_directory_uri()) . "added.css", false, null);
  wp_enqueue_style('grid', trailingslashit(get_template_directory_uri()) . "grid.css", false, null);


}
 wp_enqueue_script( 'jquery-1.4', get_template_directory_uri() . '/scripts/jquery-1.4.js', false, null );
 wp_enqueue_script( 'easySlider1-7', get_template_directory_uri() . '/scripts/easySlider1-7.js', false, null );
 wp_enqueue_script( 'searchbox', get_template_directory_uri() . '/scripts/searchbox.js', false, null );
}

add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);

function add_head() {
  echo '<!-- Styles -->
<link href="print.css" rel="stylesheet" type="text/css" media="print" />

<!--[if IE 7]>
    <link rel="stylesheet" type="text/css" href="ie7.css">
<![endif]-->
<!-- Styles end -->
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
