<?php

use Roots\Sage\Extras;

$year = get_query_var('event_year');
if(empty($year) || $year == null) {
  $year = date("Y");
}
$month = get_query_var( 'event_month' );
if(empty($month) || $month == null) {
  $month = date("m");
}

?>
<!-- Left nav -->
<div class="column grid_3">
<?php if(is_post_type_archive('event')): ?>
<ul id="left-nav">
  <li class="current"><a href="<?= get_site_url(); ?>/calendar/"><?= $year; ?> Event Calendar</a></li>
  <ul id="sub-nav">
  <?php for($i = 1; $i <= 12; $i++): $month_name = DateTime::createFromFormat('!n', $i); ?>
    <li class="<?= Extras\month_match($month, $i); ?>"><a href="<?= get_site_url() ?>/calendar/<?= $year; ?>/<?= sprintf("%02d", $i) ?>"><?= $month_name->format('F'); ?></a></li>
  <?php endfor; ?>
  </ul>
</ul>
<?php else: ?>
  <?php
  $parent = array_reverse(get_post_ancestors($post->ID));
  $first_parent = get_page($parent[0]);
  if(is_nav_menu($first_parent->post_title)):
    $args = array(
      'menu'            => $first_parent->post_title,
      'container_id'    => 'sub-nav',
      'fallback_cb'    => false
    );
    ?>
    <ul id="left-nav">
      <li><a href="/<?= $first_parent->post_name; ?>" class="current"><?php echo $first_parent->post_title; ?></a></li>
      <?php wp_nav_menu( $args ); ?>
    </ul>
  <?php else: ?>
    <ul id="left-nav">
      <li><a href="/<?= $first_parent->post_name; ?>" class="current"><?php echo $first_parent->post_title; ?></a></li>
      <ul id="sub-nav">
        <?php $args = array(
          'authors'      => '',
          'child_of'     => $first_parent->ID,
          'date_format'  => get_option('date_format'),
          'depth'        => 2,
          'echo'         => 1,
          'exclude'      => '',
          'include'      => '',
          'link_after'   => '',
          'link_before'  => '',
          'post_type'    => 'page',
          'post_status'  => 'publish',
          'show_date'    => '',
          'sort_column'  => 'menu_order, post_title',
          'sort_order'   => '',
          'title_li'     => false
        ); ?>
        <?php wp_list_pages( $args ); ?>
      </ul>
    </ul>
  <?php endif; ?>
<?php endif; ?>
</div>
<!-- Left nav end -->
