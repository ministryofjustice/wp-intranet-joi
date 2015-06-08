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
$prev = date("Y/m", mktime(0, 0, 0, $month-1, 1, $year));
$next = date("Y/m", mktime(0, 0, 0, $month+1, 1, $year));
$date = DateTime::createFromFormat('!m', $month);
$query = Extras\event_query();

?>
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
