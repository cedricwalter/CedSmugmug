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

// no direct access
defined('_JEXEC') or die('Restricted access');

class plgContentSmugmugVideoParser
{
    const PATTERN = "/{smugmugvideo\s+(.*?)}/i";

    var $defaultSize = null;
    var $defaultWidth = null;
    var $defaultHeight = null;
    var $videoidkey = null;

    function __construct($defaultSize = "S", $defaultWidth = 425, $defaultHeight = 318)
    {
        $this->defaultSize = $defaultSize;
        $this->defaultWidth = $defaultWidth;
        $this->defaultHeight = $defaultHeight;
    }

    /**
     * @return array models
     */
    public function parse($text)
    {
        $models = array();

        preg_match_all(self::PATTERN, $text, $matches, PREG_SET_ORDER);

        if ($matches) {
            foreach ($matches as $match) {
                $matcheslist = explode(' ', $match[1]);
                $sizeof = sizeof($matcheslist);

                if ($sizeof >= 1) {
                    $videoIdKey = trim($matcheslist[0]);
                }
                if ($sizeof == 2) {
                    $size = trim($matcheslist[1]);
                }

                if (empty($videoIdKey)) {
                    $videoIdKey = $this->videoidkey;
                }

                if (empty($size) && ($sizeof == 1 || $sizeof == 2)) {
                    $size = $this->defaultSize;
                } else {
                    if ($sizeof == 3) {
                        $width = trim($matcheslist[1]);
                        $height = trim($matcheslist[2]);

                        if (empty($width)) {
                            $width = $this->defaultWidth;
                        }
                        if (empty($height)) {
                            $height = $this->defaultHeight;
                        }
                    }
                }

                if (!isset($width) && !isset($heigth)) {
                    switch ($size) {
                        case 'M':
                        case 'm':
                            $width = 640;
                            $height = 480;
                            break;
                        default:
                            $width = 425;
                            $height = 318;
                            break;
                    }
                }

                $model = new stdClass();
                $movieIdKey = explode('_', $videoIdKey);
                $model->movieId = $movieIdKey[0];
                $model->movieKey = $movieIdKey[1];
                $model->width = $width;
                $model->height = $height;
                $model->matches = $match[0];

                $models[] = $model;
            }
        }

        return $models;
    }

}

?>