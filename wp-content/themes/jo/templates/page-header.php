<?php use Roots\Sage\Titles; ?>

<?php
  global $post;
  $parents = get_post_ancestors( $post->ID );
  $id = ($parents) ? $parents[count($parents)-1]: $post->ID;
?>
<?php if(is_home()): ?>
  <h1>News Archive</h1>
<?php elseif($id != get_the_ID()): ?>
  <h1><?= get_the_title( $id ); ?></h1>
  <h2><?php the_title(); ?></h2>
<?php else: ?>
  <h1><?php the_title(); ?></h1>
<?php endif; ?>
