<?php use Roots\Sage\Extras; ?>

<?php get_template_part('templates/page', 'header'); ?>

<div class="row" id="main">

<!-- Left nav -->
<div class="column grid_3">
<?php $year = get_query_var('event_year');?>
<?php $month = get_query_var('event_year');?>
<ul id="menu-events" class="menu"><li id="menu-item-16173" class="menu-item"><a href="<?= get_site_url() . "/event/" . $year . "/" . date("J"); ?>/"><?= $year; ?> Events calendar</a></li>
<li class="menu-item <?php if(get_query_var( 'event_month' ) == 01) { echo " current-menu-item"; } ?>"><a href="<?= get_site_url() . "/event/" . $year; ?>/01">January</a></li>
<li class="menu-item <?php if(get_query_var( 'event_month' ) == 02) { echo " current-menu-item"; } ?>"><a href="<?= get_site_url() . "/event/" . $year; ?>/02">February</a></li>
<li class="menu-item <?php if(get_query_var( 'event_month' ) == 03) { echo " current-menu-item"; } ?>"><a href="<?= get_site_url() . "/event/" . $year; ?>/03">March</a></li>
<li class="menu-item <?php if(get_query_var( 'event_month' ) == 04) { echo " current-menu-item"; } ?>"><a href="<?= get_site_url() . "/event/" . $year; ?>/04">April</a></li>
<li class="menu-item <?php if(get_query_var( 'event_month' ) == 05) { echo " current-menu-item"; } ?>"><a href="<?= get_site_url() . "/event/" . $year; ?>/05">May</a></li>
<li class="menu-item <?php if(get_query_var( 'event_month' ) == 06) { echo " current-menu-item"; } ?>"><a href="<?= get_site_url() . "/event/" . $year; ?>/06">June</a></li>
<li class="menu-item <?php if(get_query_var( 'event_month' ) == 07) { echo " current-menu-item"; } ?>"><a href="<?= get_site_url() . "/event/" . $year; ?>/07">July</a></li>
<li class="menu-item <?php if(get_query_var( 'event_month' ) == 08) { echo " current-menu-item"; } ?>"><a href="<?= get_site_url() . "/event/" . $year; ?>/08">August</a></li>
<li class="menu-item <?php if(get_query_var( 'event_month' ) == 09) { echo " current-menu-item"; } ?>"><a href="<?= get_site_url() . "/event/" . $year; ?>/09">September</a></li>
<li class="menu-item <?php if(get_query_var( 'event_month' ) == 10) { echo " current-menu-item"; } ?>"><a href="<?= get_site_url() . "/event/" . $year; ?>/10">October</a></li>
<li class="menu-item <?php if(get_query_var( 'event_month' ) == 11) { echo " current-menu-item"; } ?>"><a href="<?= get_site_url() . "/event/" . $year; ?>/11">November</a></li>
<li class="menu-item <?php if(get_query_var( 'event_month' ) == 12) { echo " current-menu-item"; } ?>"><a href="<?= get_site_url() . "/event/" . $year; ?>/12">December</a></li>
</ul>
</div>
     <!-- Left nav end -->
     <!-- Mid section -->
     <div class="column grid_12" id="mid">
<h1>Events calendar </h1>
<?php
$date = DateTime::createFromFormat('!m', get_query_var('event_month'));
if(!empty($date)):
?>
<h2><?= $date->format('F') . " " . get_query_var('event_year'); ?></h2>
<?php endif; ?>

<div class="box">

<?php $query = Extras\event_query(); ?>

<?php if (!$query->have_posts()) : ?>
  
    <h3>No events for <?= $date->format('F') . " " . get_query_var('event_year'); ?>.</h3>
    <p>If you have any events to go on the JO Calendar please email the details to <a href="mailto:judicialwebupdates@judiciary.gsi.gov.uk">judicialwebupdates@judiciary.gsi.gov.uk</a>.</p>
    </div>
    <div class="cal">
<?php
  $year = get_query_var('event_year'); 
  $month = get_query_var( 'event_month' );
  $prev = date("Y/m", mktime(0, 0, 0, $month-1, 1, $year));
  $next = date("Y/m", mktime(0, 0, 0, $month+1, 1, $year));
?>
<div class="floatRight"><a href="<?= get_site_url() . "/event/" . $next; ?>">Next month</a> &gt;&gt;</div>
<div>&lt;&lt; <a href="<?= get_site_url() . "/event/" . $prev; ?>">Previous month</a> </div>
</div>


<?php endif; ?>
<?php $dategroup = null; ?>
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
<?php if ($query->have_posts()) : ?>


</div>

<div class="cal">
<?php
  $year = get_query_var('event_year'); 
  $month = get_query_var( 'event_month' );
  $prev = date("Y/m", mktime(0, 0, 0, $month-1, 1, $year));
  $next = date("Y/m", mktime(0, 0, 0, $month+1, 1, $year));
?>
<div class="floatRight"><a href="<?= get_site_url() . "/event/" . $next; ?>">Next month</a> &gt;&gt;</div>
<div>&lt;&lt; <a href="<?= get_site_url() . "/event/" . $prev; ?>">Previous month</a> </div>
</div>

<?php endif; ?>

</div>
</div>
</div>

