<?php
/**
 * @package		cedSmugmug for Joomla
 * @copyright	Copyright (C) 2010-2012 Cedric Walter. All rights reserved.
 *    www.waltercedric.com / www.cedricwalter.com
 * @license		GNU General Public License version 3 or later; see LICENSE.txt
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
