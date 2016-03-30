<?php
/**
* Module mod_slidingcaptionsmenu For Joomla 1.6.x
* Version		: 1.4
* Created by	: Daniel Pardons
* Email			: daniel.pardons@joompad.be
* Created on	: 07 Mar 2011
* Last Modified : 06 May 2011
* URL			: www.joompad.be
* Copyright (C) 2011  Daniel Pardons
* License GPLv2.0 - http://www.gnu.org/licenses/gpl-2.0.html
*
* Based on jQuery Sam Dunn tutorial "Sliding Boxes and Captions with jQuery" 
* http://buildinternet.com/2009/03/sliding-boxes-and-captions-with-jquery/)
*
* This program is free software; you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation; either version 2
* of the License, or (at your option) any later version.

* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.

* You should have received a copy of the GNU General Public License
* along with this program; if not, write to the Free Software
* Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

$baseurl 		= JURI::base();

$module_id		= $params->get( 'module_id' );
$folder			= $params->get( 'folder' );

$gallery_left_margin = (int)$params->get( 'gallery_left_margin' );
$gallery_position = $params->get( 'gallery_position' );
$gallery_width	= (int)$params->get( 'gallery_width' );
$gallery_rows = (int)$params->get( 'gallery_rows' );
$images_in_row = (int)$params->get( 'images_in_row' );
$gallery_bgcolor= $params->get( 'gallery_bgcolor' );
$gallery_css = $params->get( 'gallery_css' );

$image_width	= (int)$params->get( 'image_width' );
$image_height	= (int)$params->get( 'image_height' );
$image_margin	= (int)$params->get( 'image_margin' );
$image_css		= $params->get( 'image_css' );

$boxcaption_css	= $params->get( 'boxcaption_css' );
$caption_min_height = (int)$params->get( 'caption_min_height' );
$caption_max_height = (int)$params->get( 'caption_max_height' );
$caption_initial_height = $image_height - $caption_min_height;
$caption_final_height = $image_height - $caption_max_height;
$caption_bgcolor = $params->get( 'caption_bgcolor' );
$caption_opacity = $params->get( 'caption_opacity' );
$caption_ie_opacity = (int)($caption_opacity*100);
$caption_sliding_duration =  $params->get( 'caption_sliding_duration' );

$title_color	= $params->get( 'title_color' );
$title_css		= $params->get( 'title_css' );
$teaser_color	= $params->get( 'teaser_color' );
$teaser_css		= $params->get( 'teaser_css' );


$image_img = array();
$image_caption_color = array();
$image_alt = array();
$image_url = array();
$image_title = array();
$image_teaser = array();
$target_url= array();

$image_img[] 	= $folder.$params->get( 'image_img1' );
$image_caption_color[] = ($params->get( 'image_img1_caption_bgcolor' )) ? $params->get( 'image_img1_caption_bgcolor' ) : $caption_bgcolor;
$image_alt[] 	= $params->get( 'image_alt1' );
$image_url[] 	= str_replace('&', '&amp;', $params->get( 'image_url1' ));
$image_title[] 	= $params->get( 'image_title1' );
$image_teaser[] = $params->get( 'image_teaser1' );
$target_url[] 	= $params->get( 'target_url1' );

$image_img[]	= $folder.$params->get( 'image_img2' );
$image_caption_color[] = ($params->get( 'image_img2_caption_bgcolor' )) ? $params->get( 'image_img2_caption_bgcolor' ) : $caption_bgcolor;
$image_alt[] 	= $params->get( 'image_alt2' );
$image_url[] 	= str_replace('&', '&amp;', $params->get( 'image_url2' ));
$image_title[] 	= $params->get( 'image_title2' );
$image_teaser[] = $params->get( 'image_teaser2' );
$target_url[] 	= $params->get( 'target_url2' );

$image_img[]	= $folder.$params->get( 'image_img3' );
$image_caption_color[] = ($params->get( 'image_img3_caption_bgcolor' )) ? $params->get( 'image_img3_caption_bgcolor' ) : $caption_bgcolor;
$image_alt[]	= $params->get( 'image_alt3' );
$image_url[] 	= str_replace('&', '&amp;', $params->get( 'image_url3' ));
$image_title[] 	= $params->get( 'image_title3' );
$image_teaser[]	= $params->get( 'image_teaser3' );
$target_url[] 	= $params->get( 'target_url3' );

$image_img[]	= $folder.$params->get( 'image_img4' );
$image_caption_color[] = ($params->get( 'image_img4_caption_bgcolor' )) ? $params->get( 'image_img4_caption_bgcolor' ) : $caption_bgcolor;
$image_alt[]	= $params->get( 'image_alt4' );
$image_url[]	= str_replace('&', '&amp;', $params->get( 'image_url4' ));
$image_title[]	= $params->get( 'image_title4' );
$image_teaser[]	= $params->get( 'image_teaser4' );
$target_url[]	= $params->get( 'target_url4' );

$image_img[]	= $folder.$params->get( 'image_img5' );
$image_caption_color[] = ($params->get( 'image_img5_caption_bgcolor' )) ? $params->get( 'image_img5_caption_bgcolor' ) : $caption_bgcolor;
$image_alt[]	= $params->get( 'image_alt5' );
$image_url[]	= str_replace('&', '&amp;', $params->get( 'image_url5' ));
$image_title[]	= $params->get( 'image_title5' );
$image_teaser[]	= $params->get( 'image_teaser5' );
$target_url[]	= $params->get( 'target_url5' );

$image_img[]	= $folder.$params->get( 'image_img6' );
$image_caption_color[] = ($params->get( 'image_img6_caption_bgcolor' )) ? $params->get( 'image_img6_caption_bgcolor' ) : $caption_bgcolor;
$image_alt[]	= $params->get( 'image_alt6' );
$image_url[]	= str_replace('&', '&amp;', $params->get( 'image_url6' ));
$image_title[]	= $params->get( 'image_title6' );
$image_teaser[]	= $params->get( 'image_teaser6' );
$target_url[]	= $params->get( 'target_url6' );

$image_img[]	= $folder.$params->get( 'image_img7' );
$image_caption_color[] = ($params->get( 'image_img7_caption_bgcolor' )) ? $params->get( 'image_img7_caption_bgcolor' ) : $caption_bgcolor;
$image_alt[]	= $params->get( 'image_alt7' );
$image_url[]	= str_replace('&', '&amp;', $params->get( 'image_url7' ));
$image_title[]	= $params->get( 'image_title7' );
$image_teaser[]	= $params->get( 'image_teaser7' );
$target_url[]	= $params->get( 'target_url7' );

$image_img[]	= $folder.$params->get( 'image_img8' );
$image_caption_color[] = ($params->get( 'image_img8_caption_bgcolor' )) ? $params->get( 'image_img8_caption_bgcolor' ) : $caption_bgcolor;
$image_alt[]	= $params->get( 'image_alt8' );
$image_url[]	= str_replace('&', '&amp;', $params->get( 'image_url8' ));
$image_title[]	= $params->get( 'image_title8' );
$image_teaser[]	= $params->get( 'image_teaser8' );
$target_url[]	= $params->get( 'target_url8' );

$image_img[]	= $folder.$params->get( 'image_img9' );
$image_caption_color[] = ($params->get( 'image_img9_caption_bgcolor' )) ? $params->get( 'image_img9_caption_bgcolor' ) : $caption_bgcolor;
$image_alt[]	= $params->get( 'image_alt9' );
$image_url[]	= str_replace('&', '&amp;', $params->get( 'image_url9' ));
$image_title[]	= $params->get( 'image_title9' );
$image_teaser[]	= $params->get( 'image_teaser9' );
$target_url[]	= $params->get( 'target_url9' );

$image_img[]	= $folder.$params->get( 'image_img10' );
$image_caption_color[] = ($params->get( 'image_img10_caption_bgcolor' )) ? $params->get( 'image_img10_caption_bgcolor' ) : $caption_bgcolor;
$image_alt[] 	= $params->get( 'image_alt10' );
$image_url[] 	= str_replace('&', '&amp;', $params->get( 'image_url10' ));
$image_title[] 	= $params->get( 'image_title10' );
$image_teaser[]	= $params->get( 'image_teaser10' );
$target_url[] 	= $params->get( 'target_url10' );

$image_img[]	= $folder.$params->get( 'image_img11' );
$image_caption_color[] = ($params->get( 'image_img11_caption_bgcolor' )) ? $params->get( 'image_img11_caption_bgcolor' ) : $caption_bgcolor;
$image_alt[] 	= $params->get( 'image_alt11' );
$image_url[] 	= str_replace('&', '&amp;', $params->get( 'image_url11' ));
$image_title[] 	= $params->get( 'image_title11' );
$image_teaser[]	= $params->get( 'image_teaser11' );
$target_url[] 	= $params->get( 'target_url11' );

$image_img[]	= $folder.$params->get( 'image_img12' );
$image_caption_color[] = ($params->get( 'image_img12_caption_bgcolor' )) ? $params->get( 'image_img12_caption_bgcolor' ) : $caption_bgcolor;
$image_alt[] 	= $params->get( 'image_alt12' );
$image_url[] 	= str_replace('&', '&amp;', $params->get( 'image_url12' ));
$image_title[] 	= $params->get( 'image_title12' );
$image_teaser[]	= $params->get( 'image_teaser12' );
$target_url[] 	= $params->get( 'target_url12' );

$image_img[]	= $folder.$params->get( 'image_img13' );
$image_caption_color[] = ($params->get( 'image_img13_caption_bgcolor' )) ? $params->get( 'image_img13_caption_bgcolor' ) : $caption_bgcolor;
$image_alt[] 	= $params->get( 'image_alt13' );
$image_url[] 	= str_replace('&', '&amp;', $params->get( 'image_url13' ));
$image_title[] 	= $params->get( 'image_title13' );
$image_teaser[]	= $params->get( 'image_teaser13' );
$target_url[] 	= $params->get( 'target_url13' );

$image_img[]	= $folder.$params->get( 'image_img14' );
$image_caption_color[] = ($params->get( 'image_img14_caption_bgcolor' )) ? $params->get( 'image_img14_caption_bgcolor' ) : $caption_bgcolor;
$image_alt[] 	= $params->get( 'image_alt14' );
$image_url[] 	= str_replace('&', '&amp;', $params->get( 'image_url14' ));
$image_title[] 	= $params->get( 'image_title14' );
$image_teaser[]	= $params->get( 'image_teaser14' );
$target_url[] 	= $params->get( 'target_url14' );

$image_img[]	= $folder.$params->get( 'image_img15' );
$image_caption_color[] = ($params->get( 'image_img15_caption_bgcolor' )) ? $params->get( 'image_img15_caption_bgcolor' ) : $caption_bgcolor;
$image_alt[] 	= $params->get( 'image_alt15' );
$image_url[] 	= str_replace('&', '&amp;', $params->get( 'image_url15' ));
$image_title[] 	= $params->get( 'image_title15' );
$image_teaser[]	= $params->get( 'image_teaser15' );
$target_url[] 	= $params->get( 'target_url15' );

$image_img[]	= $folder.$params->get( 'image_img16' );
$image_caption_color[] = ($params->get( 'image_img16_caption_bgcolor' )) ? $params->get( 'image_img16_caption_bgcolor' ) : $caption_bgcolor;
$image_alt[] 	= $params->get( 'image_alt16' );
$image_url[] 	= str_replace('&', '&amp;', $params->get( 'image_url16' ));
$image_title[] 	= $params->get( 'image_title16' );
$image_teaser[]	= $params->get( 'image_teaser16' );
$target_url[] 	= $params->get( 'target_url16' );


$document =& JFactory::getDocument();
if ($params->get('load_JQuery')==1)  {
	$document->addScript(JURI::base() . 'modules/mod_slidingcaptionsmenu/js/jquery-1.4.2.min.js');
}

$sccs =	'';
if ($gallery_position==1) {
	$sccs .= '#scmgallery'.$module_id.' {
		margin-left: auto;
		margin-right: auto;
		width: '.$gallery_width.'px;
		background: '.$gallery_bgcolor.' !important;
		'.$gallery_css.'
		display: block;
		overflow: hidden;
		}
	';
} else {
	$sccs .= '#scmgallery'.$module_id.' {
		margin-left: '.$gallery_left_margin.'px;
		width: '.$gallery_width.'px;
		background: '.$gallery_bgcolor.' !important;
		'.$gallery_css.'
		display: block;
		overflow: hidden;
		}
	';
}

$sccs .= '#scmgallery'.$module_id.' .boxgrid  {
			width: '.$image_width.'px;
			height: '.$image_height.'px;
			margin-top: '.$image_margin.'px;
			margin-left: '.$image_margin.'px;
			'.$image_css.'
			float: left;
			overflow: hidden;
			position: relative;
			}
			';

$sccs .= '#scmgallery'.$module_id.' .boxgrid_bottom  {
			margin-bottom: '.$image_margin.'px;
			}
			';

$sccs .= '#scmgallery'.$module_id.' .boxgrid img {
			position: absolute;
			top: 0;
			left: 0;
			border: 0;
			}
			';

$sccs .= '#scmgallery'.$module_id.' .boxgrid  .teaser-title {
			color: '.$title_color.';
			'.$title_css.'
			}
			';
$sccs .= '#scmgallery'.$module_id.' .boxgrid .teaser-text {
			color: '.$teaser_color.';
			'.$teaser_css.'
			}
			';

$sccs .= '#scmgallery'.$module_id.' .boxcaption {
			float: left; 
			position: absolute; 
			height: '.$caption_max_height.'px; 
			width: 100%; 
			'.$boxcaption_css.'
			}
			';

$sccs .= '#scmgallery'.$module_id.' .captionfull .boxcaption {
 			top: '.$caption_initial_height.'px;
 			left: 0px;
 			}
			';

// put configuration code in the header
$document->addStyleDeclaration($sccs);

?>

<script type="text/javascript">
// set flags for whether we should use opacity or filter with
// this browser (or browser mode). we prefer opacity.
var useOpacity =
   (typeof document.createElement("div").style.opacity != 'undefined');
var useFilter = !useOpacity
   && (typeof document.createElement("div").style.filter != 'undefined');
jQuery.noConflict();
jQuery(document).ready(function($)
{
   if (useOpacity) {
      $('#scmgallery<?php echo $module_id; ?> .boxcaption').css('opacity',<?php echo $caption_opacity;?>);
   } else if (useFilter) {
      $('#scmgallery<?php echo $module_id; ?> .boxcaption').css('filter',"alpha(opacity=" + (<?php echo $caption_opacity;?> * 100) + ")");
   } else {
   }
	//Full Caption Sliding (Hidden or partially hidden to Visible)
	$('#scmgallery<?php echo $module_id; ?> .boxgrid.captionfull').hover(function(){
		$(".cover", this).stop().animate({top:'<?php echo $caption_final_height; ?>px'},{queue:false,duration:<?php echo $caption_sliding_duration; ?>});
	}, function() {
		$(".cover", this).stop().animate({top:'<?php echo $caption_initial_height; ?>px'},{queue:false,duration:<?php echo $caption_sliding_duration; ?>});
	});
});
</script>

<div id="scmgallery<?php echo $module_id; ?>">
<?php 
$imagenr = 0;
$kr = 0 ;
for ($r = 1; $r <= $gallery_rows; $r++) {;
	 for ($ir= 1; $ir <= $images_in_row; $ir++) { ;?>
		  <!--galleryEntry <?php echo $imagenr+1; ?> -->
	<?php if ($r != $gallery_rows) { ;?>
			<div class="boxgrid captionfull">
	<?php } else { ;?>
			<div class="boxgrid captionfull boxgrid_bottom">
	<?php } ;?>
				<?php if ($image_url[$imagenr]) { ?>
					<a href="<?php echo $image_url[$imagenr]; ?>" target="<?php echo $target_url[$imagenr]; ?>"><img src="<?php echo $baseurl.$image_img[$imagenr]; ?>" alt="<?php echo $image_alt[$imagenr]; ?>" /></a>
				<?php } else { ?>
					<img src="<?php echo $baseurl.$image_img[$imagenr]; ?>" alt="<?php echo $image_alt[$imagenr]; ?>" />
				<?php } ?>

				<div class="cover boxcaption" style="background:<?php echo $image_caption_color[$imagenr]; ?> !important;">
					<div class="teaser-title" style="color:<?php echo $title_color; ?>; <?php echo $title_css; ?>"><?php echo $image_title[$imagenr]; ?></div>
					<div class="teaser-text" style="color:<?php echo $teaser_color; ?>; "><?php echo $image_teaser[$imagenr]; ?></div>

				</div>
			<?php 
			$imagenr++;
			?>
			</div>
		<?php } 
	} ?>
</div> 
<div style="clear:both;"></div>

