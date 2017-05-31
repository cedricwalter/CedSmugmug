<?php
/**
 * @package     Galaxiis updater
 *
 * @copyright   Copyright (C) 2013-2016 galaxiis.com All rights reserved.
 * @license     The author and holder of the copyright of the software is Cédric Walter. The licensor and as such issuer of the license and bearer of the
 *              worldwide exclusive usage rights including the rights to reproduce, distribute and make the software available to the public
 *              in any form is Galaxiis.com
 *              see LICENSE.txt
 */

defined('_JEXEC') or die;

class PlgInstallerGalaxiis extends JPlugin
{

	private $baseUrl = "https://www.galaxiis.com";

	/**
	 * Handle adding credentials to package download request
	 *
	 * @param   string $url url from which package is going to be downloaded
	 * @param   array $headers headers to be sent along the download request (key => value format)
	 *
	 * @return  boolean true if credentials have been added to request or not our business, false otherwise (credentials not set by user)
	 *
	 * @since   2.5
	 */
	public function onInstallerBeforePackageDownload(&$url, &$headers)
	{

		// are we trying to update our extension?
		if (strpos($url, $this->baseUrl) !== 0) {
			return true;
		}

		$downloadId = $this->params->get('download-id', '');

		// bind credentials to request by appending it to the download url
		if (preg_match('/^([0-9]{1,}:)?[0-9a-f]{32}$/i', $downloadId)) {
			$separator = strpos($url, '?') !== false ? '&' : '?';
			$url .= $separator . 'dlid=' . $downloadId;
		}

		return true;
	}
}
