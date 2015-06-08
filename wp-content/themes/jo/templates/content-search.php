<h2><a href="<?php the_permalink(); ?>"><strong><?php the_title(); ?></strong></a></h2>
<?php if (get_post_type() === 'post') { get_template_part('templates/entry-meta'); } ?>
<p><?php the_excerpt(); ?></p>
