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
 * @id          ${licenseId}
 */

// Don't allow direct access to the module.
defined('_JEXEC') or die('Restricted access');

class ModCedSmugMugGalleryHelper
{

	public function render(&$params)
	{
		$document = JFactory::getDocument();

		$document->addScript(JUri::root() . "media/mod_cedsmugmuggallery/js/jquery.nanogallery.min.js");

		$theme = $params->get('theme', 'default');
		if ($theme == 'default')
		{
			$document->addStyleSheet(JUri::root() . "media/mod_cedsmugmuggallery/css/nanogallery.css");
		}
		else
		{
			$document->addStyleSheet(JUri::root() . "media/mod_cedsmugmuggallery/css/themes/$theme/nanogallery_$theme.css");
		}

		$uuid = uniqid();

		$html = "<div id=\"nanoGallery-$uuid\"> <!-- Copyright (C) 2013-2017 galaxiis.com All rights reserved. --></div>";

		$parameters = $this->getNanoParameters($params);
		$document->addScriptDeclaration("jQuery(document).ready(function () {
                      jQuery(\"#nanoGallery-$uuid\").nanoGallery({" . $parameters . "});
                    });");

		return $html;
	}

	/**
	 * @param $params
	 *
	 * @return string
	 */
	private function getNanoParameters(&$params)
	{
		$array         = array();
		$allParameters = $params->toArray();

		// remove some uneeded params
		unset($allParameters['folder']);
		unset($allParameters['layout']);
		unset($allParameters['moduleclass_sfx']);
		unset($allParameters['cache']);
		unset($allParameters['module_tag']);
		unset($allParameters['bootstrap_size']);
		unset($allParameters['header_tag']);
		unset($allParameters['header_class']);
		unset($allParameters['style']);

		$allParameters['kind'] = 'smugmug';

		foreach ($allParameters as $key => $value)
		{

			if ($key == 'slideshowDelay' || $key == 'thumbnailDisplayInterval')
			{
				$value = intval($value) * 1000;
				if ($value < 2000)
				{
					$value = 2000;
				}
			}

			if ($value == 'true')
			{
				$array[] = "$key: true";
			}
			else
			{
				if ($value == 'false')
				{
					$array[] = "$key: false";
				}
				else
				{
					if ($this->isInteger($value))
					{
						$array[] = "$key: $value";
					}
					else
					{
						$array[] = "$key: '$value'";
					}
				}
			}
		}

		$componentParams = JComponentHelper::getParams("com_cedsmugmug");
		$nickName = $componentParams->get("nickname");

		$array[] = "userID: '$nickName'";

		$parameters = implode(",", $array);

		return $parameters;
	}

	// can no use is_int with string "123" would return false
	function isInteger($input)
	{
		return (ctype_digit(strval($input)));
	}

}