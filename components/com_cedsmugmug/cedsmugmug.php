<?php
/**
 * @package		cedSmugmug for Joomla
 * @copyright	Copyright (C) 2010-2012 Cedric Walter. All rights reserved.
 *    www.waltercedric.com / www.cedricwalter.com
 * @license		GNU General Public License version 3 or later; see LICENSE.txt
*/
// no direct access
defined('_JEXEC') or die;

$document = JFactory::getDocument();
$document->addStyleSheet(JURI::root() . '/media/com_cedsmugmug/css/smugmug.css');

$controller = JControllerLegacy::getInstance('Cedsmugmug');
$task = JFactory::getApplication()->input->get('task', 'default', 'string');
$controller->execute($task);
$controller->redirect();
