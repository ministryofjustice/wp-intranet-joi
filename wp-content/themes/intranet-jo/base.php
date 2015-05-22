<?php

use Roots\Sage\Config;
use Roots\Sage\Wrapper;

?>

<?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
    <?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>
  <div class="row" id="main">
    <div class="column grid_15">
    <?php include Wrapper\template_path(); ?>
    </div>
  </div>
    <?php
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </body>
</html>
