<?php
/**
 * @copyright    Copyright (C) 2010-2012 Cedric Walter. All rights reserved.
 *    www.waltercedric.com / www.cedricwalter.com
 * @license        GNU General Public License version 3 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

class CedsmugmugController extends JController
{

    protected $default_view = 'frontpage';

    function display()
    {
        $view = JFactory::getApplication()->input->get('view');
        if (!isset($view)) {
            JFactory::getApplication()->input->set('view', 'frontpage');
        }
        parent::display();
    }

}
