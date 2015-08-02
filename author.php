<?php get_header();
wp_enqueue_style( 'pages',  $tpldir . "/css/pages.css");
$profItems = array(
	'from' => array(
		'title' => "出身",
		'icon' => "map-marker"
	),
	'policy' => array(
		'title' => "モットー",
		'icon' => "smile-o"
	),
	'favorite' => array(
		'title' => '好きな車・バイク',
		'icon' => "car"
	),
	'experience' => array(
		'title' => '職歴',
		'icon' => "graduation-cap"
	),
	'recommended' => array(
		'title' => 'おすすめのドライブポイント',
		'icon' => "thumbs-o-up"
	)
);
?>

			<div id="content">
				<div class="page-title-container">
				<?php
				the_archive_title( '<h1 class="page-title wrap"><span class="icon-container"><i class="fa fa-user fa-fw"></i></span><span class="name">', '</span></h1>' );
				// the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
				</div>

				<div id="inner-content" class="wrap cf">
					<main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
						<div class="inner-wrap">
							<?php
							// print_r ($wp_query->queried_object->data);
							$staff = $wp_query->queried_object->data;
							$prof = get_user_meta($staff->ID);
							?>
							<section id="<?php echo $staff->user_login; ?>" class="table-middle hentry cf staff-profile">
								<div class="left-column">
									<header class="article-header">
										<hgroup>
											<h5><?php echo $prof['job'][0]; ?></h5>
											<h1><?php echo $staff->display_name; ?></h1>
										</hgroup>
									</header>
									<figure>
										<img src="<?php echo $tpldir .'/images/staff-' .$staff->user_login .'.jpg'; ?>" alt="">
									</figure>
								</div>
								<div class="panel-sentence right-column">
									<dl class="prof-detail cf">
									<?php foreach($profItems as $key => $val):
										if($prof[$key][0]): ?>
										<dt class="<?php echo $key; ?>"><i class="fa fa-<?php echo $val['icon'] ;?> fa-fw"></i><?php echo $val['title']; ?></dt>
										<dd class="<?php echo $key; ?>"><?php echo $prof[$key][0]; ?></dd>
										<?php endif;
									endforeach; ?>
									</dl>
									<p class="message"><i class="fa fa-comment fa-fw"></i><?php echo $prof['description'][0]; ?></p>
								</div>
							</section>


						</div>
					</main>

					<?php get_sidebar(); ?>
				</div>

			</div>

<?php get_footer(); ?>
	</body>
</html> <!-- end of site. what a ride! -->
