<?php
/**
* @Copyright Copyright (C) 2011- powerful_xml_template by Smallirons
* @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
* @versione 2.0 all parameters
**/

defined( '_JEXEC' ) or die( 'Restricted access' );
if(!defined('DS')){
define('DS',DIRECTORY_SEPARATOR);
}
require_once (dirname(__FILE__).DS.'noimage_functions.php');

if (!function_exists('GetHColor')) {
function GetHColor($params, $tag_name, $curr_h_val = 'FFFFFF' , $curr_h_sym = '#')
{
	$curr_pinput = $params->get($tag_name, $curr_h_sym . $curr_h_val);
	if (strtolower(substr($curr_pinput, 0, 2)) == '0x') {
		$curr_hex = substr($curr_pinput, 2);
	} elseif (substr($curr_pinput, 0, 1) == '#') {
		$curr_hex = substr($curr_pinput, 1);
	} else {
		$curr_hex = $curr_pinput;
	}
	if (strspn($curr_hex, "0123456789abcdefABCDEF") == 6 && strlen($curr_hex) == 6) {
		$curr_pinput = $curr_h_sym . $curr_hex;
	} else {
		$curr_pinput = $curr_h_sym . $curr_h_val;
	}
	return $curr_pinput;
}
}

$bannerWidth           = trim($params->get( 'bannerWidth', '100%' ));
$bannerHeight          = intval($params->get( 'bannerHeight', 350 ));
$wmode                 = trim($params->get( 'wmode', 'window' ));
$moduleclass           = trim($params->get( 'moduleclass_sfx', 'powt' ));
$contentxml = 'xml/'.trim($moduleclass).'_powerful2.xml';

$powerfulmod = 'powerful'.trim($moduleclass).'mod';

$templatetype = 'index.swf';


$module_path = dirname(__FILE__).DS;
if (!is_dir($module_path . 'xml/')) {
	@mkdir($module_path . 'xml/', 0777);
}

$imgsrc        = trim($params->get('imgsrc', '' )); 
$imgsrc_arr    = explode("|",$imgsrc);

$imgdir        = trim($params->get('imgdir', '' )); 
$thumbdir        = trim($params->get('thumbdir', '' )); 

$imgtitle        = trim($params->get('imgtitle', '' )); 
$imgtitle_arr    = explode("|",$imgtitle);

$imgdesc        = trim($params->get('imgdsc', '' )); 
$imgdsc_arr    = explode("|",$imgdesc);


$thumbwidth          = intval($params->get( 'thumbWidth', 141 ));
$thumbheight         = intval($params->get( 'thumbHeight', 101 ));
$horizspace          = intval($params->get( 'horizspace', 12 ));
$vertispace          = intval($params->get( 'vertispace', 12 ));


$background                    =  GetHColor($params, 'background', '646464');
$thumb_outline_normal_color    =  GetHColor($params, 'thumb_ou_normalcolor', '000000'); 
$thumb_outline_selected_color  =  GetHColor($params, 'thumb_ou_selectedcolor', 'FFFFFF'); 
$thumb_back_color              =  GetHColor($params, 'thumb_back_color', '242424'); 
$buttons_back_color            =  GetHColor($params, 'buttons_back_color', '242424');


$xml_data_data = '
<?xml version="1.0" encoding="UTF-8"?>';
$xml_data_data .= '
<settings>
 
  <!-- General and gallery setting -->
'; 
$xml_data_data .= ' 
  <thumb_width>'. trim($thumbwidth) . '</thumb_width>';
$xml_data_data .= "\n";  
$xml_data_data .= '   
  <thumb_height>' . trim($thumbheight) . '</thumb_height>';

$xml_data_data .= "\n";
$xml_data_data .= '  
  
  <horizontal_space_between_thumbs>' . trim($horizspace) . '</horizontal_space_between_thumbs>';
  
$xml_data_data .= "\n";
$xml_data_data .= '    
  <vertical_space_between_thumbs>' . trim($vertispace) . '</vertical_space_between_thumbs>';
  
  
  
  
$xml_data_data .= "\n";

if ($params->get('thumbzoom', 'yes') == 'yes') {
		$xml_data_data .= '<allow_thumb_zoom>yes</allow_thumb_zoom>';
		$xml_data_data  .= "\n";
}else{
		$xml_data_data .= '<allow_thumb_zoom>no</allow_thumb_zoom>';
		$xml_data_data  .= "\n";
}

if ($params->get('maximage', 'yes') == 'yes') {
		$xml_data_data .= '<allow_to_maximize_image>yes</allow_to_maximize_image>';
		$xml_data_data  .= "\n";
}else{
		$xml_data_data .= '<allow_to_maximize_image>no</allow_to_maximize_image>';
		$xml_data_data  .= "\n";
}

if ($params->get('fullscreen', 'yes') == 'yes') {
		$xml_data_data .= '<show_full_screen_button>yes</show_full_screen_button>';
		$xml_data_data  .= "\n";
}else{
		$xml_data_data .= '<show_full_screen_button>no</show_full_screen_button>';
		$xml_data_data  .= "\n";
}




$xml_data_data .= '      
  
  
  <thumbs_overlay_shape_color>#000000</thumbs_overlay_shape_color>
   
  <buttons_icon_normal_color>#FFFFFF</buttons_icon_normal_color>
  
  <buttons_icon_selected_color>#000000</buttons_icon_selected_color>
  
  <buttons_background_normal_color>' . trim($buttons_back_color) . '</buttons_background_normal_color>
  
  <buttons_background_selected_color>#FFFFFF</buttons_background_selected_color>
  
  <zoom_icon_color>#ffffff</zoom_icon_color>
  
  <zoom_background_color>' . trim($buttons_back_color) . '</zoom_background_color>
  
  <thumb_outline_normal_color>' . trim($thumb_outline_normal_color) . '</thumb_outline_normal_color>
  
  <thumb_outline_selected_color>' . trim($thumb_outline_selected_color) . '</thumb_outline_selected_color>
  
  <thumb_media_icon_color>#FFFFFF</thumb_media_icon_color>
  
  <thumb_media_icon_background_color>' . trim($buttons_back_color) . '</thumb_media_icon_background_color>
  
  <thumb_background_color>' . trim($thumb_back_color) . '</thumb_background_color>
  
  <preloader_color>#FFFFFF</preloader_color>
  
  <!-- Video player settings  -->
  <video_player_width>800</video_player_width>
  
  <video_player_height>500</video_player_height>
  
  <video_auto_play>yes</video_auto_play>
  
  <video_loop>yes</video_loop>
  
  <video_volume>90</video_volume>
  
  <smoothing>no</smoothing>
  
  <videoControlBarHideDelay>3</videoControlBarHideDelay>
  
  <showVideoFullScreenButton>yes</showVideoFullScreenButton>
  
  <video_buffer_color>#FFFFFF</video_buffer_color>
  
  <video_buttons_normal_color>#FFFFFF</video_buttons_normal_color>
  
  <video_buttons_selected_color>#595959</video_buttons_selected_color> 
  
  <!-- MP3 player settings  -->
  <mp3_player_width>500</mp3_player_width>
  
  <mp3_player_height>150</mp3_player_height>
  
  <soundControlBarHideDelay>5</soundControlBarHideDelay>
  
  <show_spectrum>yes</show_spectrum>
  
  <spectrum_color>#FFFFFF</spectrum_color>
  
  <sound_auto_play>yes</sound_auto_play>
  
  <sound_loop>yes</sound_loop>
  
  <sound_volume>90</sound_volume>
  
  <sound_buttons_normal_color>#FFFFFF</sound_buttons_normal_color>
  
  <sound_video_buttons_selected_color>#595959</sound_video_buttons_selected_color> 
  
 <!------------ ADD / REMOVE IMAGES FROM THE GALLERY ------------>
  <items>
  


';
$xml_data_data .= '';

////////// start : noimage code //////////////

$exist_url = JURI::root();
$server_path = getCurUrl($exist_url);
//////////////////////////////////////////


foreach ($imgsrc_arr as $ik=>$curr_isrc) {
	$xml_data_data .= '<item>';

if (false === strpos($curr_isrc, '://')) {
$xml_data_data .= '<thumb_path>' . trim($server_path.$thumbdir) . '/' . trim($curr_isrc) . '</thumb_path>';
$xml_data_data  .= "\n";
$xml_data_data .= '<media_path>' . trim($server_path.$imgdir) . '/' . trim($curr_isrc) . '</media_path>';
$xml_data_data  .= "\n";
}else{
$xml_data_data .= '<thumb_path>' . trim($curr_isrc) . '</thumb_path>';
$xml_data_data  .= "\n";
$xml_data_data .= '<media_path>' . trim($curr_isrc) . '</media_path>';
$xml_data_data  .= "\n";
}



if ($params->get('show_desc', 'yes') == 'yes') {
$xml_data_data .= '<description><![CDATA['.trim($imgdsc_arr[$ik]).']]></description>';
$xml_data_data  .= "\n";
}else{
$xml_data_data .= '<description><![CDATA[]]></description>';
$xml_data_data  .= "\n";
}



$xml_data_data .= '
           </item>';

/////////////////// END ////////////////////////////
}


	

$xml_data_data .= '
</items>';
$xml_data_data  .= "\n";
$xml_data_data .= '
</settings>

';

$catppv_id = md5($xml_data_data);


$xml_data_filename = $module_path.$catppv_id.'.xml';
if (!file_exists($xml_data_filename)) {
	$xml_prodgallery_file = fopen($xml_data_filename,'w');
	fwrite($xml_prodgallery_file, $xml_data_data);

	///////// set chmod 0777 for creating .xml file  if server is not windows
	$os_string = php_uname('s');
	$cnt = substr_count($os_string, 'Windows');
	if($cnt ==0){
		@chmod($xml_data_filename, 0777);
	}

	fclose($xml_prodgallery_file);
}
copy($module_path . $catppv_id . '.xml', $module_path . $contentxml);
unlink($xml_data_filename);

$exist_url = JURI::root();
$server_path = getCurUrl($exist_url);


?>

<div id="<?php echo $powerfulmod; ?>" style="background-color:<?php echo $background; ?>;">

	
	<object id="_slideshowBoxEmbed792293" width="<?php echo $bannerWidth; ?>" height="<?php echo $bannerHeight; ?>" type="application/x-shockwave-flash" data="<?php echo $server_path?>modules/mod_powerful_template/<?php echo $templatetype; ?>">
	<param name="movie" value="<?php echo $server_path?>modules/mod_powerful_template/<?php echo $templatetype; ?>" /><param name="allowFullScreen" value="true" />
	<param name="wmode" value="transparent" />
	<param name="flashvars" value="xml_path=<?php echo $server_path?>modules/mod_powerful_template/<?php echo $contentxml; ?>" />
	</object>
</div>

