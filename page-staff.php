<?php
/*
Template Name: Staff Infroduction
*/
global $tpldir, $url;
remove_filter('the_content', 'wpautop');

// {{SRC
wp_enqueue_script("staff", $tpldir ."/js/scripts-staff.js", array('jquery', 'bones-common'), '', true );
// SRC}}

/* {{DEST
wp_enqueue_script("staff", $tpldir ."/js/scripts-staff.min.js", array('jquery', 'bones-common'), '', true );
DEST}} */

wp_enqueue_style( 'pages',  $tpldir . "/css/pages.css");
get_header(); ?>

			<div id="content">

				<div id="inner-content">

						<main id="main" class="m-all t-all d-all cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<div id="profile-container" class="panel-container emboss emboss-radius loader">
									<i class="fa fa-spinner fa-spin"></i>
									<div class="ajax-container wrap cf">
										<div class="billboard table-middle panel-2col-left">
											<div class="panel-body wrap inner-wrap">
												<header class="article-header">
													<h1 class="page-title" itemprop="headline"><span class="icon-container"><i class="fa fa-users"></i></span><?php the_title(); ?></h1>
												</header> <?php // end article header ?>
												<figure><img src="<?php echo $tpldir; ?>/images/bg-panel-staff-mb.jpg" alt="担当指導員がしっかりサポート" class="visible-phone"></figure>
												<div class="panel-sentence">
													<p>高瀬自動車学校は専属担当制です。<br>あなたの専属指導員が、全教習を責任を持って指導します。</p>
													<p>教習ごとに指導員が変わることがありませんので、安心して受講することが出来ます。</p>
												</div>
											</div>
										</div>
									</div>
								</div>
								<section class="staffList-container">
								<?php
								$staffs = get_users(array(
									'role' => 'author',
									'orderby' => 'ID'
								));
								if (!is_wp_error($staffs)): ?>
									<ul id="staffList" class="layout cf img-group">
										<?php foreach($staffs as $staff):
										$img = $tpldir .'/images/staff-' .$staff->user_login .'-thumb.jpg';
										$format = '<li><a href="%1$s" data-id="%2$s" class="ajax-popup"><img src="%3$s" alt="%4$s" data-large="%5$s"></a></li>';
										printf($format,
											$url .'/author/' .$staff->user_login. '/?iframe=true',
											$staff->ID,
											get_timThumbURL($img, 260),
											$staff->display_name,
											$img
										);
										endforeach; ?>
									</ul>
								<?php endif; ?>
								</section>
								<section class="entry-content cf emboss-top" itemprop="articleBody">
									<?php
										// the content (pretty self explanatory huh)
										the_content();
										wp_link_pages( array(
											'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'bonestheme' ) . '</span>',
											'after'       => '</div>',
											'link_before' => '<span>',
											'link_after'  => '</span>',
										) );
									?>
								</section> <?php // end article section ?>

							</article>

							<?php endwhile; endif; ?>

						</main>

				</div>

			</div>

<?php get_footer(); ?>
	</body>
</html> <!-- end of site. what a ride! -->
