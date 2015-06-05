<?php use Roots\Sage\Extras; ?>

<div class="row" id="main">
	<div class="column grid_3">

<?php 

$contacts_id = Extras\get_ID_by_slug('contacts');
$parent_post = get_post( $post->post_parent );
if (is_page('contacts') || $post->post_parent ==  $contacts_id || $parent_post->post_parent == $contacts_id ) {
	wp_nav_menu( array('menu' => 'Contacts' ));
} else { ?>

<ul id="left-nav">

<li><?php echo '<a class="current" href="'.get_permalink($post->post_parent).'">'.get_the_title($post->post_parent).'</a>'; ?></li>

<!-- Subnav, use this for any sub navigation on the left hand column, copy and paste under any li you want a sub nav for. Place class="current" in the current sub nav a -->
 
	<?php echo wpb_list_child_pages(); ?>
	<ul>

</ul>

</ul>

<?php } ?>

      </div>
   	<div class="column grid_12" id="mid">
		<?php 
		global $post;
		$parents = get_post_ancestors( $post->ID );
		$id = ($parents) ? $parents[count($parents)-1]: $post->ID; 
		?>
		<?php if($id != get_the_ID()): ?>
			<h1><?= get_the_title( $id ); ?></h1>
			<h2><?php the_title(); ?></h2>
		<?php else: ?>
			<h1><?php the_title(); ?></h1>
		<?php endif; ?>

		

 		<?php the_content(); ?>
 	</div>
 </div>
