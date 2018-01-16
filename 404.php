<?php get_header(); ?>

	<main class="spine-single-template">

		<?php get_template_part( 'parts/headers' ); ?>

		<section class="row single gutter pad-top">

			<div class="column one">

				<article id="post-0" class="post error404 no-results not-found">

					<header class="article-header">
						<h1 class="article-title">404</h1><br>
						<h2 class="article-subtitle">Page Not Found</h2>
					</header>

					<div class="entry-content">
						<p>We&rsquo;re sorry. The page you were looking for may have been moved or deleted. Please feel free to search <a href="https://education.wsu.edu/">our site</a> to find what you were originally looking for. You can also <a href="mailto:education@wsu.edu">email us</a>.</p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->

				</article>

			</div><!--/column-->

		</section>

		<?php get_template_part( 'parts/footers' ); ?>

	</main>

<?php get_footer();
