<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

/**
 *
 * @package 	BJ Content Tab
 * @subpackage	Parameter
 * @since		1.5
 */

class JElementColor extends JElement
{
	/**
	 * Element name
	 *
	 * @access	protected
	 * @var		string
	 */
	var	$_name = 'Color';

	function fetchElement($name, $value, &$node, $control_name)
	{
		$document = &JFactory::getDocument();
		$document->addScript(JURI::base(). '../modules/mod_bj_content_tab/media/js/jscolor/jscolor.js' );
		return '<input class="color" value="'.$value.'" name="'.$control_name.'['.$name.']" id="'.$control_name.$name.'"/>';		
	}
}
