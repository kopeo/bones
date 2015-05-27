<?php
global $post, $newPosts;

$args = array('posts_per_page' => 5);
$newPosts = get_posts($args);

?>
<?php get_header(); ?>

			<div id="content">

				<div class="topFeaturedPanel">
					<div class="owl-carousel">
						<img src="<?php echo $tpldir; ?>/images/slide01.jpg" alt="どこまでも一緒に。">
						<img src="<?php echo $tpldir; ?>/images/slide02.jpg" alt="一生懸命働きたいから">
						<img src="<?php echo $tpldir; ?>/images/slide03.jpg" alt="久しぶりに行ってみようか">
					</div>
					<ul class="topFeatured-articles hidden-phone">
					<?php
					global $newPosts;
					// $featured = wp_nav_menu(array('menu' => 'top_featured_pages' ,'echo' => false));
					// $featured = wp_get_nav_menu_object('top_featured_pages');
					$featured = wp_get_nav_menu_items(5);
					$format = '<li><a href="%1$s"><dl><dt><img src="%2$s" alt="%3$s"></dt><dd>%4$s</dd></dl></a></li>';
					foreach($featured as $key => $item):
						if($key > 4) break;
						switch($item->type):
							case 'post_type':
								$img = getPostImage($item->object_id);
								printf($format, $item->url, get_timThumbURL($img['url'], 180), $img['alt'], $item->title);
								break;
							case 'taxonomy':
								$img = get_category($item->object_id);
								printf($format, $item->url, get_timThumbURL($img->description,180), $item->title, $item->title);
								break;
						endswitch;
					endforeach;
					for($i = 0; $i + count($featured) < 4; $i++):
						$item = $newPosts[$i];
						$img = getPostImage($item);
						printf($format, get_permalink($item->ID), get_timThumbURL($img['url'], 180), $img['alt'], $item->post_title);
					endfor;
					?>
					</ul>
				</div>

				<div class="inner-header wrap cf hidden-phone">
					<nav class="frontPage-nav" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
						<?php wp_nav_menu(array(
    					         'container' => false,                           // remove nav container
    					         'container_class' => 'menu cf',                 // class of container (should you choose to use it)
    					         'menu' => __( 'The Main Menu', 'bonestheme' ),  // nav name
    					         'menu_class' => 'nav top-nav cf',               // adding custom nav class
    					         'theme_location' => 'main-nav',                 // where it's located in the theme
    					         'before' => '',                                 // before the menu
        			               'after' => '',                                  // after the menu
        			               'link_before' => '',                            // before each link
        			               'link_after' => '',                             // after each link
        			               'depth' => 0,                                   // limit the depth of the nav
    					         'fallback_cb' => ''                             // fallback function (if there is one)
						)); ?>
					</nav>
				</div>

				<div id="inner-content" class="wrap cf">

						<main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">

								<header class="article-header">

									<h1 class="h2 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
									<p class="byline entry-meta vcard">
                                                                        <?php printf( __( 'Posted', 'bonestheme' ).' %1$s %2$s',
                       								/* the time the post was published */
                       								'<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
                       								/* the author of the post */
                       								'<span class="by">'.__( 'by', 'bonestheme').'</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>'
                    							); ?>
									</p>

								</header>

								<section class="entry-content cf">
									<?php the_content(); ?>
								</section>

								<footer class="article-footer cf">
									<p class="footer-comment-count">
										<?php comments_number( __( '<span>No</span> Comments', 'bonestheme' ), __( '<span>One</span> Comment', 'bonestheme' ), __( '<span>%</span> Comments', 'bonestheme' ) );?>
									</p>


                 	<?php printf( '<p class="footer-category">' . __('filed under', 'bonestheme' ) . ': %1$s</p>' , get_the_category_list(', ') ); ?>

                  <?php the_tags( '<p class="footer-tags tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>


								</footer>

							</article>

							<?php endwhile; ?>

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
												<p><?php _e( 'This is the error message in the index.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>


						</main>

					<?php get_sidebar(); ?>

				</div>

			</div>
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />


<?php get_footer(); ?>
