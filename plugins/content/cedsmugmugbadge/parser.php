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

class plgContentCedSmugMugBadgeParser
{
    const PATTERN = "/{cedsmugmugbadge\s+(.*?)}/i";

	/**
	 * plgContentCedSmugMugBadgeParser constructor.
	 */
	public function __construct()
	{
	}

	public function isActive($text)
    {
        if (strpos($text, '{cedsmugmugbadge') === false) {
            return false;
        }

        return true;
    }

    public function parse($text)
    {
        $models = array();

        preg_match_all(self::PATTERN, $text, $matches, PREG_SET_ORDER);

        // plugin only processes if there are any instances of the plugin in the text
        if ($matches) {
            foreach ($matches as $match) {
                $inline_params = $match[1];
                $result = array();
                $pairs = explode(' ', trim($inline_params));
                foreach ($pairs as $pair) {
                    $pos = strpos($pair, "=");
                    $key = substr($pair, 0, $pos);
                    $value = substr($pair, $pos + 1);
                    $result[$key] = $value;
                }

                if (isset($result['rss'])) {
                    $rss = trim($result['rss']);
                }

                if (isset($result['galleryTitle'])) {
                    $galleryTitle = trim($result['galleryTitle']);
                } else {
                    $galleryTitle = 0;
                }
                if (isset($result['galleryDescription'])) {
                    $galleryDescription = trim($result['galleryDescription']);
                } else {
                    $galleryDescription = 0;
                }
                if (isset($result['galleryCategory'])) {
                    $galleryCategory = trim($result['galleryCategory']);
                } else {
                    $galleryCategory = 0;
                }
                if (isset($result['galleryLinkable'])) {
                    $galleryLinkable = trim($result['galleryLinkable']);
                } else {
                    $galleryLinkable = 0;
                }

                if (isset($result['gridSpacing'])) {
                    $gridSpacing = trim($result['gridSpacing']);
                } else {
                    $gridSpacing = 0;
                }
                if (isset($result['rowMax'])) {
                    $rowMax = trim($result['rowMax']);
                } else {
                    $rowMax = 4;
                }
                if (isset($result['colMax'])) {
                    $colMax = trim($result['colMax']);
                } else {
                    $colMax = 4;
                }

                if (isset($result['imagesize'])) {
                    $imageSize = trim($result['imagesize']);
                } else {
                    $imageSize = "";
                }
                if (isset($result['thumbnailssize'])) {
                    $thumbnailsSize = trim($result['thumbnailssize']);
                } else {
                    $thumbnailsSize = "-Ti";
                }

                $model = new stdClass();
                $model->rss = $rss;
                $model->galleryTitle = $galleryTitle;
                $model->galleryDescription = $galleryDescription;
                $model->galleryCategory = $galleryCategory;
                $model->galleryLinkable = $galleryLinkable;

                $model->gridSpacing = $gridSpacing;
                $model->rowMax = $rowMax;
                $model->colMax = $colMax;

                $model->thumbnailssize = $thumbnailsSize;
                $model->imagesize = $imageSize;

                $model->uuid = uniqid();

                $model->matches = $match[0];

                $models[] = $model;
            }
        }

        return $models;
    }

    function startsWith($haystack, $needle)
    {
        return $needle === "" || strpos($haystack, $needle) === 0;
    }

}
