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

class PhotoFeedHtmlOutput
{
    var $imageList = array();

    public function addEntry($entry)
    {
        $title = $entry['title'];
        $description = $entry['description'];
        $width = $entry['width'];
        $height = $entry['height'];
        $thumbnailUrl = $entry['thumbnailUrl'];
        $imageUrl = $entry['imageUrl'];

        $html = '<a href="' . $imageUrl . '" ><img src="' . $thumbnailUrl . '" title="' . $title . '" /></a>';
        $this->imageList[] = $html;
    }


}