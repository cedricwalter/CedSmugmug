<?php
/**
 * @package     cedSmugMug
 * @subpackage  com_cedsmugmug
 *
 * @copyright   Copyright (C) 2013-2016 galaxiis.com All rights reserved.
 * @license     The author and holder of the copyright of the software is Cédric Walter. The licensor and as such issuer of the license and bearer of the
 *              worldwide exclusive usage rights including the rights to reproduce, distribute and make the software available to the public
 *              in any form is Galaxiis.com
 *              see LICENSE.txt
 * @id ${licenseId}
 */

// Don't allow direct access to the module.
defined('_JEXEC') or die('Restricted access');

class plgContentCedSmugMugSlideShowParser
{
    const PATTERN = "/{smugmugslideshow\s+(.*?)}/i";

    public function parse($text, $isSSLConnection)
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

                if (isset($result['uri'])) {
                    $url = trim($result['uri']);
                }
                if (isset($result['id'])) {
                    $albumID = trim($result['id']);
                }
                if (isset($result['key'])) {
                    $albumKey = trim($result['key']);
                }

	            $url = str_replace("http", "https", $url);

	            $model = new stdClass();
                $model->albumId = $albumID;
                $model->albumKey = $albumKey;
                $model->url = $url;
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
