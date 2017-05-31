<?php
/**
 * @package     Galaxiis
 * @subpackage  Galaxiis
 *
 * @copyright   Copyright (C) 2013-2016 galaxiis.com All rights reserved.
 * @license     The author and holder of the copyright of the software is Cédric Walter. The licensor and as such issuer of the license and bearer of the
 *              worldwide exclusive usage rights including the rights to reproduce, distribute and make the software available to the public
 *              in any form is Galaxiis.com
 *              see LICENSE.txt
 */

defined('_JEXEC') or die;

class JFormFieldSmugmugconfigchecker extends JFormField
{

	protected $type = 'smugmugconfigchecker';

	protected function getInput()
	{

		$params = JComponentHelper::getParams("com_cedsmugmug");
		$baseUrl = $params->get('baseUrl');
		$nickname = $params->get('nickname');

		if (sizeof($baseUrl) == 0 || sizeof($nickname) == 0) {
			$html   = array();
			$html[] = '<div class="alert alert-block">';
			$html[] = '<button type="button" class="close" data-dismiss="alert">&times;</button>';
			$html[] = '<strong>' . JText::_('You need to fill up your Smugmug Nickname and Base URL') . '</strong>';
			$html[] = '<a target="_new" href="index.php?option=com_config&view=component&component=com_cedsmugmug"> Set Smugmug Nickname and Base URL</a>';
			$html[] = '</div>';
			echo implode('', $html);

			return;
		}

	}

	protected function getLabel()
	{
	}

}
