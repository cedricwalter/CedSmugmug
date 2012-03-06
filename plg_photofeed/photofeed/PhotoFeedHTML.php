<?php
/**
 * @version        photofeed.php
 * @package
 * @copyright    Copyright (C) 2009 Cedric Walter. All rights reserved.
 * @license        GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once(dirname(__FILE__) . '/PhotoFeedOutput.php');
require_once(dirname(__FILE__) . '/helper/helper.php');

DEFINE('PF_REGEX_G2', 'g2_itemId');
DEFINE('PF_REGEX_OTHER', '.com');
DEFINE('PF_REGEX_ISTOCKPHOTO', 'www.istockphoto.com');
DEFINE('PF_REGEX_PICASA', 'picasa');
DEFINE('PF_REGEX_SMUGMUG', 'smugmug.com');
DEFINE('PF_REGEX_FLICKR', 'flickr.com');
DEFINE('PF_REGEX_YOUTUBE', 'youtube.com');


require_once(JPATH_SITE . DS . 'libraries' . DS . 'simplepie' . DS . 'simplepie.php');

class PhotoFeedHTML
{

    //this object hold the output
    var $PhotoFeedOutput = null;

    var $PhotoFeedFlickr = null;
    var $PhotoFeedSmugmug = null;
    var $PhotoFeedPicasa = null;
    var $PhotoFeedG2 = null;
    var $PhotoFeedYouTube = null;

    var $enableRssCache = null;
    var $enableHtmlCache = null;
    var $rssCachetime = null;

    public function PhotoFeedHTML($params)
    {
        $this->PhotoFeedOutput = new PhotoFeedOutput($params);

        $this->rssCachetime = $params->get('RssCachetime', 3600);
        $this->enableRssCache = $params->get('enableRssCache', '1');
        $this->enableHtmlCache = $params->get('enableHtmlCache', '1');
    }

    /**
     * Ask cache and write eventually a new file version
     * @param $feedUrl
     * @param $number
     * @return unknown_type
     */
    public function parseRSSFeed($params, $feedUrl, $limit, $startAtPhoto)
    {
        //php translates that '&' to '&amp' ! and obviously the address does not remain the same
        $feedUrl = html_entity_decode($feedUrl);

        //key to cache has to be unique for a combination of parameters
        $htmlCacheid = md5($feedUrl . $limit . $startAtPhoto);

        $cache = JFactory::getCache('plg_content_photofeed', '');
        $filecontent = $cache->get($htmlCacheid);

        //file not found in cache
        if ($filecontent === false) {

            $plugin = $this->getPluginFromFeedUrl($feedUrl);

            //Ask plugin to create url has it may have some specificities
            $feedUrl = $plugin->getFeedUrl($feedUrl, $startAtPhoto, $limit);

            $feedUrl = PhotoFeedHelper::clean_htmlentities($feedUrl);

            //Init SimplePie
            $SimplePie = new SimplePie($feedUrl, null, $this->rssCachetime);

            // set sorting before parsing feed
            // Reorder feed by date descending
            $SimplePie->enable_order_by_date(false);

            //do the parsing
            $SimplePie->handle_content_type();
            //$feedEntries = $SimplePie->get_item_quantity();

            $imageCount = ($startAtPhoto + $limit);
            if ($startAtPhoto == "") {
                $startAtPhoto = 0;
            }
            //get_items($startAtPhoto, $imageCount) cant be used
            $items = $SimplePie->get_items($startAtPhoto, $imageCount);

            $sortPhotoByExifDate = $params->get('sortPhotoByExifDate', 1);
            if ($sortPhotoByExifDate) {
                usort($items, array(&$this, 'compareExif'));
            }

            //Ask plugin to create model
            $model = array();
            foreach ($items as $item) {
                if ($enclosure = $item->get_enclosure()) {
                    $modelItem = $plugin->getModelForItem($item, $params);
                    $model[] = $modelItem;
                }
            }

            $filecontent = $this->PhotoFeedOutput->render($model, $SimplePie);
            if ($this->enableHtmlCache) {
                $cache->store($filecontent, $htmlCacheid);
            }
        }

        return $filecontent;
    }

    private function getPluginFromFeedUrl($feedUrl)
    {
        $class = "Smugmug";

        if (strpos($feedUrl, PF_REGEX_FLICKR)) {
            $class = "Flickr";
        }
        else if (strpos($feedUrl, PF_REGEX_SMUGMUG)) {
            $class = "Smugmug";
        }
        else if (strpos($feedUrl, PF_REGEX_PICASA)) {
            $class = "Picasa";
        }
        else if (strpos($feedUrl, PF_REGEX_ISTOCKPHOTO)) {
            $class = "IsStockPhoto";
        }
        else if (strpos($feedUrl, PF_REGEX_YOUTUBE)) {
            $class = "Youtube";
        }
        else if (strpos($feedUrl, PF_REGEX_G2) || true) //default
        {
            $class = "G2";
        }

        return PhotoFeedHTML::pluginsFactory($class);
    }


    public static function pluginsFactory($type)
    {
        $filename = dirname(__FILE__) . '/plugins/' . strtolower($type) . '.php';
        if (include_once($filename)) {
            $classname = 'PhotoFeed' . $type . 'Plugins';
            return new $classname;
        } else {
            throw new Exception('rendering not found');
        }
    }

    function compareExif($firstItem, $secondItem)
    {
        $firstItemDate = $firstItem->get_item_tags('http://www.exif.org/specifications.html',
            'DateTimeOriginal');
        $secondItemDate = $secondItem->get_item_tags('http://www.exif.org/specifications.html',
            'DateTimeOriginal');

        if ($firstItemDate && $secondItemDate) {
            $firstItemDate = strtotime($firstItemDate[0]['data']);
            $secondItemDate = strtotime($secondItemDate[0]['data']);

            if ($firstItemDate == $secondItemDate) {
                return 0;
            } else if ($firstItemDate < $secondItemDate) {
                return -1;
            } else {
                return 1;
            }
        }
        return 0;
    }


}
