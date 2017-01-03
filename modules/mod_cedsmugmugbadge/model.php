<?php
/**
 * @package     CedSmugMug
 * @subpackage  com_cedsmugmug
 *
 * @copyright   Copyright (C) 2013-2016 galaxiis.com All rights reserved.
 * @license     The author and holder of the copyright of the software is Cédric Walter. The licensor and as such issuer of the license and bearer of the
 *              worldwide exclusive usage rights including the rights to reproduce, distribute and make the software available to the public
 *              in any form is Galaxiis.com
 *              see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

class CedSmugMugBadgeModel
{

    public function getModel($params, $isSSLConnection)
    {
        $model = new stdClass();

//        $model->Width = $params->get('Width', '200');
//        $model->Height = $params->get('Height', '200');
        $model->gridSpacing = $params->get('gridSpacing', 1);

        $model->rowMax = $params->get('gridRows', 4);
        $model->colMax = $params->get('gridColumns', 4);
        $model->limit = $params->get('limit', 16);

        $model->thumbnailssize = $params->get('thumbnails-size', '-Ti');
        $model->imagesize = $params->get('image-size', '');

        $model->galleryTitle = $params->get('gallery-title', 0);
        $model->galleryDescription = $params->get('gallery-description', 0);
        $model->galleryCategory = $params->get('gallery-category', 0);
        $model->galleryLinkable = $params->get('gallery-link', 0);

        $model->moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
        $model->uuid = uniqid();

        $url = $this->getFeed($params);
        $model->rss = $url;

        $data = $this->getData($url);

        $xml = new SimpleXmlElement($data, LIBXML_NOCDATA);
        if (isset($xml->channel)) {
            $model = $this->parseRSS($xml, $model);
        }
//        if (isset($xml->entry)) {
//            $this->parseAtom($xml);
//        }

        return $model;
    }

    private function getFeed($params)
    {
        $type = intval($params->get('type', 0));
        switch ($type) {
            case 0: //Galleries badge
                $albumIdKey = $this->getGallery($params);

                $feed = "http://api.smugmug.com/hack/feed.mg?Type=gallery&Data=$albumIdKey&format=rss200";
                break;

        }

        return $feed;
    }

    private function getGallery($params)
    {
        $albumIdKey1 = $params->get('AlbumIdKey1', '');


        $count = 0;
        $count = strlen($albumIdKey1) > 0 ? $count + 1 : $count;

        $index = rand(1, $count);
        $albumIdKey = 'albumIdKey' . $index;

        // get value of that variable
        $album = $$albumIdKey;

        return $album;
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

    function parseAtom($xml)
    {
        echo "<strong>" . $xml->author->name . "</strong>";
        $cnt = count($xml->entry);
        for ($i = 0; $i < $cnt; $i++) {
            $urlAtt = $xml->entry->link[$i]->attributes();
            $url = $urlAtt['href'];
            $title = $xml->entry->title;
            $desc = strip_tags($xml->entry->content);

            echo '<a href="' . $url . '">' . $title . '</a>' . $desc . '';
        }
    }

} 