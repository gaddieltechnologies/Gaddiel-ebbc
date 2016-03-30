<?php
/*------------------------------------------------------------------------
# mod_filterednews - Filtered News Module
# ------------------------------------------------------------------------
# author    Joomla!Vargas
# copyright Copyright (C) 2010 joomla.vargas.co.cr. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://joomla.vargas.co.cr
# Technical Support:  Forum - http://joomla.vargas.co.cr/forum
-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die;

JHTML::script('scroller.js','modules/mod_filterednews/scripts/',false); ?>

<script type="text/javascript" language="javascript">
<!--
var FN_Pausecontent_<?php echo $filterednews_id; ?>=new Array();

<?php  $k=0;  foreach ($list as $item) : 
${'content'.$k} = $item->content;
${'content'.$k} = preg_replace( "/[\n\t\r]+/",' ',${'content'.$k} );
${'content'.$k} = str_replace( "'", "\\'",${'content'.$k} ); ?>
FN_Pausecontent_<?php echo $filterednews_id; ?>[<?php echo $k; ?>]='<?php echo ${'content'.$k}; ?>';
<?php  $k++;  endforeach; ?>

new FN_Pausescroller(FN_Pausecontent_<?php echo $filterednews_id; ?>, "fn_scroller_<?php echo $filterednews_id; ?>", "", <?php echo $params->get('delay', 3000) ?>);
-->
</script>
