<?php
global $url,$tpldir, $tel, $telFree, $address;
if(!isset($_GET['iframe'])): ?>

			<footer class="footer bg-dark cf" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">

				<div id="inner-footer" class="wrap wrap-full cf">

					<nav role="navigation">
						<?php wp_nav_menu(array(
    					'container' => 'div',                           // enter '' to remove nav container (just make sure .footer-links in _base.scss isn't wrapping)
    					'container_class' => 'footer-links cf',         // class of container (should you choose to use it)
    					'menu' => __( 'Footer Links', 'bonestheme' ),   // nav name
    					'menu_class' => 'nav footer-nav cf',            // adding custom nav class
    					'theme_location' => 'footer-links',             // where it's located in the theme
    					'before' => '',                                 // before the menu
    					'after' => '',                                  // after the menu
    					'link_before' => '',                            // before each link
    					'link_after' => '',                             // after each link
    					'depth' => 0,                                   // limit the depth of the nav
    					'fallback_cb' => 'bones_footer_links_fallback'  // fallback function
						)); ?>
					</nav>

					<div id="reserveTour">
						まずは気軽に見に来てください♪<br>
						<a href="<?php echo $tpldir; ?>/popup-form.php?type=reserveTour" class="form-ajax-popup btn__ghostWhite">WEBで見学申し込み</a>
					</div>

					<address class="footer-contact-info emboss">
						<ul class="block-link">
							<li class="author">
								<span class="approval"><?php echo bloginfo('description'); ?></span>
								<span class="name"><?php echo bloginfo('name'); ?></span>
							</li>
							<li class="address"><?php echo nl2br($address); ?></li>
							<li class="tel tel-free"><i class="fa fa-phone fa-fw"></i><?php echo $telFree; ?></li>
							<!-- <li class="tel"><i class="fa fa-phone fa-fw"></i><?php echo $tel; ?></li> -->
						</ul>
					</address>

					<?php echo createOriginalSBM($url); ?>
					<p class="source-org copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?> All Rights Reserved.</p>

				</div>

			</footer>

		</div>

		<?php // all js scripts are loaded in library/bones.php ?>
	<div id="outerClickLayer"></div>
	<a id="side-menu-trigger" href="javascript:void(0)"><i class="fa fa-list"></i></a>
	<div id="side-menu" class="bg-dark">
		<div class="sideMenu-buttons">
			<a href="javascript:void(0)" id="sideMenu-close"><i class="fa fa-angle-right"></i></a>
			<a href="javascript:void(0)" id="sideMenu-searchform-trigger"><i class="fa fa-search"></i></a>
		</div>
		<div id="side-searchform" class="emboss side-menu-widget">
		<?php get_search_form(); ?>
		</div>
		<div class="side-menu-body side-menu-widget">
		<?php wp_nav_menu(array(
			'menu' => 'side_menu',
			'container' => false,
			'menu_class' => 'side-nav'
		)); ?>
		</div>
	</div>
<?php endif; ?>
	<?php wp_footer(); ?>
