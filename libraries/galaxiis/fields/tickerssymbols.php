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

//namespace Galaxiis\Joomla\Content\Fields\Cloud;

defined('JPATH_PLATFORM') or die;

jimport('joomla.form.formfield');


class JFormFieldTickersSymbols extends JFormField
{
	protected $type = 'TickersSymbols';

	public function getInput()
	{
		// Including fallback code for HTML5 non supported browsers.
		JHtml::_('jquery.framework');
//		JHtml::_('jquery.ui');
		JHtml::_('script', 'media/jui/js/jquery.autocomplete.min.js', false, false, false, false, true);

		JHtml::_('script', 'system/html5fallback.js', false, true);

		$document = JFactory::getDocument();
		$document->addScript(JUri::root()."media/galaxiis/assets/js/stocks-ticker.js");

		$this->value = (array) $this->value;

		return '<input id="txtTicker" class="txtTicker" type="text">';
	}


}
