<?php

namespace Roots\Sage\Assets;

function assets() {
  global $wp_styles;
  wp_enqueue_style('global2', trailingslashit(get_template_directory_uri()) . "global2.css", false, null);
  wp_enqueue_style('global', trailingslashit(get_template_directory_uri()) . "global.css", false, null);
  $wp_styles->add_data( 'global', 'conditional', 'lt IE 6' );  
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);

function add_head() {
  echo '<!--[if IE 6]> 
<style>
body
{background: #fff url(docs/infobg-ie.gif) repeat-y}
</style>
<![endif]-->
<link href="/wp-content/themes/intranet-lawcom/print.css" rel="stylesheet" type="text/css" media="print" />

<script language="JavaScript">
<!--
function openWin(URL) {
aWindow=window.open(URL, "thewindow", "toolbar=no, width=600, height=500, status=no, scrollbars=yes, resize=no, menubar=no");
}
//-->
</script>' . "\n";
}
add_action( 'wp_head', __NAMESPACE__ . '\\add_head' );
