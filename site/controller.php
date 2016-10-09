<?php
/**
 * @author		
 * @copyright	
 * @license		
 */

defined("_JEXEC") or die("Restricted access");

class DatagrillController extends JControllerLegacy
{
	/**
	 * The default view for the display method.
	 *
	 * @var    string
	 * @since  12.2
	 */
	protected $default_view = 'application';

	/**
     * Method to display a view.
     *
     * @param   boolean If true, the view output will be cached
     * @param   array   An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
     *
     * @return  JController	This object to support chaining.
     * @since   1.5
     */
    public function display($cachable = false, $urlparams = false)
	{
		JForm::addFormPath(JPATH_COMPONENT_ADMINISTRATOR . '/models/forms');
		JForm::addFieldPath(JPATH_COMPONENT_ADMINISTRATOR . '/models/fields');

        // Get the document object.
		$document	= JFactory::getDocument();

		// Set the default view name and format from the Request.
		$vName   = $this->input->getCmd('view', 'application');
		$vFormat = $document->getType();
		$lName   = $this->input->getCmd('layout', 'default');
		
		// Get the model and the view
		$model = $this->getModel($vName);
		$view = $this->getView($vName, $vFormat);
		
		// Push the model into the view (as default).
		$view->setModel($model, true);
		$view->setLayout($lName);
		
		// Push document object into the view.
		$view->document = $document;

		// Display the view
		$view->display();
    }

	

	public function initialise($appId) {
		$vName   = $this->input->getCmd('view', 'application');
		$model = $this->getModel($vName);
		$path=$model->getAppPath($appId);
		$kickoff=$path.'/kickoff.php';
		symlink(JPATH_COMPONENT_SITE.'/apps/kickoff.php',$kickoff);
		symlink(JPATH_COMPONENT_SITE.'/xataface',$path.'/xataface');
		symlink(JPATH_COMPONENT_SITE.'/conf',$path.'/conf');
   		return $kickoff; 
	}



}
?>
