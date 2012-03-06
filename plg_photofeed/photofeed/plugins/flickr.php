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

class PhotoFeedFlickrPlugins extends PhotoFeedPlugins
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
        $flickrSize = $params->get('flickrSize');

        $imageUrl = $this->getLibraryLink($item->get_description());
        $img = $this->getImageFromDescription($item->get_description());
        $thumbnailUrl = $this->selectImage($img['src'], $flickrSize);

        $model = array();
        $model['title'] = htmlspecialchars(strip_tags($item->get_title()));
        $model['description'] = htmlspecialchars(strip_tags($item->get_description()));
        $model['width'] = '';
        $model['height'] = '';
        $model['thumbnailUrl'] = $thumbnailUrl;
        $model['imageUrl'] = $imageUrl;

        return $model;
    }

    function selectImage($img, $size)
    {
        $img = explode('/', $img);
        $filename = array_pop($img);

        // The sizes listed here are the ones Flickr provides by default.  Pass the array index in the
        //$size variable to selct one.
        // 0 for square, 1 for thumb, 2 for small, etc.
        $s = array(
            '_s.', // square  
            '_t.', // thumb
            '_m.', // small
            '.', // medium
            '_b.' // large
        );

        $img[] = preg_replace('/(_(s|t|m|b))?\./i', $s[$size], $filename);
        return implode('/', $img);
    }
}
