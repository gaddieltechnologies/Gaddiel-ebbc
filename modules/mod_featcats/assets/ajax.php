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

define('_JEXEC', 1);

define( 'DS', DIRECTORY_SEPARATOR );

define('JPATH_BASE', dirname(__FILE__).DS.'..'.DS.'..'.DS.'..' );

require_once JPATH_BASE.DS.'includes'.DS.'defines.php';
require_once JPATH_BASE.DS.'includes'.DS.'framework.php';

$app = JFactory::getApplication('site');
$app->initialise();

$document = JFactory::getDocument();

require_once JPATH_BASE.DS.'administrator'.DS.'components'.DS.'com_modules'.DS.'models'.DS.'module.php';

$modModel = JModelLegacy::getInstance('Module', 'ModulesModel', array('ignore_request' => true));

$mid = JRequest::getInt('mid');

$mymodule = $modModel->getItem($mid);

$myparams = new JRegistry;
$myparams->loadArray($mymodule->params);
$myparams->mid = $mid;

$module = JModuleHelper::getModule('mod_featcats');

$registry = new JRegistry;
$registry->loadString($module->params);
$registry->merge($myparams);
$registry->set('mid', $mid);
$registry->set('ajaxed', 1);

$module->params = $registry->toString();

$renderer	= $document->loadRenderer('module');
echo $renderer->render($module, array('style' => 'none'));
