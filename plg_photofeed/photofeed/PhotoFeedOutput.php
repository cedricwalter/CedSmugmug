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


class PhotoFeedOutput
{
    var $html = "";
    var $params = null;
    var $numberOfColumns = 3;
    var $columnsCounter = 0;
    var $library = null;

    var $displayLinkToGallery = true;
    var $displayGalleryDescription = true;
    var $displayGalleryTitle = true;

    var $galleryUrl = null;

    function PhotoFeedOutput($params)
    {
        $this->params = $params;
        $this->numberOfColumns = $params->get('NumberOfColumns', 2);
        $this->defaultImage = $params->get('DefaultImage', 'media/plg_photofeed/notfound.jpg');
        $this->reverseOrder = $params->get('reverseOrder', 1);
        $this->library = $params->get('library', 'shadowbox');

        $this->displayLinkToGallery = $params->get('displayLinkToGallery', true);
        $this->displayGalleryDescription = $params->get('displayGalleryDescription', true);
        $this->displayGalleryTitle = $params->get('displayGalleryTitle', true);

        $this->columnsCounter = 0;
    }


    /**
     * @param $model
     * @param $SimplePie
     * @return string html
     */
    public function render($model, $SimplePie)
    {
        $rendering = $this->params->get('rendering', 'Rokbox');
        $output = PhotoFeedOutput::renderingFactory($rendering);

        foreach ($model as $entry) {
            $output->addEntry($entry);
        }

        return $this->getHtmlOutput($SimplePie, $output->imageList);
    }


    public static function renderingFactory($type)
    {
        $filename = dirname(__FILE__) .'/rendering/'.strtolower($type).'.php';
        if (include_once($filename)) {
            $classname = 'PhotoFeed'.$type.'Output';
            return new $classname;
        } else {
            throw new Exception('rendering not found');
        }
    }


    private function createHTMLForImage($image)
    {
        if ($this->columnsCounter == 0) {
            if (strlen($this->html) != 0) {
                $this->html .= "</div>";
                $this->html .= "<div class='photofeedClear'></div>";
                $this->html .= "<div class='photofeedLine'>";
            } else {
                $this->html .= "<div class='photofeedLine'>";
            }
        }
        $this->html .= "<div class='photofeedImage'>" . $image . "</div>";
        $this->columnsCounter++;

        if ($this->columnsCounter == $this->numberOfColumns) {
            $this->columnsCounter = 0;
        }
    }

    private function getHtmlOutput($SimplePie, $imageList)
    {
        $filecontent = "";
        if (sizeof($imageList) == 0) {
            //No images found
            $filecontent .= "<img src='" . $this->defaultImage . "' width='150px' height='150px' target='_blank' />";
            return $filecontent;
        } else {
            if ($this->reverseOrder) {
                $imageList = array_reverse($imageList);
            }

            foreach ($imageList as $image) {
                $this->createHTMLForImage($image);
            }

            //$toto = $SimplePie->get_categories();

            $html = "<!-- www.waltercedric.com photofeed plugin for joomla! -->";
            $html .= "<div class='photofeed'>";

            if ($this->displayGalleryTitle) {
                $html .= " <div class='photofeedTitle'><a href='" . $SimplePie->get_link() . "' target='_blank'>" . $SimplePie->get_title() . "</a></div>";
            }
            if ($this->displayGalleryDescription) {
                $html .= " <div class='photofeedDescription'>" . $SimplePie->get_description() . "</div>";
            }
            $html .= "<div class='photofeedBody'>";
            $html .= $this->html;
            $html .= "</div>"; // end photofeedBody
            $html .= "<div class='photofeedClear'></div>";
            $html .= "</div>";

            if ($this->displayLinkToGallery) {
                $html .= '<div class="photofeedGallery"><a href="' . $SimplePie->get_link() . '" target="_blank">Gallery</a></div>';
            }
            $html .= "<div class='photofeedClear'></div>";

            $html .= "</div>";


            return $html;
        }
    }

}