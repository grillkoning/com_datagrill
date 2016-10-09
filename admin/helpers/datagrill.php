<?php
/**
 * @author		
 * @copyright	
 * @license		
 */

defined("_JEXEC") or die("Restricted access");

/**
 * Datagrill helper class.
 *
 * @package     Datagrill
 * @subpackage  Helpers
 */
class DatagrillHelper
{
	public static function addSubmenu($vName)
	{
		JHtmlSidebar::addEntry(
			JText::_('COM_DATAGRILL_SUBMENU_DATAGRILLAPPLICATION'), 
			'index.php?option=com_datagrill&view=applications', 
			$vName == 'applications'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_DATAGRILL_SUBMENU_DATAGRILLTABLE'), 
			'index.php?option=com_datagrill&view=tables', 
			$vName == 'tables'
		);

		JHtmlSidebar::addEntry(
			JText::_('JCATEGORIES'), 
			'index.php?option=com_categories&extension=com_datagrill', 
			$vName == 'categories'
		);
	}
	
	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @return	JObject
	 * @since	1.6
	 */
	public static function getActions()
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		$assetName = 'com_datagrill';

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action) {
			$result->set($action, $user->authorise($action, $assetName));
		}

		return $result;
	}
	

}