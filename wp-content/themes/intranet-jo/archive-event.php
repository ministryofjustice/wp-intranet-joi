<?php use Roots\Sage\Extras; ?>

<?php get_template_part('templates/page', 'header'); ?>

<div class="row" id="main">

<!-- Left nav -->
<div class="column grid_3">
<?php wp_nav_menu( array('menu' => 'Events' )); ?>                                            
</div>
     <!-- Left nav end -->          
     <!-- Mid section -->
     <div class="column grid_12" id="mid">
<h1>Events calendar </h1>
<h2><? echo date('F Y'); ?></h2>

<div class="box">

<?php $query = Extras\event_query(); ?>

<?php if (!$query->have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
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

<?php if ($query->have_posts()) : ?>
  </ul>
<?php endif; ?>

<?php the_posts_navigation(); ?>

</div>

</div>

</div>

