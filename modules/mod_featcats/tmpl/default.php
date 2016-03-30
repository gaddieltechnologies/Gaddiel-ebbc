<?php
/*------------------------------------------------------------------------
# mod_featcats - Featured Categories
# ------------------------------------------------------------------------
# author    Joomla!Vargas
# copyright Copyright (C) 2010 joomla.vargas.co.cr. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://joomla.vargas.co.cr
# Technical Support:  Forum - http://joomla.vargas.co.cr/forum
-------------------------------------------------------------------------*/

defined('_JEXEC') or die;

$doc = JFactory::getDocument();

if ($css!=-1) :
	$doc->addStyleSheet('modules/mod_featcats/assets/'.$css);
endif;

if ($pag) :
	$script = "var sfolder = '" . JURI::base(true) . "';";
	$doc->addScriptDeclaration($script);
	$doc->addScript('modules/mod_featcats/assets/featcats.js');
endif;
?>
<ul class="featcats<?php echo $moduleclass_sfx; ?>" id="featcats-<?php echo $mid; ?>">
	<?php foreach ($cats as $id=>$cat) : ?>
    <li class="<?php echo $cat->col_class; ?>" style="width:<?php echo $params->get('col_width'); ?>" id="featcat-<?php echo $mid; ?>-<?php echo $id; ?>">
        <?php if ($show_more==2) : ?><a href="<?php echo $cat->category_link; ?>" class="fc_more"><?php echo JText::_('MOD_FEATCATS_MORE_ARTICLES'); ?></a><?php endif; ?>
        <?php if ($cat_heading) : ?><?php echo '<h' . $cat_heading . '>'; ?><?php if ( $link_cats ) : ?><a href="<?php echo $cat->category_link; ?>"><?php endif; ?><?php echo $cat->category_title; ?><?php if ( $link_cats ) : ?></a><?php endif; ?><?php echo '</h' . $cat_heading . '>'; ?><?php endif; ?>
		<div id="fc_ajax-<?php echo $mid; ?>-<?php echo $id; ?>" class="fc_ajax">
			<?php require JModuleHelper::getLayoutPath('mod_featcats', 'cat'); ?>
        </div>
    </li>
    <?php endforeach; ?>
</ul>
<div style="clear:both"></div>
