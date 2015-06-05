<?php

use Roots\Sage\Extras;

get_template_part('templates/page', 'header');

$year = get_query_var('event_year');
if(empty($year) || $year == null) {
  $year = date("Y");
}
$month = get_query_var( 'event_month' );
if(empty($month) || $month == null) {
  $month = date("m");
}
$prev = date("Y/m", mktime(0, 0, 0, $month-1, 1, $year));
$next = date("Y/m", mktime(0, 0, 0, $month+1, 1, $year));
$date = DateTime::createFromFormat('!m', $month);
$query = Extras\event_query();

?>

<div class="row" id="main">
  <!-- Left nav -->
  <div class="column grid_3">
    <ul id="menu-events" class="menu">
      <li class="menu-item"><a href="<?= get_site_url(); ?>/calendar/"><?= $year; ?> Event Calendar</a></li>
      <?php for($i = 1; $i <= 12; $i++): $month_name = DateTime::createFromFormat('!n', $i); ?>
        <li class="menu-item<?= Extras\month_match($month, $i); ?>"><a href="<?= get_site_url() ?>/calendar/<?= $year; ?>/<?= sprintf("%02d", $i) ?>"><?= $month_name->format('F'); ?></a></li>
      <?php endfor; ?>
    </ul>
  </div>
  <!-- Left nav end -->

  <!-- Mid section -->
  <div class="column grid_12" id="mid">
  <h1>Events calendar </h1>
  <?php if(!empty($date)): ?>
    <h2><?= $date->format('F') . " " . $year ?></h2>
  <?php endif; ?>

  <div class="box">
    <?php if (!$query->have_posts()) : ?>
      <h3>No events for <?= $date->format('F') . " " . $year ?>.</h3>
      <p>If you have any events to go on the JO Calendar please email the details to <a href="mailto:judicialwebupdates@judiciary.gsi.gov.uk">judicialwebupdates@judiciary.gsi.gov.uk</a>.</p>
    <?php endif; ?>

    <?php if ($query->have_posts()) : $dategroup = null;  ?>
      <?php while ($query->have_posts()) : $query->the_post(); ?>
        <?php $postdate = get_field('date'); $date = DateTime::createFromFormat('d/m/Y', $postdate); ?>
        <?php if ( $postdate != $dategroup ): ?>
          <?php if(!empty($dategroup)): ?></ul><?php endif; ?>
          <h3><?= $date->format('l j'); ?></h3>
          <ul>
        <?php $dategroup = $postdate; endif; ?>
        <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
      <?php endwhile; ?>
      </ul>
    <?php endif; ?>
  </div>

  <div class="cal">
    <div class="floatRight"><a href="<?= get_site_url() . "/calendar/" . $next; ?>">Next month</a> &gt;&gt;</div>
    <div>&lt;&lt; <a href="<?= get_site_url() . "/calendar/" . $prev; ?>">Previous month</a> </div>
  </div>

</div>
</div>
</div>
