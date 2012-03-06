<?php
/**
 * @version        photofeed.php
 * @package
 * @copyright    Copyright (C) 2009 Cedric Walter. All rights reserved.
 * www.cedricwalter.com / www.waltercedric.com
 * @license        GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once(dirname(__FILE__) . DS . 'plugins.php');
require_once(dirname(__FILE__) . DS . '../PhotoFeedLog.php');


class PhotoFeedG2Plugins extends PhotoFeedPlugins
{
    function __construct($config = array())
    {
        parent::__construct($config);
    }

    public function getFeedUrl($feedUrl, $startAtPhoto, $limit)
    {
        return $feedUrl;
    }

    function getModelForItem($item, $params)
    {
        $thumbnailUrl = "";
        foreach ($item->get_enclosures() as $enclosure) {
            $thumbnails = $enclosure->get_thumbnails();
            if ($thumbnails != null) {
                $thumbnailUrl = $thumbnails[0];
            }
        }

        $media_group = $item->get_item_tags('http://search.yahoo.com/mrss/', 'group');
        $media_content = $media_group[0]['child']['http://search.yahoo.com/mrss/']['content'];
        $attribs = $media_content[0]['attribs'][''];
        $imageUrl = $attribs['url'];

        $model = array();
        $model['title'] = htmlspecialchars(strip_tags($item->get_title()));
        $model['description'] = htmlspecialchars(strip_tags($item->get_description()));
        $model['width'] = $attribs['width'];
        $model['height'] = $attribs['height'];
        $model['thumbnailUrl'] = $thumbnailUrl;
        $model['imageUrl'] = $imageUrl;

        return $model;
    }

}
