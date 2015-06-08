<?php while (have_posts()) : the_post(); ?>
  <h1 class="entry-title"><?php the_title(); ?></h1>
  <?php get_template_part('templates/entry-meta'); ?>
  <?php the_content(); ?>
<?php endwhile; ?>
