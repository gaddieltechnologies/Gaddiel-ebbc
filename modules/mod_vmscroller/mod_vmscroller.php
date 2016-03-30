<?php
/*------------------------------------------------------------------------
# "Hot VM Scroller" Joomla module
# Copyright (C) 2011 ArhiNet d.o.o. All Rights Reserved.
# License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
# Author: HotJoomlaTemplates.com
# Website: http://www.hotjoomlatemplates.com
-------------------------------------------------------------------------*/
defined('_JEXEC') or die ('Restricted access.');

require_once(dirname(__FILE__).DS.'helper.php');

if (!defined('PIG2JS')) {
    define('PIG2JS',1);
}

$vmscroller = new modVMScrollerHelper($params);
$vmscroller->render();

?>

