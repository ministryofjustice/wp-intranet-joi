<!-- Right column -->
<div class="column grid_3" id="right">
  <!-- Widget -->
  <div class="widget">
    <h3>Further information...</h3>
    <div class="widget-content">
      <?php
        $args = array(
          'menu'            => $menu,
          'fallback_cb'    => false
        );
      ?>
      <?php wp_nav_menu( $args ); ?>
    </div>
  </div>
  <!-- Widget end -->
</div>
<!-- Right column end -->
