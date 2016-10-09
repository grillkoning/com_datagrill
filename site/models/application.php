<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_datagrill
 *
 * @copyright   Copyright (C) 2016 Chris Rutten
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
/**
 *  Model
 *
 * @since  0.0.1
 */
class datagrillModelApplication extends JModelItem
{

	protected $applications;
	protected $_kickoff;
 

	public function getTable($type = 'Your_Database_Application', $prefix = 'datagrillTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	public function getAppId()
	{
		$input = JFactory::getApplication()->input;
		$appId = $input->get('id');
		return $appId;
	}

 	public function getAppPath($appId)
	{
		if (!$appId) {
			$appId = $this->getAppId();
			}
		$table=$this->getTable();
		$table->load($appId); 
 		$path=$table->get('apppath');
		return $path;
	}
 	public function getAppUrl($appId)
	{
		if (!$appId) {
			$appId = $this->getAppId();
			}
		$table=$this->getTable();
		$table->load($appId); 
 		$url=$table->get('appurl');
		return $url;
	}
	public function setKickoff($theLink){
		$this->_kickoff=$theLink;
		}

	public function getKickoff(){
		return $this->_kickoff;
		}

}
