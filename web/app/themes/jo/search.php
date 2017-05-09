<?php get_template_part('templates/page', 'header'); ?>

<?php if (!have_posts()) : ?>
  <p><?php _e('Sorry, no results were found.', 'sage'); ?></p>
<?php endif; ?>

<p style="margin: 2em 0;">
  <?php
  $moj_search = 'https://intranet.justice.gov.uk/search-results/all/%s/';
  $query = urlencode(get_search_query(false));
  $moj_search = sprintf($moj_search, $query);
  ?>
  Can't find what you're looking for?
  <a href="<?php echo esc_attr($moj_search); ?>">Search again on the MoJ Intranet.</a>
</p>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', 'search'); ?>
<?php endwhile; ?>

<?php the_posts_navigation(); ?>
