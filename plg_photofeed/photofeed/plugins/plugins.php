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

class PhotoFeedPlugins extends JObject
{
    var $doc = null;

    function PhotoFeedPlugins($config = array())
    {
        parent::__construct($config);
        $this->doc = new DOMDocument();
    }

    function getLibraryLink($data)
    {
        preg_match_all('/ href="([^"]*)"([^>]*)>/i', $data, $matches);
        return $matches[1][1];
    }


    function getImageFromDescription($data)
    {
        $this->doc->loadHTML($data);
        $xml = simplexml_import_dom($this->doc); // just to make xpath more simple
        $images = $xml->xpath('//img');
        foreach ($images as $img) {
            //only support one image in description of rss feed
            return $img;
        }

        return "";
    }





    //do not work in all case
//	function getImageFromDescription($data) {
//		preg_match_all('/<img src="([^"]*)"([^>]*)>/i', $data, $matches);
//		return $matches[1][0];
//	}


}