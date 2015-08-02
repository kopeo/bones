<?php
global $post, $newPosts, $tpldir;

$args = array('posts_per_page' => 5);
$newPosts = get_posts($args);

?>
<?php get_header(); ?>

			<div id="content">

				<div class="topFeaturedPanel">
					<div class="wrap cf emboss emboss-radius">
						<div class="owl-carousel">
							<img src="<?php echo $tpldir; ?>/images/slide01.jpg" alt="どこまでも一緒に。">
							<img src="<?php echo $tpldir; ?>/images/slide02.jpg" alt="一生懸命働きたいから">
							<img src="<?php echo $tpldir; ?>/images/slide03.jpg" alt="久しぶりに行ってみようか">
						</div>
						<ul class="topFeatured-articles hidden-phone layout cf overLayer">
						<?php
						global $newPosts;
						// $featured = wp_nav_menu(array('menu' => 'top_featured_pages' ,'echo' => false));
						// $featured = wp_get_nav_menu_object('top_featured_pages');
						$featured = wp_get_nav_menu_items(5);
						$format = '<li><a href="%1$s"><dl class="overLayer-body"><dt><img src="%2$s" alt="%3$s"></dt><dd class="overLayer-target"><p>%4$s</p></dd></dl></a></li>';
						foreach($featured as $key => $item):
							if($key > 4) break;
							switch($item->type):
								case 'post_type':
									$img = getPostImage($item->object_id);
									printf($format, $item->url, get_timThumbURL($img['url'], 180), $img['alt'], $item->title);
									break;
								case 'taxonomy':
									$img = get_category($item->object_id);
									printf($format, $item->url, get_timThumbURL($tpldir .'/images/tax-' .$img->slug .'.png',180), $item->title, $item->title);
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
				</div>

				<div class="frontPage-nav-container hidden-phone">
					<nav class="frontPage-nav wrap cf" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
						<ul id="menu-head-1" class="nav top-nav cf">
							<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-21"><a href="<?php echo $url; ?>/advantages/"><i class="fa fa-exclamation"></i><br>特長</a></li>
							<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-22"><a href="<?php echo $url; ?>/plans/"><i class="fa fa-yen"></i><br>教習料金</a></li>
							<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-65"><a href="<?php echo $url; ?>/flow/"><i class="fa fa-graduation-cap"></i><br>教習の流れ</a></li>
							<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-167"><a href="<?php echo $url; ?>/short_course/"><i class="fa fa-book"></i><br>各種講習</a></li>
							<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-26"><a href="<?php echo $url; ?>/faq/"><i class="fa fa-question"></i><br>よくある質問</a></li>
							<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-27"><a href="<?php echo $url; ?>/staff/"><i class="fa fa-users"></i><br>スタッフ紹介</a></li>
						</ul>
					</nav>
				</div>

				<main id="main">
					<article id="top-point01" class="panel-container emboss-top emboss-radius">
						<div class="panel-body wrap cf">
							<header>
								<hgroup>
									<h1 class="h3">自分のスケジュールに合わせて</h1>
									<h3 class="h5">マイプラン制で焦らず自分のペースで免許取得</h3>
								</hgroup>
							</header>
							<div class="panel-sentence">
								<p>お客様のスケジュールに合わせて、<br>その都度指導員と話しながら受講できます。<br>急な予定変更にも柔軟に対応！</p>
							</div>
						</div>
					</article>

					<article id="top-groupDiscount" class="panel-container emboss-top emboss-radius">
						<div class="panel-body wrap cf panel-2col-right">
							<header>
								<hgroup>
									<h1 class="h3">一緒に取ろう</h1>
									<h3 class="h5">グループ割引、始まりました</h3>
								</hgroup>
							</header>
							<figure class="tCenter p-tab-60 p-desk-50">
								<img src="<?php echo $tpldir; ?>/images/home-image02-mb.jpg" alt="みんなと一緒に免許取得！" class="visible-phone">
							</figure>
							<div class="panel-sentence">
								<p>友人と、あるいはカップルで、<br>一緒に免許取得にチャレンジするとお得！<br>浮いたお金で打ち上げを♪</p>
								<p><img src="<?php echo $tpldir; ?>/images/home-image03.jpg" alt="最大10000円引き！" class="spacer"></p>
							</div>
						</div>
					</article>
				</main>

				<aside>
					<div id="top-news_calendar" class="panel-container emboss-top emboss-radius">
						<div class="panel-body wrap cf">
							<div class="news-body m-all t-2of3 d-3of4">
								<h3 class="h5"><i class="fa fa-bullhorn"></i><span>新着情報</span></h3>
								<ul class="newArticles-list">
								<?php foreach($newPosts as $p):
								// print_r($p);
								$format = '<li><dl class="cf"><dt>%1$s</dt><dd><a href="%2$s" title="%3$s">%3$s</a></dd></dl></li>';
								printf($format,
									date("Y年n月d日", strtotime($p->post_date)),
									get_permalink($p->ID),
									$p->post_title
								);
								endforeach; ?>
								</ul>
							</div>
							<div class="calendar-body m-all t-1of3 d-1of4">
								<h3 class="h5"><i class="fa fa-calendar"></i><span>教習カレンダー</span></h3>
								<div id="changeMonth">
									<a href="javascript:void(0)" id="prevMonth" class="changeMonth-item hide">&lt; 前月</a>
									<a href="javascript:void(0)" id="nextMonth" class="changeMonth-item">翌月 &gt;</a>
								</div>
								<?php echo do_shortcode('[business-calendar notooltip=true num=2]'); ?>
							</div>
						</div>
					</div>
				</aside>

			</div>

<?php get_footer(); ?>
