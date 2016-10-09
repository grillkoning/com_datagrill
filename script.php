<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_datagrill
 *
 * @copyright   Copyright (C) 2016 Chris Rutten. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
/**
 * Script file of datagrill component
 */
class Com_datagrillInstallerScript
{

	/**
	 * runs at the very end of the component's installation
	 *
	 * @return void
	 */
	function postflight($type, $parent) 
	{
	    // Create a default category for our component
   		$basePath = JPATH_ADMINISTRATOR . '/components/com_categories';
    		require_once $basePath . '/models/category.php';
    		$config = array( 'table_path' => $basePath . '/tables');
    		$catmodel = new CategoriesModelCategory( $config);
    		$catData = array( 'id' => 0, 'parent_id' => 1, 'level' => 1, 'path' => 'Uncategorised', 'extension' => 'com_datagrill'
		    , 'title' => 'Uncategorised', 'alias' => 'Uncategorised', 'description' => 'Uncategorised</p>', 'published' => 1, 'language' => '*');
    		$status = $catmodel->save( $catData);
	}
}
