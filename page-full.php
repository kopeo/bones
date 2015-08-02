<?php
/*
Template Name: Page Full
*/
remove_filter('the_content', 'wpautop');
// wp_enqueue_script( 'carousel',  $tpldir . "/js/owl.carousel.min.js", array('jquery'), '', true);
wp_enqueue_style( 'pages',  $tpldir . "/css/pages.css");

$id = get_the_ID();
$script = get_post_meta($id, 'js', true);
if ($script) {
	// googleMap APIが必要な場合の処理
	if ($script == 'aboutus') {
		wp_enqueue_script("googleMap", "https://maps.googleapis.com/maps/api/js", array('bones-common'), '', true );
// {{SRC
		wp_enqueue_script("googleMap-jQuery", $tpldir ."/js/jquery.googlemap.js", array('jquery', 'googleMap'), '', true );
		wp_enqueue_script("aboutus", $tpldir ."/js/scripts-aboutus.js", array('jquery', 'googleMap-jQuery'), '', true );
// SRC}}
/* {{DEST
		wp_enqueue_script("aboutus", $tpldir ."/js/scripts-aboutus.min.js", array('jquery', 'googleMap'), '', true );
DEST}} */
	} else {
		// 通常のJSファイル読み込み
		wp_enqueue_script("page" .$id, $tpldir ."/js/" .$script, array('jquery', 'bones-common'), '', true );
	}
}

get_header(); ?>

			<article id="content">

				<header class="article-header emboss emboss-radius">
					<h1 class="page-title wrap" itemprop="headline"><?php the_title(); ?></h1>
				</header> <?php // end article header ?>

				<div id="inner-content">

						<main id="main" class="m-all t-all d-all cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<div id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<section class="entry-content cf" itemprop="articleBody">
									<?php
										// the content (pretty self explanatory huh)
										the_content();

										/*
										 * Link Pages is used in case you have posts that are set to break into
										 * multiple pages. You can remove this if you don't plan on doing that.
										 *
										 * Also, breaking content up into multiple pages is a horrible experience,
										 * so don't do it. While there are SOME edge cases where this is useful, it's
										 * mostly used for people to get more ad views. It's up to you but if you want
										 * to do it, you're wrong and I hate you. (Ok, I still love you but just not as much)
										 *
										 * http://gizmodo.com/5841121/google-wants-to-help-you-avoid-stupid-annoying-multiple-page-articles
										 *
										*/
										wp_link_pages( array(
											'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'bonestheme' ) . '</span>',
											'after'       => '</div>',
											'link_before' => '<span>',
											'link_after'  => '</span>',
										) );
									?>
								</section> <?php // end article section ?>

							</div>

							<?php endwhile; endif; ?>

						</main>

				</div>

			</article>

<?php get_footer(); ?>
	</body>
</html> <!-- end of site. what a ride! -->
