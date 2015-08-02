<?php remove_filter('the_content', 'wpautop'); ?>
<?php get_header(); ?>

			<div id="content">
				<div class="page-title-container">
				<h1 class="archive-title wrap"><span class="icon-container"><i class="fa fa-file-o fa-fw"></i></span><span><?php _e( 'Search Results for:', 'bonestheme' ); ?></span> <?php echo esc_attr(get_search_query()); ?></h1>
				</div>

				<div id="inner-content" class="wrap cf">
					<main id="main" class="m-all t-2of3 d-5of7 cf" role="main">
						<div class="inner-wrap">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article">

								<header class="entry-header article-header">

									<h3 class="h2 search-title entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

									<p class="byline entry-meta vcard">
										<?php printf( '<time class="updated hidden-phone" datetime="%1$s" itemprop="datePublished">%2$s</time>', get_the_time('Y-m-j'), get_the_time('n月<\sp\a\n>j</\sp\a\n>Y')); ?>
										<?php printf( '<time class="updated visible-phone" datetime="%1$s" itemprop="datePublished">%2$s</time>', get_the_time('Y-m-j'), get_the_time(get_option('date_format'))); ?>
									</p>

								</header>

								<section class="entry-content">
										<?php the_excerpt( '<span class="read-more">' . __( 'Read more &raquo;', 'bonestheme' ) . '</span>' ); ?>

								</section>

								<footer class="article-footer">

									<?php if(get_the_category_list(', ') != ''): ?>
                  					<?php printf( 'カテゴリ： %1$s', get_the_category_list(', ') ); ?>
                  					<?php endif; ?>

                 					<?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>

								</footer> <!-- end article footer -->

							</article>

						<?php endwhile; ?>

								<?php bones_page_navi(); ?>

							<?php else : ?>

									<article id="post-not-found" class="hentry cf">
										<header class="article-header">
											<h1><?php _e( 'Sorry, No Results.', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Try your search again.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the search.php template.', 'bonestheme' ); ?></p>
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
