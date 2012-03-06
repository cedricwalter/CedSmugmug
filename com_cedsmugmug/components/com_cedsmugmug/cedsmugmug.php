<?php
/**
 * @package		cedSmugmug for Joomla
 * @copyright	Copyright (C) 2010-2012 Cedric Walter. All rights reserved.
 *    www.waltercedric.com / www.cedricwalter.com
 * @license		GNU General Public License version 3 or later; see LICENSE.txt
*/

// no direct access
defined('_JEXEC') or die;

// Include dependancies
jimport('joomla.application.component.controller');

$controller = JController::getInstance('Cedsmugmug');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();
