<?php
/**
 * @package     cedSmugMug
 * @subpackage  com_cedsmugmug
 *
 * @copyright   Copyright (C) 2013-2017 galaxiis.com All rights reserved.
 * @license     The author and holder of the copyright of the software is Cédric Walter. The licensor and as such issuer of the license and bearer of the
 *              worldwide exclusive usage rights including the rights to reproduce, distribute and make the software available to the public
 *              in any form is Galaxiis.com
 *              see LICENSE.txt
 * @id ${licenseId}
 */

// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

class CedsmugmugController extends JControllerLegacy
{
    protected $default_view = 'frontpage';

    public function display($cachable = false, $urlparams = false)
    {
        $view = JFactory::getApplication()->input->get('view');
        if (!isset($view)) {
            JFactory::getApplication()->input->set('view', 'frontpage');
        }
        return parent::display();
    }

}
