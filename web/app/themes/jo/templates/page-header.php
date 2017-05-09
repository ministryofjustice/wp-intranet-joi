<?php

use Roots\Sage\Titles;
use Roots\Sage\Extras;

$id = Extras\get_top_parent_ID();

?>
<?php if(is_home()): ?>
  <h1>News Archive</h1>
<?php elseif($id != get_the_ID() && !is_search()): ?>
  <h1><?= get_the_title( $id ); ?></h1>
  <h2><?= Titles\title(); ?></h2>
<?php else: ?>
  <h1><?= Titles\title(); ?></h1>
<?php endif; ?>
