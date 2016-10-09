<?php
/**
 * @author		
 * @copyright	
 * @license		
 */

defined("_JEXEC") or die("Restricted access");

/**
 * Datagrill Component Route Helper
 *
 * @package     Datagrill
 * @subpackage  Helpers
 */
abstract class DatagrillHelperRoute
{
	protected static $lookup;

	protected static $lang_lookup = array();

	public static function getCategoryRoute($catid, $language = 0, $layout = "")
	{
		if ($catid instanceof JCategoryNode)
		{
			$id = $catid->id;
			$category = $catid;
		}
		else
		{
			$id = (int) $catid;
			$category = JCategories::getInstance('Datagrill')->get($id);
		}

		if ($id < 1 || !($category instanceof JCategoryNode))
		{
			$link = '';
		}
		else
		{
			$needles = array();

			// Create the link
			$link = 'index.php?option=com_datagrill&view=category&id='.$id;

			$catids = array_reverse($category->getPath());
			$needles['category'] = $catids;
			$needles['categories'] = $catids;
				
			if ($layout != "")
			{
				$link .= "&layout=" . $layout;
			}

			if ($item = self::_findItem($needles))
			{
				$link .= '&Itemid='.$item;
			}
		}

		return $link;
	}

	/**
	 * @param   integer  The route of the content item
	 */
	public static function getYour_Database_ApplicationRoute($id, $catid = 0, $language = 0)
	{
		$needles = array(
			'your_database_application'  => array((int) $id)
		);
		//Create the link
		$link = 'index.php?option=com_datagrill&view=your_database_application&id='. $id;
		if ((int) $catid > 1)
		{
			$categories = JCategories::getInstance('Datagrill');
			$category = $categories->get((int) $catid);
			if ($category)
			{
				$needles['category'] = array_reverse($category->getPath());
				$needles['categories'] = $needles['category'];
				$link .= '&catid='.$catid;
			}
		}

		if ($item = self::_findItem($needles))
		{
			$link .= '&Itemid='.$item;
		}

		return $link;
	}

	/**
	 * @param   integer  The route of the content item
	 */
	public static function getYour_Database_TableRoute($id, $catid = 0, $language = 0)
	{
		$needles = array(
			'your_database_table'  => array((int) $id)
		);
		//Create the link
		$link = 'index.php?option=com_datagrill&view=your_database_table&id='. $id;

		if ($item = self::_findItem($needles))
		{
			$link .= '&Itemid='.$item;
		}

		return $link;
	}

	protected static function _findItem($needles = null)
	{
		$app		= JFactory::getApplication();
		$menus		= $app->getMenu('site');
		$language	= isset($needles['language']) ? $needles['language'] : '*';

		// Prepare the reverse lookup array.
		if (!isset(self::$lookup[$language]))
		{
			self::$lookup[$language] = array();

			$component	= JComponentHelper::getComponent('com_datagrill');

			$attributes = array('component_id');
			$values = array($component->id);

			if ($language != '*')
			{
				$attributes[] = 'language';
				$values[] = array($needles['language'], '*');
			}

			$items = $menus->getItems($attributes, $values);

			foreach ($items as $item)
			{
				if (isset($item->query) && isset($item->query['view']))
				{
					$view = $item->query['view'];
				if (!isset(self::$lookup[$language][$view]))
					{
						self::$lookup[$language][$view] = array();
					}
					if (isset($item->query['id']))
					{

						// here it will become a bit tricky
						// language != * can override existing entries
						// language == * cannot override existing entries
						if (!isset(self::$lookup[$language][$view][$item->query['id']]) || $item->language != '*')
						{
							self::$lookup[$language][$view][$item->query['id']] = $item->id;
						}
					}
				}
			}
		}

		if ($needles)
		{
			foreach ($needles as $view => $ids)
			{
				if (isset(self::$lookup[$language][$view]))
				{
					foreach ($ids as $id)
					{
						if (isset(self::$lookup[$language][$view][(int) $id]))
						{
							return self::$lookup[$language][$view][(int) $id];
						}
					}
				}
			}
		}

		// Check if the active menuitem matches the requested language
		$active = $menus->getActive();
		if ($active && ($language == '*' || in_array($active->language, array('*', $language)) || !JLanguageMultilang::isEnabled()))
		{
			return $active->id;
		}

		// If not found, return language specific home link
		$default = $menus->getDefault($language);
		return !empty($default->id) ? $default->id : null;
	}
}
