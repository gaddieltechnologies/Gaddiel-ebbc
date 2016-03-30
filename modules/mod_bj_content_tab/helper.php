<?php
/**
* @version		helper.php 2010-07-22 11:35 PM
* @package		BJ Venus
* @author		hadoanngoc@byjoomla.com
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

class modBJContentTabHelper
{
	function getContent($category_id,$items,$item_count, $order_by)
	{
		if($items == "") {
			$query = "SELECT a.*,cc.alias as cat_alias,s.alias as section_alias FROM #__content as a"				
					." LEFT JOIN #__categories AS cc ON cc.id = a.catid"
					." LEFT JOIN #__sections AS s ON s.id = a.sectionid"
					." WHERE a.catid = " . $category_id . " "
					." AND a.state = 1 "
					." ORDER BY " . $order_by . " LIMIT " . $item_count;
		} else {
			$query = "SELECT a.*,cc.alias as cat_alias,s.alias as section_alias FROM #__content as a"
					." LEFT JOIN #__categories AS cc ON cc.id = a.catid"
					." LEFT JOIN #__sections AS s ON s.id = a.sectionid"
					. " WHERE a.id IN (" . $items . ")"
					. " ORDER BY " . $order_by;
		}		
		$database = &JFactory::getDbo();
		$database->setQuery($query);
		return $database->loadObjectList();
	}
}
