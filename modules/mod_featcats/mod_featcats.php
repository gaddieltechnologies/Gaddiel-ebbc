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

require_once dirname(__FILE__) . '/helper.php';

$cats = modFeatcatsHelper::getList($params);

if (!empty($cats)) {
	$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
	$item_heading = $params->get('item_heading');
	$cat_heading  = $params->get('cat_heading');
	$link_cats    = $params->get('link_cats', 1);
	$show_image   = $params->get('show_image', 0);
	$show_more    = $params->get('show_more');
	$link_target  = $params->get('link_target');
	$pag          = $params->get('pag_show', 0);
	$css          = $params->get('add_css','featcats.css');
	if (!$params->get('mid')) { 
		$mid = $module->id;
	} else {
		$mid = $params->get('mid');
	}
	if (!$params->get('ajaxed')) {
		require JModuleHelper::getLayoutPath('mod_featcats', 'default');
	} else {
		$id  = (int)JRequest::getVar('catid');
		$cat = $cats[$id];
		require JModuleHelper::getLayoutPath('mod_featcats', 'cat');
	}
}