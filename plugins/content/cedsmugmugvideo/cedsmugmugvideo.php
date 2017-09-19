<?php
/**
 * @package     cedSmugMug
 * @subpackage  com_cedsmugmug
 *
 * @copyright   Copyright (C) 2013-2017 galaxiis.com All rights reserved.
 * @license     The author and holder of the copyright of the software is Cédric Walter. The licensor and as such issuer of the license and bearer of the
 *              worldwide exclusive usage rights including the rights to reproduce, distribute and make the software available to the public
 *              in any form is Galaxiis.com
 *              see LICENSE.txt
 * @id ${licenseId}
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');
jimport('joomla.html.parameter');

require_once(dirname(__FILE__) . '/smugmugvideoparser.php');

class plgContentCedSmugMugVideo extends JPlugin
{
	protected $autoloadLanguage = true;

	function onContentPrepare($context, &$row, &$params, $page = 0)
	{
		//Do not run in admin area and non HTML  (rss, json, error)
		$app = JFactory::getApplication();
		if ($app->isClient('administrator') || JFactory::getDocument()->getType() !== 'html')
		{
			return;
		}

		if (intval($this->params->get('demo', '0'))) {
			$row->text .= "<h1>".JText::_('PLG_CONTENT_CEDSMUGMUGVIDEO_DEMO')."</h1>";
			$row->text .= "<h2>".JText::_('PLG_CONTENT_CEDSMUGMUGVIDEO_DEMO_NOTE')."</h2>";

			$row->text .= "<h3>".JText::_('PLG_CONTENT_CEDSMUGMUGVIDEO_DEMO_EX1')."</h3>";
			$row->text .= "{smugmugvideo 7421071_53xgf}";

			$row->text .= "<h3>".JText::_('PLG_CONTENT_CEDSMUGMUGVIDEO_DEMO_EX2')."</h3>";
			$row->text .= "{smugmugvideo 7421071_53xgf S}";

			$row->text .= "<h3>".JText::_('PLG_CONTENT_CEDSMUGMUGVIDEO_DEMO_EX3')."</h3>";
			$row->text .= "{smugmugvideo 7421071_53xgf 300 400}";
		}

		//simple performance check to determine whether bot should process further
		if (strpos($row->text, '{smugmugvideo') === false) {
			return;
		}

		$defaultSize = $this->params->get('defaultSize', 'S');
		$defaultWidth = intval($this->params->get('defaultWidth', 425));
		$defaultHeight = intval($this->params->get('defaultHeight', 318));

		$parser = new plgContentSmugmugVideoParser($defaultSize, $defaultWidth, $defaultHeight);

		$document = JFactory::getDocument();
		$document->addStyleSheet(JUri::base().'/media/plg_content_smugmugrandom/plgSmugMugRandom.css?v=3.2.6');

		$models = $parser->parse($row->text);
		foreach ($models as $model) {
			$html = $this->init($model->movieId, $model->movieKey, $model->width, $model->height);
			$row->text = str_replace($model->matches, $html, $row->text);
		}
		return;
	}

	private function init($movieId, $movieKey, $width = 640, $height = 480)
	{
		$flashVar = "e=1&i=$movieId&k=$movieKey";
		$flashVarEncoded = base64_encode($flashVar);

		$protocol = JFactory::getApplication()->isSSLConnection() ? "https" : "http";

		$html = '<!-- Copyright (C) 2013-2017 galaxiis.com All rights reserved. -->';
		$html .= '<div class="plgSmugMugVideo">';
		$html .= "<object width=\"$width\" height=\"$height\">
            <param name=\"movie\" value=\"".$protocol."://cdn.smugmug.com/ria/ShizVidz-2008042602.swf\" />
            <param name=\"allowFullScreen\" value=\"true\" />
            <param name=\"allowScriptAccess\" value=\"always\" />
            <param name=\"flashVars\" value=\"s=$flashVarEncoded\" />
              <embed src=\"".$protocol."://cdn.smugmug.com/ria/ShizVidz-2008042602.swf\" flashVars=\"s=$flashVarEncoded\" width=\"$width\" height=\"$height\" type=\"application/x-shockwave-flash\" allowFullScreen=\"true\" allowScriptAccess=\"always\"></embed>
            </object>";

		$html .= '<div class="plgSmugMugRandomLink"><a hef="www.galaxiis.com/cedsmugmug-showcase" target="new">CedSmugmug</a></div>';

		return $html;
	}

}

?>