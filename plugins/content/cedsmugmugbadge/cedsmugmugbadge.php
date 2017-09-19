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


// Don't allow direct access to the module.
defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');
jimport('joomla.html.parameter');

require_once(dirname(__FILE__) . '/parser.php');

class plgContentCedSmugMugBadge extends JPlugin
{

	protected $autoloadLanguage = true;

	public function onContentPrepare($context, &$row, &$params, $page = 0)
	{
		//Do not run in admin area and non HTML  (rss, json, error)
		$app = JFactory::getApplication();
		if ($app->isClient('administrator') || JFactory::getDocument()->getType() !== 'html')
		{
			return;
		}

		if (intval($this->params->get('demo', '0'))) {
			$row->text .= JText::_('PLG_CONTENT_CEDSMUGMUGRANDOM_DEMO');
		}

        $parser = new plgContentCedSmugMugBadgeParser();

        //simple performance check to determine whether bot should process further
        if (!$parser->isActive($row->text)) {
            return;
        }

        $models = $parser->parse($row->text);
        foreach ($models as $model) {
            $html = $this->doForModel($model);

	        $row->text = str_replace($model->matches, $html, $row->text);
        }

        return;
    }

    private function doForModel($parserModel)
    {
        $data = $this->getData($parserModel->url);

        $xml = new SimpleXmlElement($data, LIBXML_NOCDATA);
        if (isset($xml->channel)) {
            $model = $this->parseRSS($xml, $model);

            $html = $this->doSmoothBox($model);
        }

        return $html;
    }

    private function getData($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $data = curl_exec($ch);
        curl_close($ch);

        // for later xml parsing, remove :
        $data = str_replace('media:group', 'mediagroup', $data);
        $data = str_replace('media:content', 'mediacontent', $data);

        return $data;
    }

    private function parseRSS($xml, &$model)
    {
        $model->title = $xml->channel->title;
        $model->copyright = $xml->channel->copyright;
        $model->link = $xml->channel->link;
        $model->description = $xml->channel->description;
        $model->category = $xml->channel->category;

        $model->items = array();
        foreach ($xml->channel->item as $someItem) {

            $item = new stdClass();
            $item->description = $someItem['description'];
            $item->link = $someItem['link'];
            $item->category = $someItem['category'];
            $item->title = $someItem['title'];

            $item->medias = array();

            $mediaGroup = $someItem->mediagroup;
            if (isset($mediaGroup)) {
                if (isset($mediaGroup->mediacontent)) {
                    foreach ($mediaGroup->mediacontent as $content) {
                        $medium = $content['medium'];
                        if ($medium == "image") {

                            $image = new stdClass();
                            $image->url = $content['url'];
                            $image->width = $content['width'];
                            $image->height = $content['height'];

                            if ($this->endsWith($content['url'], $model->thumbnailssize . '.jpg')) {
                                $item->thumb = $image;
                            }
                            if ($this->endsWith($content['url'], $model->imagesize . '.jpg')) {
                                $item->image = $image;
                            }

                            $item->medias[] = $image;
                        }
                    }
                }
            }
            $model->items[] = $item;
        }

        return $model;
    }

    private function endsWith($haystack, $needle)
    {
// search forward starting from end minus needle length characters
        return $needle === "" || strpos($haystack, $needle, strlen($haystack) - strlen($needle)) !== FALSE;
    }

    private function doSmoothBox($model)
    {
        $document = JFactory::getDocument();

        $document->addScript(JUri::base().'/media/com_cedsmugmug/js/zoom.js');
        $document->addScript(JUri::base().'/media/com_cedsmugmug/js/easing.js');

        $document->addStyleSheet(JUri::base().'/media/com_cedsmugmug/css/zoom.css?v=3.2.6');
        $document->addScriptDeclaration("jQuery(window).on('load',  function() {
         jQuery('img').smoothZoom({
            // Options go here
                });
         });");

        $html = "<style type='text/css'>
                 .smugmug_image {padding: 0 0 0 0; margin: $model->gridSpacingpx; float: left; }
                 .smugmug_image img {!important; padding: 0 0 0 0; margin: 0 0 0 0; }</style>";

        if ($model->galleryTitle) {
            $html .= "<h2>$model->title</h2>";
        }

        if ($model->galleryDescription) {
            $html .= "<h3>$model->description</h3>";
        }

        if ($model->galleryCategory) {
            $html .= "<h4>$model->category</h4>";
        }

        $line = 0;
        $row = 0;
        foreach ($model->items as $item) {
            $html .= '<div class="smugmug_image"><a href="' . $item->image->url . '"><img src="' . $item->thumb->url . '" rel="zoom"></a></div>';
            $line++;
            if ($line % $model->colMax == 0) {
                $html .= '<div class="clearfix"/>';
                $row++;
                if ($row == $model->rowMax) {
                    break;
                }
            }
        }

        if ($model->galleryLinkable) {
            $html .= '<div style="text - align: center;"><a href=" <?php echo $model->link ?>">Gallery</a></div>';
        }

        return $html;
    }
}