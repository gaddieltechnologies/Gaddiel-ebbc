<?php
/*------------------------------------------------------------------------
# mod_dinamods - Dinamod Tab Modules
# ------------------------------------------------------------------------
# author    Joomla!Vargas
# copyright Copyright (C) 2010 joomla.vargas.co.cr. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://joomla.vargas.co.cr
# Technical Support:  Forum - http://joomla.vargas.co.cr/forum
-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die;

require( JModuleHelper::getLayoutPath('mod_dinamods', 'tabs/' . $params->get('tabs_pos', 'top') ) );

$speed = 0;

if ( $params->get('slider', 1) == 1 ) : $speed = $params->get('speed', 3000 ); endif;

$doc = JFactory::getDocument();

if (!defined('_MOD_VARGAS_ONLOAD')) {
    define ('_MOD_VARGAS_ONLOAD',1);
    $doc->addScriptDeclaration("function addLoadEvent(func){if(typeof window.addEvent=='function'){window.addEvent('load',function(){func()});}else if(typeof window.onload!='function'){window.onload=func;}else{var oldonload=window.onload;window.onload=function(){if(oldonload){oldonload();}func();}}}");
}

$doc->addScriptDeclaration("addLoadEvent(function(){
var Dinamods=new dinamods('dm_tabs_".$dinamods_id."');
Dinamods.setpersist(true);
Dinamods.setselectedClassTarget('link');
Dinamods.init(".$speed.",".$params->get('change', 0).");});");
