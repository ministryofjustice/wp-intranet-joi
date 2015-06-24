<?php

use Roots\Sage\Config;
use Roots\Sage\Wrapper;
use Roots\Sage\Extras;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <?php get_template_part('templates/head'); ?>
<body>
  <div id="wrapper">
    <!-- Top -->
    <div class="row">
      <!-- Header -->
      <div class="column grid_15" id="header">
        <div class="row">
          <!-- Logo -->
          <div class="column grid_9"><a href="index.htm"><img src="/wp-content/uploads/logo/new-intranet-logo-sm.png" border="0" alt="Judicial Office Intranet" /></a></div>
          <!-- Logo end -->
          <!-- Search -->
          <div class="column grid_4" id="search">
            <?php get_search_form(); ?>
          </div>
          <!-- Search end -->
        </div>
      </div>
      <!-- Header end -->

      <!-- Top navigation -->
      <!-- Top navigation end -->
    </div>
    <!-- Top end -->

    <!-- Main -->
    <div class="column grid_15" id="navigation">
    <?php
      $args = array(
        'container_id'    => 'cssmenu',
        'menu_class'      => '',
        'menu'            => 'Primary Navigation',
      );
      wp_nav_menu($args);
    ?>
    </div>
    <?php include Wrapper\template_path(); ?>
    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </div>
  <!-- *********** End of Wrapper *********** -->
</body>
</html>
