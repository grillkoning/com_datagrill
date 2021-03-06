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
 * HTML View class for the datagrill Component
 *
 * @since  0.0.1
 */
class DatagrillViewApplication extends JViewLegacy
{

public $kickoff;


	/**
	 * Display the datagrill view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	function display($tpl = null)
	{
		// Assign data to the view
		// $this->msg = $this->get('Msg');
 		$app    = JFactory::getApplication();
		$params = $app->getParams();
		$title = $params->get('page_title', '');
		$appUrl = $this->get('appUrl');
		$appPath = $this->get('appPath');
		$appId = $this->get('appId');
		$kickOffurl=$appUrl.'/kickoff.php?appId='.$appId.'&appPath='.$appPath;

		if (empty($title))
			{
			$title = $app->get('sitename');
			}
		elseif ($app->get('sitename_pagetitles', 0) == 1)
			{
			$title = JText::sprintf('JPAGETITLE', $app->get('sitename'), $title);
			}
		elseif ($app->get('sitename_pagetitles', 0) == 2)
			{
			$title = JText::sprintf('JPAGETITLE', $title, $app->get('sitename'));
			}

		$this->document->setTitle($title);

		if ($params->get('menu-meta_description'))
			{
			$this->document->setDescription($params->get('menu-meta_description'));
			}

		if ($params->get('menu-meta_keywords'))
			{
			$this->document->setMetadata('keywords', $params->get('menu-meta_keywords'));
			}

		if ($params->get('robots'))
			{
			$this->document->setMetadata('robots', $params->get('robots'));
			}

		$wrapper = new stdClass;
		$wrapper->load = 'onload="iFrameHeight(1200)"';
		$wrapper->url = $kickOffurl;
		$this->pageclass_sfx = htmlspecialchars($params->get('pageclass_sfx'));
		$this->params        = &$params;
		$this->wrapper       = &$wrapper;
		// Display the view


		parent::display($tpl);
	}
}
