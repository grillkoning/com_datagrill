<?php

define(DS, '/');

ini_set('display_errors', "off");

$mypath=__DIR__  ;  
$joomlapath = substr ($mypath,0,strlen($mypath)-30);
define('JPATH_BASE', $joomlapath);

require_once "xataface/public-api.php";
require_once(JPATH_BASE.'/components/com_datagrill/helpers/datagrillhelper.php');
 
$dgsetup['appId'] = htmlspecialchars($_GET["appId"]);
$dgsetup['appPath'] = htmlspecialchars($_GET["appPath"]);


	
if ($dgsetup['appId']> '') {				// if configuration is given, 
	$conf['_datagrillsetup'] =$dgsetup;		// store this in xataface's configuration variable for later use,
							// because xataface is in an iFrame window and cannot look out
	
	$_session = datagrillhelper::getmysession ();   // Also store it in joomla's session cookie, for when the page gets reloaded 
	$_session->set( 'datagrillappId', $dgsetup['appId'] );// and it needs to be accessed from outside the iFrame
	$_session->set ('datagrillappPath',$dgsetup['appPath']);
	}

$conf=datagrillhelper::getconfig($conf);


df_init(datagrillhelper::retrievepath().'/kickoff.php', "xataface",$conf)->display();
