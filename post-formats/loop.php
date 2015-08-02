<?php
$has_thumb = has_post_thumbnail();
?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">

								<header class="entry-header article-header">
									<h3 class="h2 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
									<p class="byline entry-meta vcard">
										<?php printf( '<time class="updated hidden-phone" datetime="%1$s" itemprop="datePublished">%2$s</time>', get_the_time('Y-m-j'), get_the_time('n月<\sp\a\n>j</\sp\a\n>Y')); ?>
										<?php printf( '<time class="updated visible-phone" datetime="%1$s" itemprop="datePublished">%2$s</time>', get_the_time('Y-m-j'), get_the_time(get_option('date_format'))); ?>
									</p>
								</header>

								<section class="entry-content cf">
									<?php if($has_thumb): ?>
									<figure><?php the_post_thumbnail( 'bones-thumb-300' ); ?></figure>
									<?php endif; ?>

									<?php the_excerpt(); ?>

								</section>

								<footer class="article-footer">

										<?php printf( '<p class="footer-category">カテゴリ：'. ': %1$s</p>' , get_the_category_list(', ') ); ?>
	                 					<?php the_tags( '<p class="footer-tags tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>

								</footer>

							</article>