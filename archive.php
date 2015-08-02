<?php get_header(); ?>

			<div id="content">
				<div class="page-title-container">
				<?php
				the_archive_title( '<h1 class="page-title wrap"><span class="icon-container"><i class="fa fa-folder-o fa-fw"></i></span>', '</h1>' );
				// the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
				</div>

				<div id="inner-content" class="wrap cf">
					<main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
						<div class="inner-wrap">


							<?php if (have_posts()) : while (have_posts()) : the_post();
							get_template_part('post-formats/loop');
							endwhile; ?>

									<?php bones_page_navi(); ?>

							<?php else : ?>

									<article id="post-not-found" class="hentry cf">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the archive.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div>
					</main>

					<?php get_sidebar(); ?>
				</div>

			</div>

<?php get_footer(); ?>
	</body>
</html> <!-- end of site. what a ride! -->
