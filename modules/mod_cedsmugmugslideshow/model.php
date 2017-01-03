<?php
/**
 * @package     CedSmugMug
 * @subpackage  com_cedsmugmug
 *
 * @copyright   Copyright (C) 2013-2016 galaxiis.com All rights reserved.
 * @license     The author and holder of the copyright of the software is Cédric Walter. The licensor and as such issuer of the license and bearer of the
 *              worldwide exclusive usage rights including the rights to reproduce, distribute and make the software available to the public
 *              in any form is Galaxiis.com
 *              see LICENSE.txt
 */

// Don't allow direct access to the module.
defined('_JEXEC') or die('Restricted access');

class CedSmugmugSlideShowModel
{

    public function getModel($params)
    {
        $model = new stdClass();

        $model->protocol = JFactory::getApplication()->isSSLConnection() ? "https" : "http";
        $model->width = $params->get('width', 400);
        $model->height = $params->get('height', 400);
        $model->moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

        $pageStyle = $params->get('pageStyle', 'white');
        $showSpeed = $params->get('showSpeed') == 1 ? 'true' : 'false';
        $autoStart = $params->get('autoStart') == 1 ? 'true' : 'false';
        $captions = $params->get('captions') == 1 ? 'true' : 'false';
        $showLogo = $params->get('showLogo') == 1 ? 'true' : 'false';
        $clickToImage = $params->get('clickToImage') == 1 ? 'true' : 'false';
        $splashUrl = $params->get('splashurl');
        $showThumbs = $params->get('showThumbs') == 1 ? 'true' : 'false';
        $albumID = $params->get('albumID');
        $albumKey = $params->get('albumKey');
        $showButtons = $params->get('showButtons') == 1 ? 'true' : 'false';
        $transparent = $params->get('transparent') == 1 ? 'true' : 'false';
        $bgColor = $params->get('bgColor');
        $crossFadeSpeed = $params->get('crossFadeSpeed');
        $randomStart = $params->get('randomStart') == 1 ? 'true' : 'false';
        $randomize = $params->get('randomize') == 1 ? 'true' : 'false';
        $borderThickness = $params->get('borderThickness');
        $borderColor = $params->get('borderColor');

        $flashVars = array();
        $flashVars[] = "AlbumID=$albumID&AlbumKey=$albumKey&transparent=$transparent&bgColor=$bgColor&borderThickness=$borderThickness";
        $flashVars[] = "borderColor=$borderColor&useInside=&endPoint=&mainHost=cdn.smugmug.com&VersionNos=2013072402";
        $flashVars[] = "width=$model->width&height=$model->height&clickToImage=$clickToImage&showLogo=$showLogo&splash=$splashUrl";
        $flashVars[] = "captions=$captions&showThumbs=$showThumbs&autoStart=$autoStart&showSpeed=$showSpeed&pageStyle=$pageStyle&showButtons=$showButtons&randomStart=$randomStart";
        $flashVars[] = "randomize=$randomize&splash=$model->protocol%3A%2F%2Fwww.smugmug.com%2Fimg%2Fria%2FShizamSlides%2Fsmugmug_black.png&splashDelay=0&crossFadeSpeed=$crossFadeSpeed";

        $model->flashvars = implode("&", $flashVars);

        return $model;
    }

}