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

// Don't allow direct access to the module.
defined('_JEXEC') or die('Restricted access');

jimport('joomla.html.parameter');
jimport('joomla.plugin.plugin');

require_once(dirname(__FILE__) . '/cedsmugmugslideshowparser.php');

class plgContentCedSmugMugSlideShow extends JPlugin
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

        if ($this->params->get('demo')) {
            $row->text .= '<h2>Plugin CedSmugMugSlideShow in demo mode</h2>
            <font color="red">Note if you copy some example below, add the { in front of smugmugslideshow to let the magic happens!</font><br />
            smugmugslideshow uri=http://api.smugmug.com/hack/feed.mg?Type=gallery&Data=7421071_53xgf&format=rss200 id=7421071 key=53xgf}
            <br />
            {smugmugslideshow uri=http://api.smugmug.com/hack/feed.mg?Type=gallery&Data=7421071_53xgf&format=rss200 id=7421071 key=53xgf}';
        }

        //simple performance check to determine whether bot should process further
        if (strpos($row->text, '{smugmugslideshow') === false) {
            return;
        }

        $parser = new plgContentCedSmugMugSlideShowParser();

        $models = $parser->parse($row->text, false);
        foreach ($models as $model) {
            $html = $this->doFlash($model->albumId, $model->albumKey);
            $row->text = str_replace($model->matches, $html, $row->text);
        }

        return;
    }

    public function doFlash($albumID, $albumKey)
    {
        $params = $this->params;

        $width = $params->get('width', 400);
        $height = $params->get('height', 400);
        $pageStyle = $params->get('pageStyle', 'white');
        $showSpeed = $params->get('showSpeed') == 1 ? 'true' : 'false';
        $autoStart = $params->get('autoStart') == 1 ? 'true' : 'false';
        $captions = $params->get('captions') == 1 ? 'true' : 'false';
        $showLogo = $params->get('showLogo') == 1 ? 'true' : 'false';
        $clickToImage = $params->get('clickToImage') == 1 ? 'true' : 'false';
        $splashurl = $params->get('splashurl');
        $showThumbs = $params->get('showThumbs') == 1 ? 'true' : 'false';
        $showStartButton = $params->get('showStartButton') == 1 ? 'true' : 'false';
        $showButtons = $params->get('showButtons') == 1 ? 'true' : 'false';
        $transparent = $params->get('transparent') == 1 ? 'true' : 'false';
        $bgColor = $params->get('bgColor');
        $crossFadeSpeed = $params->get('crossFadeSpeed');
        $randomStart = $params->get('randomStart') == 1 ? 'true' : 'false';
        $randomize = $params->get('randomize') == 1 ? 'true' : 'false';
        $borderThickness = $params->get('borderThickness');
        $borderColor = $params->get('borderColor');
        $forceSize = $params->get('forceSize');

        $flashvars = "AlbumID=$albumID&AlbumKey=$albumKey&transparent=$transparent&bgColor=$bgColor&borderThickness=$borderThickness&borderColor=$borderColor&useInside=&endPoint=&mainHost=cdn.smugmug.com&VersionNos=2013072402&width=$width&height=$height&clickToImage=$clickToImage&captions=$captions&showThumbs=$showThumbs&autoStart=$autoStart&showSpeed=$showSpeed&pageStyle=$pageStyle&showButtons=$showButtons&randomStart=$randomStart&randomize=$randomize&splash=http%3A%2F%2Fwww.smugmug.com%2Fimg%2Fria%2FShizamSlides%2Fsmugmug_black.png&splashDelay=0&crossFadeSpeed=$crossFadeSpeed";

        $html = '<!-- module by Galaxiis - http://www.galaxiis.com - copyright 2014 -->
        <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="' . $width . '" height="' . $height . '" id="ssidx">
            <param name="movie" value="https://cdn.smugmug.com/ria/ShizamSlides-2013072402.swf"/>
            <param name="flashVars"
                   value="' . $flashvars . '"/>
            <param name="wmode" value="transparent"/>
            <param name="allowNetworking" value="all"/>
            <param name="allowScriptAccess" value="always"/>
            <embed src="http://cdn.smugmug.com/ria/ShizamSlides-2013072402.swf"
                   flashVars="' . $flashvars . '"
                   width="' . $width . '" height="' . $height . '" wmode="transparent" type="application/x-shockwave-flash" allowScriptAccess="always"
                   allowNetworking="all"></embed>
        </object>';

        $html .= '<div class="plgSmugMugRandomLink"><a hef="www.galaxiis.com/cedsmugmug-showcase" target="new">CedSmugmug</a></div>';

        return $html;
    }
}
