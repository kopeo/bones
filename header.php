<?php
global $tpldir, $telFree;
?>
<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<?php // force Internet Explorer to use the latest rendering engine available ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title><?php wp_title(''); ?></title>

		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1"/>

		<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<?php // or, set /favicon.ico for IE10 win ?>
		<meta name="msapplication-TileColor" content="#496cbd">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">
            <meta name="theme-color" content="#aee9ed">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>

		<?php // drop Google Analytics Here ?>
		<?php // end analytics ?>

<!--OGP開始-->
<meta property="fb:app_id" content="397248400475372" />
<meta property="og:locale" content="ja_JP">
<meta property="og:type" content="blog">
<?php
if (is_single()){// 投稿記事
     if(have_posts()): while(have_posts()): the_post();
          echo '<meta property="og:description" content="'.str_replace( array("\r\n", "\r", "\n"),'',mb_substr(get_the_excerpt(), 0, 100)).'">';echo "\n";//抜粋から
     endwhile; endif;
     echo '<meta property="og:title" content="'; the_title(); echo '">';echo "\n";//投稿記事タイトル
     echo '<meta property="og:url" content="'; the_permalink(); echo '">';echo "\n";//投稿記事パーマリンク
} else {//投稿記事以外（ホーム、カテゴリーなど）
     echo '<meta property="og:description" content="'; bloginfo('description'); echo '">';echo "\n";//「一般設定」で入力したブログの説明文
     echo '<meta property="og:title" content="'; bloginfo('name'); echo '">';echo "\n";//「一般設定」で入力したブログのタイトル
     echo '<meta property="og:url" content="'; bloginfo('url'); echo '">';echo "\n";//「一般設定」で入力したブログのURL
}
?>
<meta property="og:site_name" content="<?php bloginfo('name'); ?>">
<?php
$img['flag'] = false;
if (is_single() || is_page()){//投稿記事か固定ページの場合
	$img = getPostImage($post, 'midium');
	if ($img['flag']) {
		echo '<meta property="og:image" content="'.$img['url'].'">';echo "\n";
	}
}
if( !$img['flag'] ){
	echo '<meta property="og:image" content="' .$tpldir .'/images/fb-ogp.jpg">';echo "\n";
}
?>
<!--OGP完了-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-65259363-1', 'auto');
  ga('send', 'pageview');

</script>
	</head>

	<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

		<div id="container">
<?php if(!isset($_GET['iframe'])): ?>
			<header class="header" role="banner" itemscope itemtype="http://schema.org/WPHeader">
				<div class="inner-header wrap cf">
					<div class="head-branding wrap cf">
						<div class="head-branding-body m-all t-1of3 d-3of8">
						<?php // to use a image just replace the bloginfo('name') with your img src and remove the surrounding <p> ?>
							<p id="discription"><?php echo bloginfo('description'); ?></p>
							<p id="logo" class="h1" itemscope itemtype="http://schema.org/Organization"><a href="<?php echo home_url(); ?>" rel="nofollow"><?php bloginfo('name'); ?></a></p>
						</div>

						<div class="head-download m-all t-1of3 d-3of8">
							<a href="<?php echo $url; ?>/contact/" class="btn__blue">資料請求・お問合せ</a>
						</div>

						<div class="head-contact m-all t-1of3 d-1of4 last-col">
							<span class="phoneNumber"><i class="fa fa-phone"></i><?php echo $telFree; ?></span>
							営業時間：8:30〜18:20
						</div>
					</div>

					<nav class="head-nav wrap cf" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
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
			</header>
<?php endif; ?>