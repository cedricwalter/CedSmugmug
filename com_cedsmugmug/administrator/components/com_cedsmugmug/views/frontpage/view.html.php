<?php
/**
 * @package     cedSmugMug
 * @subpackage  com_cedsmugmug
 *
 * @copyright   Copyright (C) 2013-2016 galaxiis.com All rights reserved.
 * @license     The author and holder of the copyright of the software is Cédric Walter. The licensor and as such issuer of the license and bearer of the
 *              worldwide exclusive usage rights including the rights to reproduce, distribute and make the software available to the public
 *              in any form is Galaxiis.com
 *              see LICENSE.txt
 * @id ${licenseId}
 */

defined('_JEXEC') or die();

jimport('joomla.application.component.view');

class CedSmugmugViewFrontpage extends JViewLegacy
{
    /**
   	 * Display the view
   	 *
   	 * @return	mixed	False on error, null otherwise.
   	 */
   	function display($tpl = null)
    {
        $this->defaultTpl($tpl);
    }

    function defaultTpl($tpl = null)
    {
        JToolBarHelper::title(JText::_('CedSmugmug'), 'tag.png');

        $user = JFactory::getUser();
        if ($user->authorise('core.admin', 'com_cedsmugmug'))
        {
            JToolbarHelper::preferences('com_cedsmugmug');
        }

        parent::display($tpl);
    }
}
