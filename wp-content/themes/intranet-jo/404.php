<?php get_template_part('templates/page', 'header'); ?>

	<div class="row" id="main">
		<div class="column grid_15">

			<div class="alert alert-warning">
			  <h1><?php _e('Sorry, but the page you were trying to view does not exist.', 'sage'); ?></h1>
				<p>It looks like this was the result of either:
					<ul>
					<li>a mistyped address</li>
					<li>an out-of-date link</li>
					</ul>
				</p>
			</div>

			<?php get_search_form(); ?>

		</div>

	</div>
