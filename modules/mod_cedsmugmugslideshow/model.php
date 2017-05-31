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

	    $model->autoStart = $params->get('autoStart', '1');
	    $model->captions = $params->get('captions', '1');
	    $model->playButton = $params->get('showButtons', '1');
	    $model->navigation = $params->get('navigation', '1');
	    $model->randomize = $params->get('randomize', '1');
	    $model->transition = $params->get('transition', 'fade');

	    $componentParams = JComponentHelper::getParams("com_cedsmugmug");
	    $model->baseUrl = $componentParams->get('baseUrl');

	    $model->albumKey = $params->get('albumKey');

        return $model;
    }

}