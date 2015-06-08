<?php

namespace Roots\Sage\Assets;

function assets() {
  global $wp_styles;

  if(is_front_page()) {
    wp_enqueue_style('styles-home', trailingslashit(get_template_directory_uri()) . 'css/styles-home.css', false, null);
  } else {
    wp_enqueue_style('print', trailingslashit(get_template_directory_uri()) . 'css/print.css', false, null, 'print');
    wp_enqueue_style('grid', trailingslashit(get_template_directory_uri()) . 'css/grid.css', false, null);
    wp_enqueue_style('added', trailingslashit(get_template_directory_uri()) . 'css/added.css', false, null);
  }
  wp_enqueue_style( 'ie7', trailingslashit(get_template_directory_uri()) . 'css/ie7.css', false, null  );
  $wp_styles->add_data( 'ie7', 'conditional', 'IE 7' );
  wp_enqueue_style( 'ie6', trailingslashit(get_template_directory_uri()) . 'css/ie6.css', false, null  );
  $wp_styles->add_data( 'ie6', 'conditional', 'IE 6' );
  wp_enqueue_script( 'jquery-1.4', trailingslashit(get_template_directory_uri()) . 'scripts/jquery-1.4.js', false, null );
  wp_enqueue_script( 'easySlider1-7', trailingslashit(get_template_directory_uri()) . 'scripts/easySlider1-7.js', false, null );
  wp_enqueue_script( 'searchbox', trailingslashit(get_template_directory_uri()) . 'scripts/searchbox.js', false, null );
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);

function add_head() { ?>
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
</script>
<?php }
add_action( 'wp_head', __NAMESPACE__ . '\\add_head' );
