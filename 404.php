<?php get_header(); ?>

	<main class="spine-single-template">

		<?php get_template_part('parts/headers'); ?>

		<section class="row single gutter pad-top">

			<div class="column one">

				<article id="post-0" class="post error404 no-results not-found">

					<header class="article-header">
						<h1 class="article-title">Page Not Found</h1>
					</header>
					
					<div class="msg404">
					<h1>404 error?</h1>
					<h2>Cheer up!</h2>
					<h3>It could be worse&hellip;<br>you could look like <em><strong>this</strong></em> clown.</h3>
					</div>
					
					<div class="entry-content">
						<h5>We take your web experience seriously&mdash;even if we don't take ourselves seriously.</h5>
						<p>Please feel free to search <a href="https://education.wsu.edu/">our site</a> to find what you were originally looking for. You can also <a href="mailto:education@wsu.edu">email us</a>.</p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->

				</article>

			</div><!--/column-->

		</section>

		<?php get_template_part( 'parts/footers' ); ?>

	</main>

<?php get_footer(); ?>