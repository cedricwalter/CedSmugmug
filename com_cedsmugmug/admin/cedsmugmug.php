<?php
/**
 * @package		cedSmugmug for Joomla
 * @copyright	Copyright (C) 2010-2012 Cedric Walter. All rights reserved.
 *    www.waltercedric.com / www.cedricwalter.com
 * @license		GNU General Public License version 3 or later; see LICENSE.txt
*/
// no direct access
defined('_JEXEC') or die;

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_cedsmugmug')) {
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// Include dependencies
jimport('joomla.application.component.controller');

$document = & JFactory::getDocument();
$document->addStyleSheet(JURI::root() . '/media/com_cedsmugmug/css/smugmug.css');


$controller = JController::getInstance('Cedsmugmug');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();
