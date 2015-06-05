<!-- ***********  Carousel/Slider *********** -->
<div id="content">
<div id="slider2">		
<ul>
	<?php
	if( have_rows('slider') ):
	    while ( have_rows('slider') ) : the_row(); ?>
		<li><img src="<?php the_sub_field('slide_image'); ?>" alt="<?php the_sub_field('slide_title') ?>" border="0" class="FR" />
			<h2>
				<a href="<?php the_sub_field('slide_link') ?>"><?php the_sub_field('slide_title') ?></a>
			</h2>
			<p class="date"><?php the_sub_field('slide_text') ?></p>
		</li>
	<?php endwhile;
	else :
	endif; ?>
</ul>			
</div>

<!-- *********** End of Carousel/Slider *********** -->
<!-- *********** Quicklinks *********** -->
<div id="divQuicklinks">
<h1><?php the_field('quicklinks_heading'); ?></h1>       
<ul>
<?php
	if( have_rows('quicklinks') ):
	    while ( have_rows('quicklinks') ) : the_row(); ?>
		<li>
			<h2>
				<a href="<?php the_sub_field('quicklink_link') ?>"><?php the_sub_field('quicklink_text') ?></a>
			</h2>
		
		</li>


	<?php endwhile;
	else :
	endif; ?>
</ul>
</div>
<!-- *********** End of Quicklinks *********** -->
<!-- *********** Intranets and Internets *********** -->
<div id="sites">
<h1><?php the_field('intranets_and_internets_heading'); ?></h1>
<div class="right">
<h2><?php the_field('intranets_heading'); ?></h2>
<?php
	if( have_rows('intranets') ):
	    while ( have_rows('intranets') ) : the_row(); ?>
		<h2><a href="<?php the_sub_field('intranets_link'); ?>" target="_blank"><?php the_sub_field('intranets_text'); ?></a></h2>
	<?php endwhile;
	else :
	endif; ?>
</div>
<h2><?php the_field('internets_heading'); ?></h2>
<?php
	if( have_rows('internets') ):
	    while ( have_rows('internets') ) : the_row(); ?>
		<h2><a href="<?php the_sub_field('internets_link'); ?>" target="_blank"><?php the_sub_field('internets_text'); ?></a></h2>
	<?php endwhile;
	else :
	endif; ?>
</div>
<!-- *********** End of Intranets and Internets *********** -->
<!-- *********** 4 Pictures Area *********** -->
<br clear="all" />
<div class="divL4">
<ul>

<?php
	if( have_rows('four_pictures') ):
	    while ( have_rows('four_pictures') ) : the_row(); ?>
		<li>			
			<a href="<?php the_sub_field('4_pictures_link'); ?>"><img src="<?php the_sub_field('4_pictures_image'); ?>"  alt="<?php the_sub_field('4_pictures_alt_text'); ?>"/></a> 
		</li>


	<?php endwhile;
	else :
	endif; ?>



</ul>
</div>
<!-- *********** End of 4 Pictures Area *********** -->
</div>
<!-- *********** End of Content *********** -->
<!-- ***********  News Area *********** -->
<div id="divNews" style="position: relative;">
<h1>What's New</h1>


<?php
	// Get meta value containing array of entries
	$latest_news_args = array(
		'post_type' => 'post',
		'posts_per_page' => 30
	);
	$latest_news_query = new WP_Query( $latest_news_args );
	// Iterate over entries and display
	while ( $latest_news_query->have_posts() ) : $latest_news_query->the_post();
		?>
		<h2><a href="
		<?php if (get_field('external_file_or_link'))
		{
		 echo get_field('external_file_or_link'); 
		}
		else {
		 echo the_permalink();
		}
		?>
		"><?php the_title(); ?></a></h2>

			<p class="date">
			 <time class="published" datetime="<?php echo get_the_time( 'c' ); ?>"><?php echo get_the_date(); ?></time>
			</p>
			<?php the_excerpt(); ?>


			<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>

<!-- <h2><a href="news/2015/marathon.htm">Michael Stewart Runs the Marathon</a></h2>
<p class="date">28 April 2015</p> -->

<h2><a href="newsarchive"><img src="wp-content/uploads/news-archive.png" width="180" height="30" border="0" alt="News archive image" /></a></h2>
</div>
<!-- ***********  End of News Area *********** -->

<!-- *********** Twitter *********** -->
<br clear="all" />

