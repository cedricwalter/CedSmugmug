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

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class CedsmugmugViewArticle extends JViewLegacy
{
    protected $form;
    protected $item;
    protected $state;

    /**
   	 * Display the view
   	 *
   	 * @return	mixed	False on error, null otherwise.
   	 */
   	function display($tpl = null)
    {
        if ($this->getLayout() == 'smugmugslideshow' ||
            $this->getLayout() == 'photofeed' ||
            $this->getLayout() == 'smugmugbadge' ||
            $this->getLayout() == 'smugmugvideo' ||
            $this->getLayout() == 'smugmugrandom') {
            // TODO: This is really dogy - should change this one day.
            $eName = JFactory::getApplication()->input->get('e_name', null, 'string');
            $eName = preg_replace('#[^A-Z0-9\-\_\[\]]#i', '', $eName);
            $document = JFactory::getDocument();
            $document->setTitle(JText::_('COM_CONTENT_PAGEBREAK_DOC_TITLE'));
            $this->eName = $eName;
            parent::display($tpl);
            return;
        }


    }

}
