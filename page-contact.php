<?php
/*
Template Name: Contact
*/
global $privacypolic;
remove_filter('the_content', 'wpautop');
wp_enqueue_style( 'pages',  $tpldir . "/css/pages.css");

// {{SRC
wp_enqueue_script( 'script_contact',  $tpldir . "/js/scripts-contact.js", array('jquery', 'bones-common'), '', true);
// SRC}}

/* {{DEST
wp_enqueue_script( 'script_contact',  $tpldir . "/js/scripts-contact.min.js", array('jquery', 'bones-common'), '', true);
DEST}} */

get_header(); ?>

			<article id="content">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<header class="article-header emboss emboss-radius">

					<h1 class="page-title wrap" itemprop="headline"><?php the_title(); ?></h1>

				</header> <?php // end article header ?>

				<div id="inner-content" class="wrap cf">

						<main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
							<div class="inner-wrap">

								<ul class="form-nav layout cf">
									<li><a href="javascript:void(0)" id="trigger-contact" class="btn__blue" data-target="form_contact">お問い合わせ</a></li>
									<li><a href="javascript:void(0)" id="trigger-docRequest" class="btn__gray" data-target="form_docRequest">資料請求</a></li>
								</ul>

								<div id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

									<section class="entry-content cf" itemprop="articleBody">
										<div class="form-item form_contact">
										<?php echo do_shortcode('[contact-form-7 id="94" title="お問い合わせ"]'); ?>
										</div>
										<div class="form-item form_docRequest">
										<?php echo do_shortcode('[contact-form-7 id="95" title="資料請求"]'); ?>
										</div>
									</section> <?php // end article section ?>

									<?php $pp = get_post($privacypolicy); ?>
									<section id="privacypolicy" class="entry-content">
										<h5>プライバシーポリシー</h5>
										<div class="privacypolicy-container">
											<div class="privacypolicy-body">
											<?php echo do_shortcode($pp->post_content); ?>
											</div>
										</div>
									</section>

									<footer class="article-footer cf">

									</footer>

								</div>

							</div>
						</main>

						<?php get_sidebar(); ?>

				</div>

			<?php endwhile; endif; ?>
			</article>

<?php get_footer(); ?>
	</body>
</html> <!-- end of site. what a ride! -->
