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

// no direct access
defined('_JEXEC') or die;

class CedSmugMugBadgeModel
{

    public function getModel($params, $isSSLConnection)
    {
	    $type = intval($params->get('type', 0));
	    $keyword = $params->get('keyword', 'hornet');
	    $WebUri = $params->get('WebUri'); //$this->getGallery($params);

	    require_once (JPATH_SITE.'/components/com_cedsmugmug/helpers/feed.php');

	    $feed = new cedSmugmugFeed($params->get('thumbnails-size', '-Ti'), $params->get('image-size', ''));

	    $model = $feed->getModel($type, $keyword, $WebUri);

	    // extends model
	    $model->gridSpacing = $params->get('gridSpacing', 1);

	    $model->rowMax = $params->get('gridRows', 4);
	    $model->colMax = $params->get('gridColumns', 4);
	    $model->limit = $params->get('limit', 16);

	    $model->thumbnailssize = $params->get('thumbnails-size', '-Ti');
	    $model->imagesize = $params->get('image-size', '');

	    $model->galleryTitle = $params->get('gallery-title', 0);
	    $model->galleryDescription = $params->get('gallery-description', 0);
	    $model->galleryCategory = $params->get('gallery-category', 0);
	    $model->galleryLinkable = $params->get('gallery-link', 0);

	    $model->moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
	    $model->uuid = uniqid();

        return $model;
    }

	private function getGallery($params)
	{
		$albumIdKey1 = $params->get('AlbumIdKey1', '');


		$count = 0;
		$count = strlen($albumIdKey1) > 0 ? $count + 1 : $count;

		$index = rand(1, $count);
		$albumIdKey = 'albumIdKey' . $index;

		// get value of that variable
		$album = $$albumIdKey;

		return $album;
	}


} 