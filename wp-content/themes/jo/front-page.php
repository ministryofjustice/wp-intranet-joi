<!-- ***********  Carousel/Slider *********** -->
<div id="content">
<?php if( have_rows('slides') ): ?>
<div id="slider2">
<ul>
  <?php while ( have_rows('slides') ) : the_row(); ?>
    <?php $image = wp_get_attachment_image_src(get_sub_field('image'), 'slides'); ?>
    <li><img src="<?= $image[0]; ?>" alt="<?= get_sub_field('title') ?>" border="0" class="FR" />
      <h2>
        <a href="<?= get_sub_field('link') ?>"><?= get_sub_field('title') ?></a>
      </h2>
      <p class="date"><?= get_sub_field('text') ?></p>
    </li>
  <?php endwhile; ?>
</ul>
</div>
<?php endif; ?>
<!-- *********** End of Carousel/Slider *********** -->
<!-- *********** Quicklinks *********** -->
<?php if( have_rows('quick_links') ): $i=1; ?>
<div id="divQuicklinks">
<h1>Quick Links</h1>
  <?php while ( have_rows('quick_links') ) : the_row(); ?>
    <?php if($i==1): ?><div class="right"><?php endif; ?>
    <h2><a href="<?= get_sub_field('link') ?>"><?= get_sub_field('title') ?></a></h2>
    <?php if($i==round(count(get_field('quick_links'))/2)): ?></div><?php endif; ?>
  <?php $i++; endwhile; ?>
</div>
<?php endif; ?>
<!-- *********** End of Quicklinks *********** -->
<!-- *********** Intranets and Internets *********** -->
<div id="sites">
<h1>Intranets and Internets</h1>
<?php if( have_rows('intranets_and_internets') ): ?>
  <div class="right">
    <h2>Intranets</h2>
    <?php while ( have_rows('intranets_and_internets') ) : the_row(); ?>
      <?php if(get_sub_field('type') == "Intranet"): ?>
        <h2><a href="<?= get_sub_field('link'); ?>" target="_blank"><?= get_sub_field('title'); ?></a></h2>
      <?php endif; ?>
    <?php endwhile; ?>
  </div>
<?php endif; ?>

<?php if( have_rows('intranets_and_internets') ): ?>
  <h2>Internets</h2>
  <?php while ( have_rows('intranets_and_internets') ) : the_row(); ?>
    <?php if(get_sub_field('type') == "Internet"): ?>
      <h2><a href="<?= get_sub_field('link'); ?>" target="_blank"><?= get_sub_field('title'); ?></a></h2>
    <?php endif; ?>
  <?php endwhile; ?>
<?php endif; ?>
</div>
<!-- *********** End of Intranets and Internets *********** -->
<!-- *********** 4 Pictures Area *********** -->
<?php if( have_rows('image_grid') ): ?>
<div class="divL4">
  <?php while ( have_rows('image_grid') ) : the_row(); ?>
    <?php $image = wp_get_attachment_image_src(get_sub_field('image'), 'image-grid'); ?>
    <div class="box2"><a href="<?= get_sub_field('link'); ?>"><img src="<?= $image[0]; ?>"  alt="<?= get_sub_field('title'); ?>" border="0"/></a></div>
  <?php endwhile; ?>
</div>
<?php endif; ?>
<!-- *********** End of 4 Pictures Area *********** -->
</div>
<!-- *********** End of Content *********** -->
<!-- ***********  News Area *********** -->
<?php
  $args = array(
    'post_type' => 'post',
    'posts_per_page' => 10
  );
  $query = new WP_Query( $args );
?>
<?php if($query->have_posts()): ?>
<div id="divNews" style="position: relative;">
<h1>What's New</h1>
<?php while ( $query->have_posts() ) : $query->the_post(); ?>
  <?php
  if (!empty(get_field('link'))) {
     $link = get_field('link');
    } else {
     $link = get_permalink();
    }
  ?>
  <h2><a href="<?= $link; ?>"><?= get_the_title( ); ?></a></h2>
  <p class="date"><?= get_the_date(); ?></p>
  <p><?= the_excerpt(); ?></p>
<?php endwhile; ?>
<h2><a href="/archived-news"><img src="/wp-content/uploads/homepage/news-archive.png" width="180" height="30" border="0" alt="News archive image" /></a></h2>
</div>
<?php endif; ?>
<!-- ***********  End of News Area *********** -->
