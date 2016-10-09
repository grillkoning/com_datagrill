<?php
/**
 * @author		
 * @copyright	
 * @license		
 */

defined("_JEXEC") or die("Restricted access");

/**
 * List Model for applications.
 *
 * @package     Datagrill
 * @subpackage  Models
 */
class DatagrillModelApplications extends JModelList
{
	/**
	 * Constructor.
	 *
	 * @param   array  $config  An optional associative array of configuration settings.
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'a.title', 'title',
				'a.catid', 'catid', 'category_id', 'category_title','state'
			);
		}
		parent::__construct($config);
	}
	
	/**
	 * Method to auto-populate the model state.
	 *
	 * This method should only be called once per instantiation and is designed
	 * to be called on the first call to the getState() method unless the model
	 * configuration flag to ignore the request is set.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @param   string  $ordering   An optional ordering field.
	 * @param   string  $direction  An optional direction (asc|desc).
	 *
	 * @return  void
	 */
	protected function populateState($ordering = 'title', $direction = 'ASC')
	{
		// Get the Application
		$app = JFactory::getApplication();
		$menu = $app->getMenu();
		
		// Set filter state for search
        $search = $app->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
        $this->setState('filter.search', $search);

		// Set filter state for category
		$categoryId = $this->getUserStateFromRequest($this->context . '.filter.category_id', 'filter_category_id');
		$this->setState('filter.category_id', $categoryId);

		// Load the parameters.
		$params = JComponentHelper::getParams('com_datagrill');
		$active = $menu->getActive();
		empty($active) ? null : $params->merge($active->params);
		$this->setState('params', $params);

		// List state information.
		parent::populateState($ordering, $direction);
	}
	
	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param   string  $id  A prefix for the store id.
	 *
	 * @return  string  A store id.
	 *
	 * @since   1.6
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id .= ':' . $this->getState('filter.search');
		$id .= ':' . $this->getState('filter.category_id');

		return parent::getStoreId($id);
	}

	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return  JDatabaseQuery
	 */
	protected function getListQuery()
	{
		// Get database object
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$query->select('a.*')->from('#__datagrillapplication AS a');
			
		// Join over the categories.
		$query->select('c.title AS category_title, c.path AS category_route, c.access AS category_access, c.alias AS category_alias')
			->join('LEFT', '#__categories AS c ON c.id = a.catid');

		// Join over the categories to get parent category titles
		$query->select('parent.title as parent_title, parent.id as parent_id, parent.path as parent_route, parent.alias as parent_alias')
			->join('LEFT', '#__categories as parent ON parent.id = c.parent_id');

		// Filter by search
		$search = $this->getState('filter.search');
		$s = $db->quote('%'.$db->escape($search, true).'%');
		
		if (!empty($search))
		{
			if (stripos($search, 'id:') === 0)
			{
				$query->where('a.id = ' . (int) substr($search, strlen('id:')));
			}
			elseif (stripos($search, 'title:') === 0)
			{
				$search = $db->quote('%' . $db->escape(substr($search, strlen('title:')), true) . '%');
				$query->where('(a.title LIKE ' . $search);
			}
			else
			{
				$search = $db->quote('%' . $db->escape($search, true) . '%');
				
			}
		}
		
		// Filter by category
		$categoryId = $this->getState('filter.category_id');
		if (is_numeric($categoryId))
		{
			$query->where('a.catid = '.(int) $categoryId);
		}
		
		// Implement View Level Access
		$user = JFactory::getUser();
		if (!$user->authorise('core.admin'))
		{
			$groups = implode(',', $user->getAuthorisedViewLevels());
			$query->where('c.access IN (' . $groups . ')');
		}
		
		// Add list oredring and list direction to SQL query
		$sort = $this->getState('list.ordering', 'title');
		$order = $this->getState('list.direction', 'ASC');
		$query->order($db->escape($sort).' '.$db->escape($order));
		
		return $query;
	}
	
	/**
	 * Method to get an array of data items.
	 *
	 * @return  mixed  An array of data items on success, false on failure.
	 *
	 * @since   12.2
	 */
	public function getItems()
	{
		if ($items = parent::getItems()) {
			//Do any procesing on fields here if needed
		}

		return $items;
	}
}
?>