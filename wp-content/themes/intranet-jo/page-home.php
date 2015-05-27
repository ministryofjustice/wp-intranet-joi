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
<h2><a href="news/2015/marathon.htm">Michael Stewart Runs the Marathon</a></h2>
<p class="date">28 April 2015</p>
<p>Congratulations to Michael Stewart from the Communications Team, who ran the London Marathon on Sunday.</p>
<h2><a href="working_in/finance.htm">Changes to Invoices</a></h2>
<p class="date">28 April 2015</p>
Please note there is now a different address
for suppliers to send invoices to.
<h2><a href="news/2015/new-international-team.htm"><strong>New   International Team</strong></a></h2>
<p class="date">23 April 2015</p>
<p>The Judicial Office has   restructured the way it delivers its international support to a variety of   senior judges. </p>
<h2><a href="news/2015/eu-presidency.htm"><strong>Preparation for EU Presidency: Staff Skills   Survey</strong></a></h2>
<p class="date">23 April 2015</p>
<p>Complete the survey to register your interest in being involved in the preparation for EU Presidency in 2017.</p>
<h2><a href="news/2015/lcj-court-usher-tribute.htm">Judges Bid Farewell to Top Usher</a></h2>
<p class="date">21 April 2015</p>
<p>The Lord Chief Justice was joined by three former chief justices and other top judges in a unique tribute   to court usher Jean Fairs.</p>
<h2 sizset="65" sizcache="9"><a href="docs/agenda-jomb-28-april-2015.pdf">Judicial Office Management Board   draft agenda</a></h2>
<p class="date" sizset="65" sizcache="9">21 April 2015</p>
<p>Meeting on 28 April 2015</p>
<h2><a href="http://intranet.justice.gsi.gov.uk/news-features/corporate-updates/attendance-management-changes.htm">MoJ Corporate Update - New Attendance Management Policy</a></h2>
<p class="date">21 April 2015</p>
<h2 sizcache013395280703002998="5" sizset="20"><a href="news/2015/esta-dis.htm">Supporting disabled staff in MoJ: Esta&rsquo;s story</a></h2>
<p class="date" sizcache013395280703002998="5" sizset="20">21 April 2015</p>
<p sizcache013395280703002998="5" sizset="20">Esta Rooney is the Chair of the MoJ Disability Network, read her story.</p>
<h2 sizcache013395280703002998="5" sizset="20"><a href="news/2015/l-d-bite-size-csl.htm">'Bite-size' Learning Programme - CSL Awareness</a></h2>
<p class="date" sizcache013395280703002998="5" sizset="20">17 April 2015</p>
<p sizcache013395280703002998="5" sizset="20">Last spaces remaining for  1 hour 'bite-size' session on getting the most out of the the Civil Service Learning portal on 22 April.</p>
<h2 sizcache013395280703002998="5" sizset="20"><a href="news/2015/staff-expenses-problems-bec.htm"><strong>Staff Expenses &ndash; problems with Business Entity Codes</strong></a></h2>
<p class="date" sizcache013395280703002998="5" sizset="20">17 April 2015</p>
<p sizcache013395280703002998="5" sizset="20">Issues with  Business  Entity Code record in the re-configured iExpenses system on DOM1.</p>
<h2 sizcache013395280703002998="5" sizset="20"><a href="http://intranet.justice.gsi.gov.uk/news-features/calendar/11207.htm">Lunch &amp; Learn: Criminal Cases Review Commission</a></h2>
<p class="date" sizcache013395280703002998="5" sizset="20">16 April 2015</p>
<p sizcache013395280703002998="5" sizset="20">Discussion on the role of the CCRC on  22 April 2015. Book now.</p>
<h2 sizcache013395280703002998="5" sizset="20"><a href="news/2015/april-sums.htm">April Stand Up Meetings - Updated</a></h2>
<p class="date" sizcache013395280703002998="5" sizset="20">16 April 2015</p>
<p sizcache013395280703002998="5" sizset="20">Update: Judicial College SUM rescheduled to Wednesday  3:30pm.</p>
<h2 sizcache013395280703002998="5" sizset="20"><a href="http://intranet.justice.gsi.gov.uk/news-features/corporate-updates/merge-15.htm">MoJ Corporate Update - Phoenix open for financial and expense claims</a></h2>
<p class="date" sizcache013395280703002998="5" sizset="20">16 April 2015</p>
<h2 sizcache013395280703002998="5" sizset="20"><a href="news/2015/e-learning-expenses.htm"><strong>Staff Expenses &ndash; claiming and approving</strong></a></h2>
<p class="date" sizcache013395280703002998="5" sizset="20">16 April 2015</p>
<p sizcache013395280703002998="5" sizset="20">eLearning for  staff expenses is available on the Justice Academy.</p>
<h2 sizcache013395280703002998="5" sizset="20"><a href="news/2015/new-finance-forms.htm">New Finance Forms</a></h2>
<p class="date" sizcache013395280703002998="5" sizset="20">15 April 2015</p>
<p sizcache013395280703002998="5" sizset="20">New forms for use from 1 April 2015 are now available on the MOJ intranet - discard any forms used previously.</p>
<h2 sizcache013395280703002998="5" sizset="20"><a href="news/2015/bitesize-learning-wwj.htm">'Bite-size' Learning Programme - Working with Judges</a></h2>
<p class="date" sizcache013395280703002998="5" sizset="20">10 April 2015</p>
<p sizcache013395280703002998="5" sizset="20">Spaces are available for the latest series of seminars. In this session District Judge  Arbuthnot will be talking about  her role.</p>
<h2 sizcache013395280703002998="5" sizset="20">&nbsp;</h2>
<h2><a href="archived-news.htm"><img src="wp-content/uploads/news-archive.png" width="180" height="30" border="0" alt="News archive image" /></a></h2>
</div>
<!-- ***********  End of News Area *********** -->

<!-- *********** Twitter *********** -->
<br clear="all" />

