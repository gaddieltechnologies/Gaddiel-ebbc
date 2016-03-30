<?php
/**
Author: HaDN - www.byjoomla.com
Version: 2.5.0 - 11th June 2010
**/
?>
<!-- BEGIN BJ! CONTENT TAB - JQuery Version -->
<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

// Include the syndicate functions only once
require_once (dirname(__FILE__).DS.'helper.php');

// ============== GET PARAMETERS ============================== //
$category_id = $params->get( 'category_id', 0 );
$moduleclass_sfx = $params->get('moduleclass_sfx', '');
$item_count = $params->get('item_count', 3);
$items = $params->get('items', "");
$icons = $params->get("icons","");
$width_title = $params->get('width_title', "100%");
$width_panel = $params->get('width_panel', "100%");
$content_panel = $params->get('content_panel', "100%");
$bg = $params->get('background', "#ddd");
$tab_header = $params->get('tab_header', 0);
$order_by = $params->get('order_by','created DESC');
$theme = $params->get('theme','venus');
$type = $params->get('type','tabber');
$need_jquery = $params->get('need_jquery',0);
// =============== END PARAMETERS ============================= //

require(JModuleHelper::getLayoutPath('mod_bj_content_tab'));

?>
