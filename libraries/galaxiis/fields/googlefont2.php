<?php

defined('JPATH_BASE') or die;

jimport('joomla.html.html');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

class JFormFieldGooglefont2 extends JFormFieldList {

	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'googlefont2';

	// Google API key
	const GOOGLE_API_KEY = 'AIzaSyDCuX9p0CoInlBnfj_YmrtxFizvQ5sT1Cs';

	/**
	 * Generate dropdown options
	 */
	public function getOptions()
	{
		// Initialize variables.
		$options = array();

		$url          = 'https://www.googleapis.com/webfonts/v1/webfonts?key=' . self::GOOGLE_API_KEY;

		//	extension=php_openssl.dll
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
				$options[] = JHtml::_('select.option', '', 'ERROR: Wrong URL or google API KEY?');
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
		if (isset($decodedResponse->items))
		{
			$options[] = JHtml::_('select.option', '', '- Select font -');
			foreach ($decodedResponse->items as $font)
			{
				// replace spaces with + in option value
				$value     = str_replace(' ', '+', $font->family);
				$options[] = JHtml::_('select.option', $value, $font->family);
			}
		}
		else
		{
			$options[] = JHtml::_('select.option', '', 'ERROR: None or bad JSON received');
		}

		return $options;
	}

}