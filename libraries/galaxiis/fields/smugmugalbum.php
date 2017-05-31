<?php

defined('JPATH_BASE') or die;

jimport('joomla.html.html');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

class JFormFieldSmugmugalbum extends JFormFieldList {

	protected $type = 'smugmugalbum';

	const API_KEY = 'KNMfT673Xj3DvtnfXKMq7cCsgRQnfVKz';

	/**
	 * Generate dropdown options
	 */
	public function getOptions()
	{
		// Initialize variables.
		$options = array();

		$params = JComponentHelper::getParams("com_cedsmugmug");
		$nickname = $params->get('nickname');

		$url          = 'https://api.smugmug.com/api/v2/user/' . $nickname . '!albums?APIKey=' . self::API_KEY . '&_accept=application%2Fjson';

		//	require extension=php_openssl.dll
		//	allow_url_include = On
		$jsonResponse = @file_get_contents($url);
		if ($jsonResponse) {
			$options = $this->decodeResponse($jsonResponse, $options);
		} else {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_REFERER, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			$jsonResponse = curl_exec($ch);
			curl_close($ch);
			if ($jsonResponse) {
				$options = $this->decodeResponse($jsonResponse, $options);
			}
			else
			{
				$options[] = JHtml::_('select.option', '', 'ERROR: Wrong URL or smugmug API KEY?');
			}
		}

		return $options;
	}

	/**
	 * @param $jsonResponse
	 * @param $options
	 *
	 * @return array
	 */
	private function decodeResponse($jsonResponse, $options): array
	{
		$decodedResponse = json_decode($jsonResponse);
		if (isset($decodedResponse->Response->Album))
		{
			$options[] = JHtml::_('select.option', '', '- Select Gallery -');
			foreach ($decodedResponse->Response->Album as $album)
			{
				$value     = str_replace(' ', '+', $album->AlbumKey);
				$options[] = JHtml::_('select.option', $value, $album->NiceName);
			}
		}

		return $options;
	}

}