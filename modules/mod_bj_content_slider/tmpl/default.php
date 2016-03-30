<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

if($category_id == 0) {
	echo "No category is choosen.";
	return;
}

$contents = modBJContentSlider::getContent($category_id, $item_count, $order_by);

$mosConfig_live_site = JUri::base();
$MODULE_URL = $mosConfig_live_site . 'modules/mod_bj_content_slider';
$MODULE_THEME = $MODULE_URL . '/media/themes/' . $theme;

$icons = explode(",",$icons);

$document = &JFactory::getDocument();
$document->addStyleSheet($MODULE_THEME.'/'.$theme.'.css');
?>
<script type="text/javascript">
var cssText = '.venus-contentslider{height:<?php echo ($slider_height + 20);?>px;}.venus-contentslider .bj-contentslider-contents,.venus-contentslider .bj-contentslider-contents .bj-contentslider-content,.venus-contentslider .bj-contentslider-contents .bj-contentslider-content-current{height:<?php echo $slider_height + 10; ?>px;}';

<?php if($load_style){?>
cssText = '.venus-contentslider{height:<?php echo ($slider_height + 40);?>px;}.venus-contentslider .bj-contentslider-contents,.venus-contentslider .bj-contentslider-contents .bj-contentslider-content,.venus-contentslider .bj-contentslider-contents .bj-contentslider-content-current{height:<?php echo $slider_height; ?>px;}';
cssText = '.cbb{padding:0 10px;border:1px solid #666;background:#F9F9F9;}.bt{height:57px;margin:0 0 0 58px;background:url(<?php echo $MODULE_THEME;?>/box.png) no-repeat 100% 0;}.bt div{position:relative;left:-58px;width:58px;height:57px;background:url(<?php echo $MODULE_THEME;?>/box.png) no-repeat 0 0;font-size:0;line-height:0;}.bb{height:6px;margin:0 0 0 4px;background:url(<?php echo $MODULE_THEME;?>/box.png) no-repeat 100% 100%;}.bb div {position:relative;left:-4px;width:4px;height:6px;background:url(<?php echo $MODULE_THEME;?>/box.png) no-repeat 0 100%;font-size:0;	line-height:0;}.i1 {padding:0 0 0 4px;background:url(<?php echo $MODULE_THEME;?>/borders_left.png) repeat-y 0 0;}.i2 {padding:57px 4px 0 0;	background:#F9F9F9 url(<?php echo $MODULE_THEME;?>/borders_right.png) repeat-y 100% 0;}.i3 {display:block;margin:-100px 0 0 0;padding:1px 10px;}i3:after{content:".";display:block;height:0;clear:both;visibility:hidden;}.i3 {display:inline-block;}.i3 {display:block;}'+ cssText;
<?php }?>

/*
var ref = document.createElement('style');
ref.setAttribute("rel", "stylesheet");
ref.setAttribute("type", "text/css");
document.getElementsByTagName("head")[0].appendChild(ref);
ref.styleSheet.cssText = cssText ;//this one's for ie
	*/	
// fix for ie 7
if(jQuery.browser.msie){
	var ref = document.createElement('style');
	ref.setAttribute("rel", "stylesheet");
	ref.setAttribute("type", "text/css");
	document.getElementsByTagName("head")[0].appendChild(ref);
	ref.styleSheet.cssText = cssText ;

	if(jQuery.browser.version == "7.0"){
		var cssText = '* html .i1,* html .i2 {background-image:url(borders.gif);}* html .bt,* html .bt div,* html .bb,* html .bb div {background-image:url(box.gif);}* html .i1,* html .i3 {height:1px;}.one {width:70%;}';
		var ref = document.createElement('style');
		ref.setAttribute("rel", "stylesheet");
		ref.setAttribute("type", "text/css");
		document.getElementsByTagName("head")[0].appendChild(ref);
		ref.styleSheet.cssText = cssText ;
	}
} else {
	var ref = document.createElement('style');
	ref.setAttribute("type", "text/css");
	document.getElementsByTagName("head")[0].appendChild(ref);
	jQuery(ref).html(cssText);
}
</script>
<?php $id = rand(0,1000);

$current = "";
?>

<div id="BJ_ContentSlider_<?php echo $id;?>" class="cbb hide">
<div class="<?php echo $theme;?>-contentslider">
	<ul class="bj-contentslider-titles">
		<?php for($i = 0; $i < count($contents); $i++) {?>
		<li class="bj-contentslider-title">
			<?php 		if($i == 0) $current = "current";
						else $current = "";
			?>
			<a href="#BJ_ContentSlider_<?php echo $id;?>_<?php echo $contents[$i]->id; ?>" class="<?php echo $current;?>" title="<?php echo $contents[$i]->title;?>"><span><?php echo $contents[$i]->title;?></span></a>
		</li>
		<?php }?>
	</ul>
	<div class="bj-contentslider-contents">
		<?php for($i = 0; $i < count($contents); $i++) {
			$text = $contents[$i]->introtext;
			if($i == 0) $current = "-current";
			else $current = "";
		?>
		<div id="BJ_ContentSlider_<?php echo $id;?>_<?php echo $contents[$i]->id;?>" class="bj-contentslider-content<?php echo $current;?>">
			<?php echo $text;?>
		</div>
		<?php }?>
	</div>
</div>
</div>
	
<?php 

if (!defined('_BJ_CONTENTSLIDER_FUNC_INCLUDED')) {
	define('_BJ_CONTENTSLIDER_FUNC_INCLUDED', 1);
	
if($need_jquery){?>
<script type="text/javascript" src="<?php echo $MODULE_URL;?>/media/js/jquery-1.4.2.js">
</script>
<script type="text/javascript">
jQuery.noConflict();
</script>
<?php
}?>
<script type="text/javascript">
if(typeof jQuery == 'undefined') alert('JQuery is needed. Please choose to load JQuery at BJ Content Slider module backend');
</script>
<script type="text/javascript" src="<?php echo $MODULE_URL;?>/media/js/jquery-contentslider.js"></script>
<?php }?>
<script type="text/javascript">
jQuery(document).ready(function($) {
		$("#BJ_ContentSlider_<?php echo $id;?>").bj_contentslider({roller_interval:<?php echo $roller_interval;?>,load_style:<?php echo $load_style;?>});
		$("#BJ_ContentSlider_<?php echo $id;?>").removeClass("hide");
	});
</script>
<!-- END CONTENT SLIDER -->