<?php
/**
 * @package     CedSmugMug
 * @subpackage  com_cedsmugmug
 *
 * @copyright   Copyright (C) 2013-2017 galaxiis.com All rights reserved.
 * @license     The author and holder of the copyright of the software is Cédric Walter. The licensor and as such issuer of the license and bearer of the
 *              worldwide exclusive usage rights including the rights to reproduce, distribute and make the software available to the public
 *              in any form is Galaxiis.com
 *              see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class plgButtonCedsmugmugrandom extends JPlugin
{
	protected $autoloadLanguage = true;

	public function onDisplay($name)
	{
		$user  = JFactory::getUser();

		if ($user->authorise('core.create', 'com_content')
			|| $user->authorise('core.edit', 'com_content')
			|| $user->authorise('core.edit.own', 'com_content'))
		{
            $link = 'index.php?option=com_cedsmugmug&amp;view=article&amp;layout=smugmugrandom&amp;template=component&amp;e_name=' . $name;
            JHtml::_('behavior.modal');
            $button = new JObject;
            $button->modal = true;
            $button->class = 'btn';
            $button->link = $link;
            $button->text = JText::_('CedSmugmugRandom');
            $button->name = 'picture';
            $button->options = "{handler: 'iframe', size: {x: 800, y: 500}}";

            return $button;
        }
    }

}