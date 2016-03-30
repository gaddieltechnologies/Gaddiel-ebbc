<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

if($category_id == 0) {
	echo "No category is choosen.";
	return;
}

$contents = modBJContentTabHelper::getContent($category_id, $items, $item_count, $order_by);

$mosConfig_live_site = JUri::base();
$MODULE_URL = $mosConfig_live_site . '/modules/mod_bj_content_tab';

$icons = explode(",",$icons);
?>
<?php $id = rand(0,1000);
if($type == 'tabber'){
?>
<?php 
if (!defined('_BJ_NEWSTABBER2_FUNC_INCLUDED')) {
	define('_BJ_NEWSTABBER2_FUNC_INCLUDED', 1);

if($need_jquery){?>
<script type="text/javascript" src="<?php echo $MODULE_URL;?>/media/js/jquery-1.4.2.js">
</script>
<script type="text/javascript">
jQuery.noConflict();
</script>
<?php
}
$document = &JFactory::getDocument();
$document->addStyleSheet($MODULE_URL.'/media/css/jquery-ui.css');
$document->addStyleSheet($MODULE_URL.'/media/themes/'.$theme.'/'.$theme.'.css');
?>
<script type="text/javascript">
//<![CDATA[
if(jQuery.browser.msie){
	if(jQuery.browser.version == "7.0"){
		var cssText = '.venus-tabs ul li a .left,.venus-tabs ul.ui-tabs-nav li.ui-state-active a .left{margin-top:1px}.panel-container .corner-bl,.panel-container .corner-br{bottom:-18px}';
		var ref = document.createElement('style');
		ref.setAttribute("rel", "stylesheet");
		ref.setAttribute("type", "text/css");
		document.getElementsByTagName("head")[0].appendChild(ref);
		ref.styleSheet.cssText = cssText ;//this one's for ie
	}
}

if(jQuery.browser.opera){
	var cssText = '';
	var sheet = document.createElement('style');
	sheet.innerHTML = ".venus-tabs ul.ui-tabs-nav li.ui-state-active a .left{margin:-9px 0 0 -11px;}.venus-tabs ul li a .left{margin:-9px 0 0 -11px;}.venus-tabs ul li a .right{right:-6px;";
	document.body.appendChild(sheet);
}

if(typeof jQuery == 'undefined') alert('JQuery is needed. Please choose to load JQuery at BJ! Content Tab module backend');
// ]]>
</script>
<script type="text/javascript" src="<?php echo $MODULE_URL;?>/media/js/jquery-ui.js"></script>
<?php }?>
<div id="BJ_NewsTabber_<?php echo $id;?>" class="<?php echo $theme;?>-tabs hide">
	<ul>
		<?php for($i = 0; $i < count($contents); $i++) {
			echo '<li'. ($i < count($icons) ? " class=\"" . $icons[$i] . "\"" : "") .'><a class="'. ($i == 0 ? "first":"") . '" onclick="location.href=\'#tab='.($i+1).'\'" href="#BJ_NewsTabber_Panel_'.$contents[$i]->id.'" title="'.$contents[$i]->title.'"><span class="left"></span>'. ($i < count($icons) ? "<span style=\"margin:0 5px 0 0\" class=\"" . $icons[$i] . "\"></span>" : "").($tab_header == 0 ? $contents[$i]->alias : $contents[$i]->title).'<span class="right"></span><span class="clearer"></span></a><span class="clearer"></span></li>';
		 }?>
	</ul>
	<div class="panel-container">
	<div class="panel-container-in">
	<div class="corner-tl"></div>
	<div class="corner-tr"></div>
	<div class="corner-bl"></div>
	<div class="corner-br"></div>
	<?php for($i = 0; $i < count($contents); $i++) {
	$row->text = $contents[$i]->introtext;
	$row->attribs = $contents[$i]->attribs;
	$row->images = $contents[$i]->images;
	$pars = new JParameter( $row->attribs );
	//process images
	
	$pars->def( 'image', 1 );
	JPluginHelper::importPlugin( 'content',null,false);
	$dispatcher = &JDispatcher::getInstance();
	$result = $dispatcher->trigger('onPrepareContent', array( &$row, &$pars,0), true);
	$text = $row->text;
		
	?>
	<div id="BJ_NewsTabber_Panel_<?php echo $contents[$i]->id;?>">
		<?php echo $text;?>
	</div>
	<?php }?>
	</div>
	<div class="clearer"><!-- --></div>
	</div>
</div>
<script type="text/javascript">
jQuery(document).ready(function($) {
		$("#BJ_NewsTabber_<?php echo $id;?>").tabs();
		$("#BJ_NewsTabber_<?php echo $id;?>").removeClass("hide");
	});
</script>
<script>
jQuery(function(){
	jQuery(".bj-tab").click(function(){
		var tab = jQuery(this).attr('href');
		var idtab = tab.split('=',2);
		var idtab = (idtab[1]-1);
		var oldidtab = jQuery('#BJ_NewsTabber_<?php echo $id;?> ul li.ui-state-active a').attr('href');
		var newidtab = jQuery('#BJ_NewsTabber_<?php echo $id;?> ul li:eq('+idtab+') a').attr('href');							 
		if(newidtab){			
			jQuery('#BJ_NewsTabber_<?php echo $id;?> ul li').each(function(){
				jQuery(this).attr('class','typo-thumbup ui-corner-top ui-state-default')
			});
			jQuery('#BJ_NewsTabber_<?php echo $id;?> ul li:eq('+idtab+')').attr('class','typo-earth ui-corner-top ui-tabs-selected ui-state-active');	
			jQuery('#BJ_NewsTabber_<?php echo $id;?> '+oldidtab).attr('class','ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide');		
			jQuery('#BJ_NewsTabber_<?php echo $id;?> '+newidtab).attr('class', 'ui-tabs-panel ui-widget-content ui-corner-bottom');	
		}else{
			alert('Tab does not exist');
		}
	});
	var url = document.URL;
	url = url.split('#',2);
	url = url[1].split('=',2);
	if(url[1] && url[0]=='tab'){
		var idtab = (url[1]-1);
		var oldidtab = jQuery('#BJ_NewsTabber_<?php echo $id;?> ul li.ui-state-active a').attr('href')
		var newidtab = jQuery('#BJ_NewsTabber_<?php echo $id;?> ul li:eq('+idtab+') a').attr('href');
		if(newidtab){			
			jQuery('#BJ_NewsTabber_<?php echo $id;?> ul li').each(function(){
				jQuery(this).attr('class','typo-thumbup ui-corner-top ui-state-default')
			});
			jQuery('#BJ_NewsTabber_<?php echo $id;?> ul li:eq('+idtab+')').attr('class','typo-earth ui-corner-top ui-tabs-selected ui-state-active');	
			jQuery('#BJ_NewsTabber_<?php echo $id;?> '+oldidtab).attr('class','ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide');		
			jQuery('#BJ_NewsTabber_<?php echo $id;?> '+newidtab).attr('class', 'ui-tabs-panel ui-widget-content ui-corner-bottom');	
		}else{
			alert('Tab does not exist');
		}
	}
});
</script>
<?php } ?>
<!-- END NEWSTABBER 2 -->