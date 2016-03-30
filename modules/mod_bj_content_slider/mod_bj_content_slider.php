<?php
/**
Author: HaDN - www.byjoomla.com
Version: 2.5.0 - 8th July 2010
**/
?>
<!-- BEGIN NEWSTABBER -->
<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

// Include the syndicate functions only once
require_once (dirname(__FILE__).DS.'helper.php');

// ============== GET PARAMETERS ============================== //
$category_id = $params->get( 'category_id', array());
$moduleclass_sfx = $params->get('moduleclass_sfx', '');
$item_count = $params->get('item_count', 3);
$order_by = (int)$params->get('order_by',0);//created DESC;created ASC;ordering ASC;ordering DESC
$slider_height = $params->get('slider_height',100)."px";
$roller_interval = $params->get('roller_interval',500);
$load_style = $params->get('load_style',0);
$theme = $params->get('theme','venus');
$need_jquery = $params->get('need_jquery',0);
// =============== END PARAMETERS ============================= //

require(JModuleHelper::getLayoutPath('mod_bj_content_slider'));

?>
