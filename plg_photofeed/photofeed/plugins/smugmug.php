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


class PhotoFeedSmugmugPlugins extends PhotoFeedPlugins
{
    function PhotoFeedSmugmugPlugins($config = array())
    {
        parent::__construct($config);

    }

    //Handle library with more than 100 entries
    public function getFeedUrl($feedUrl, $startAtPhoto, $limit)
    {
        $imageCount = ($startAtPhoto + $limit);

        if ($startAtPhoto > 100) {
            $feedUrl .= '&ImageCount=' . $imageCount;
        }
        if ($imageCount > 100) {
            $feedUrl .= '&Paging=0';
        }

        return $feedUrl;
    }


    function getModelForItem($item, $params)
    {
        $smugmugSize = $params->get('smugmugSize');
        $smugmugThumbSize = $params->get('smugmugThumbSize');

        //$permalink = $item->get_permalink();
        //$link = $item->get_link();
        //$img = $this->getImageFromDescription($item->get_description());

        $imageUrl = '';
        $thumbnailUrl = "";
        $width = '';
        $height = '';
        foreach ($item->get_enclosures() as $enclosure) {
            $mediaContentUrl = $enclosure->get_link();

            if ($smugmugThumbSize == 'Th' && strpos($mediaContentUrl, '-Th')) {
                $thumbnailUrl = $mediaContentUrl;
            } else if ($smugmugThumbSize == 'Ti' && strpos($mediaContentUrl, '-Ti')) {
                $thumbnailUrl = $mediaContentUrl;
            } else if ($smugmugSize == 'S' && strpos($mediaContentUrl, '-S')) {
                $width = 400;
                $height = 300;
                $imageUrl = $mediaContentUrl;
            } else if ($smugmugSize == 'M' && strpos($mediaContentUrl, '-M')) {
                $width = 600;
                $height = 450;
                $imageUrl = $mediaContentUrl;
            } else if ($smugmugSize == 'L' && strpos($mediaContentUrl, '-L')) {
                $width = 800;
                $height = 600;
                $imageUrl = $mediaContentUrl;
            } else if ($smugmugSize == 'XL' && strpos($mediaContentUrl, '-XL')) {
                $width = 1024;
                $height = 768;
                $imageUrl = $mediaContentUrl;
            } else if ($smugmugSize == 'X2' && strpos($mediaContentUrl, '-X2')) {
                $width = 1280;
                $height = 960;
                $imageUrl = $mediaContentUrl;
            } else if ($smugmugSize == 'X3' && strpos($mediaContentUrl, '-X3')) {
                $width = 1600;
                $height = 1200;
                $imageUrl = $mediaContentUrl;
            } else if ($smugmugSize == 'O' && strpos($mediaContentUrl, '-O')) {
                $width = '';
                $height = '';
                $imageUrl = $mediaContentUrl;
            }
        }

        $model = array();
        $model['title'] = htmlspecialchars(strip_tags($item->get_title()));
        $model['description'] = htmlspecialchars(strip_tags($item->get_description()));
        $model['width'] = $width;
        $model['height'] = $height;
        $model['thumbnailUrl'] = $thumbnailUrl;
        $model['imageUrl'] = $imageUrl;

        return $model;
    }

}