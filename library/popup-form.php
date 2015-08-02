<?php
global $tel, $privacypolicy;
require('../../../../wp-load.php');
// global $post;
$type = 'ppolicy';
if (isset($_GET['type'])) $type = $_GET['type'];
switch ($type) {
	case 'inquiry':
		$formID = 4; //98; //133
		break;
	case 'order':
		$formID = 6; //99; //134
		break;
	default:
		$formID = 82; //4; //55
}
// selectボックスのデフォルト値をajax load:callback経由で渡すために、タグにセットしておく
// 残りの作業はscripts-common.jsにて
if (isset($_GET['id'])) $id = ' data-default="' . get_the_title((int)$_GET['id']) . '"';
?>
<div class="popup-body wrap <?php echo $type;?>"<?php echo $id; ?>>
	<div class="inner-wrap entry-content">
		<div class="form-body <?php echo $type; ?>-form-body">
<?php
if (!isset($_GET['pp']) || $_GET['pp'] !== 'true') {
$js01 = plugins_url() ."/contact-form-7/includes/js/jquery.form.min.js";
$js02 = plugins_url() ."/contact-form-7/includes/js/scripts.js";
$HTML = do_shortcode('[contact-form-7 id="' .$formID .'" html_class="use-floating-validation-tip"]');
$HTML = str_replace($_SERVER['SCRIPT_NAME'], "/product/s01/", $HTML);
echo $HTML;
// form actionのURLを修正
if ($type != 'order'):
?>
		</div>
<h5>お電話でのお問い合わせは</h5>
<p class="popup-tel"><i class="fa fa-phone"></i> <?php echo $tel; ?></p>
<?php endif;
$pp = get_post($privacypolicy);
}?>
<section id="privacypolicy">
	<h5>プライバシーポリシー</h5>
	<div class="privacypolicy-container">
		<div class="privacypolicy-body">
		<?php echo do_shortcode($pp->post_content); ?>
		</div>
	</div>
</section>
	</div>
</div>