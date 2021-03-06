<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_datagrill
 *
 * @copyright   Copyright (C) 2016 Chris Rutten
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

define(DS, '/');
define('_JEXEC', 1 );
define('JPATH_BASE', $_SERVER['DOCUMENT_ROOT'] ); 
require_once ( JPATH_BASE.DS. 'includes'.DS.'defines.php' );
require_once ( JPATH_BASE.DS.'includes'.DS.'framework.php' );
require_once (JPATH_BASE.DS.'libraries/joomla/factory.php');


class datagrillHelper
{


	public function getmysession () {
			if (!isset($_mainframe)) {
				$_mainframe = JFactory::getApplication('site');
				$_mainframe->initialise();	
				}		
			$_session = JFactory::getSession();
			return $_session;
		}

			
	public function retrievepath ($dgsetup) {
			// first try: get the path from the parameters passed to this function

			$datagrillsetup=$dgsetup['_datagrillsetup'];
			$appPath=$datagrillsetup['appPath'];

			// next try : get the path from Joomla's session cookie

			if (!$appPath) {
				$_session = self::getmysession ();
				$appPath=$_session->get( 'datagrillappPath');
				}

			// next try: get the appId from Xataface's  config table

			if (!$appPath) {
				$app = Dataface_Application::getInstance();
				$conf= $app->conf();
				$datagrillsetup=$conf['_datagrillsetup'];
				$appId=$datagrillsetup['appPath'];
				}

		
			// if still no appId -> error
			if (!$appPath) {
				die ('Error initialising application: could not determine application path');
				}
		return $appPath;
	}

	public function retrieveID ($dgsetup=null){
	
			// first try: get the appId from the parameters passed to this function

			$datagrillsetup=$dgsetup['_datagrillsetup'];
			$appId=$datagrillsetup['appId'];

			// next try : get the appId from Joomla's session cookie

			if (!$appId) {
				$_session = self::getmysession ();
				$appId=$_session->get( 'datagrillappId');
				}

			// next try: get the appId from Xataface's  config table

			if (!$appId) {
				$app = Dataface_Application::getInstance();
				$conf= $app->conf();
				$datagrillsetup=$conf['_datagrillsetup'];
				$appId=$datagrillsetup['appId'];
				}

		
			// if still no appId -> error
			if (!$appId) {
				die ('Error initialising application: could not determine ID');
				}
		return $appId;
	}


	public function getuserpermissions ()  {
		$appId= datagrillhelper::retrieveID();
		$possiblepermissions=parse_ini_file('xataface/permissions.ini');			
		$user = &JFactory::getUser(); 
			foreach ($possiblepermissions as $permission=>$option)	{
			$asset='com_datagrill.your_database_application.'.(int) $appId;
			$joomlapermission='datagrill.'.$permission;
			if ($user->authorise($joomlapermission,$asset)){
				$userpemissions[$permission]=1;
				} else { 
				$userpemissions[$permission]=0;
				}
			}	
	 	return ($userpemissions);
	}


	public function getconfig ($dgsetup=null ) {


		$appId = datagrillhelper::retrieveID($dgsetup);

		// using the found appId; get the rest of the configuration out of joomla's database
	
		$db = JFactory::getDbo();
		$query = $db->getQuery(true); 
		$query->select($db->quoteName(array('server','dbname','username','userpw')));
		$query->from($db->quoteName('#__datagrillapplication'));
		$query->where($db->quoteName('id') . ' = '. $appId);
		$db->setQuery($query);
		$db->execute();
		$result=$db->loadAssoc();

		$database['host']=$result['server'];
		$database['name']=$result['dbname'];
		$database['user']=$result['username'];
		$database['password']=$result['userpw'];

		$conf['_database']=$database;		// store the found config

		// now check which tables are configured for this app
		
		$db = JFactory::getDbo();
		$query = $db->getQuery(true); 
		$query->select($db->quoteName(array('your_database_application','title','description')));
		$query->from($db->quoteName('#__datagrilltable'));
		$query->where($db->quoteName('your_database_application') . ' = '. $appId);
		$db->setQuery($query);
		$db->execute();
		$result=$db->loadRowList();
		
		foreach ($result as $table){		// transform the array :
			$tables[$table[1]] = $table[2];  // index '1' is the title and index '2' is the description
			}				 // now the index is the title, and the value is the description

		$conf['_tables']=$tables;		// store the found tables


		return $conf;				// pass back everything found
	}


}
