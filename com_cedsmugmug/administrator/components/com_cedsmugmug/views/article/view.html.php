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

class CedsmugmugViewArticle extends JView
{
    protected $form;
    protected $item;
    protected $state;

    /**
     * Display the view
     */
    public function display($tpl = null)
    {

        if ($this->getLayout() == 'smugmugslideshow' ||
            $this->getLayout() == 'photofeed' ||
            $this->getLayout() == 'smugmugrandom') {
            // TODO: This is really dogy - should change this one day.
            $eName = JRequest::getVar('e_name');
            $eName = preg_replace('#[^A-Z0-9\-\_\[\]]#i', '', $eName);
            $document = JFactory::getDocument();
            $document->setTitle(JText::_('COM_CONTENT_PAGEBREAK_DOC_TITLE'));
            $this->assignRef('eName', $eName);
            parent::display($tpl);
            return;
        }


    }

}
