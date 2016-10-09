<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_wrapper
 
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
JHtml::script('com_wrapper/iframe-height.min.js', false, true);
$xatapath=JPATH_COMPONENT_SITE.'/xataface';
$xataApi=$xatapath.'/dataface-public-api.php';
require_once ($xataApi);
?>
<div class="contentpane<?php echo $this->pageclass_sfx; ?>">

<iframe <?php echo $this->wrapper->load; ?>
	id="blockrandom"
	name="iframe"
	src="<?php echo $this->escape($this->wrapper->url); ?>"
	width="100%"
	height="1600"
	frameborder="no"
	class="wrapper<?php echo $this->pageclass_sfx; ?>">
	<?php echo JText::_('COM_WRAPPER_NO_IFRAMES'); ?>
</iframe>
</div>
