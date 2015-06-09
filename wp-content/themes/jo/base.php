<?php

use Roots\Sage\Config;
use Roots\Sage\Wrapper;
use Roots\Sage\Extras;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <?php get_template_part('templates/head'); ?>
  <body>
  <!-- Container -->
  <div class="row" id="container">
    <!-- Container column -->
    <div class="column grid_15">
      <?php
        do_action('get_header');
        get_template_part('templates/header');
      ?>
      <!-- Main -->
      <?php $menu = get_field('menu', Extras\get_top_parent_ID()); ?>

      <?php if (Config\display_sidebar() && !empty($menu) && is_nav_menu($menu)) : ?>

        <div class="row" id="main">
          <?php include Wrapper\sidebar_path(); ?>
          <!-- Mid section -->
          <div class="column grid_9" id="mid">
            <?php include Wrapper\template_path(); ?>
          </div>
          <!-- Mid section end -->
          <?php include_once( 'templates/sidebar_right.php' ); ?>
        </div>

      <?php elseif (Config\display_sidebar()) : ?>

        <div class="row" id="main">
          <?php include Wrapper\sidebar_path(); ?>
          <!-- Mid section -->
          <div class="column grid_12" id="mid">
            <?php include Wrapper\template_path(); ?>
          </div>
          <!-- Mid section end -->
        </div>

      <?php elseif (!empty($menu) && is_nav_menu($menu)) : ?>
        <div class="row" id="main">
          <!-- Mid section -->
          <div class="column grid_12" id="mid">
            <?php include Wrapper\template_path(); ?>
          </div>
          <!-- Mid section end -->
          <?php include_once( 'templates/sidebar_right.php' ); ?>
        </div>

      <?php else: ?>

        <div class="row" id="wide">
          <?php include Wrapper\template_path(); ?>
        </div>

      <?php endif; ?>
      <!-- Main end -->
    </div>
    <!-- Container column end -->
  </div>
  <!-- Container ends -->
  <!-- Footer -->
  <?php
    do_action('get_footer');
    get_template_part('templates/footer');
    wp_footer();
  ?>
  <!-- Footer end -->
  </body>
</html>
