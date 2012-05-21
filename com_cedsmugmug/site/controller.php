<?php
/**
 * @package		cedSmugmug for Joomla
 * @copyright	Copyright (C) 2010-2012 Cedric Walter. All rights reserved.
 *    www.waltercedric.com / www.cedricwalter.com
 * @license		GNU General Public License version 3 or later; see LICENSE.txt
*/
// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

/**
 * Content Component Controller
 *
 * @package		Joomla.Site
 * @subpackage	com_content
 * @since		1.5
 */
class CedsmugmugController extends JController
{
	function __construct($config = array())
	{
		// Article frontpage Editor pagebreak proxying:
		if (JRequest::getCmd('view') === 'article' && JRequest::getCmd('layout') === 'pagebreak') {
			$config['base_path'] = JPATH_COMPONENT_ADMINISTRATOR;
		}

		parent::__construct($config);
	}

}
