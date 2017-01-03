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

require JPATH_LIBRARIES. '/cedsmugmug\vendor\autoload.php';

class CedSmugmugRandomModel
{

    public function getModel($params)
    {
        $model = new stdClass();

        $model->width = $params->get('Width', '150');
        $model->height = $params->get('Height', '150');
        $model->library = $params->get('Library', 'lightbox');
        $model->title = $params->get('Title', 'Some of my Favorite Shots');

        //TODO
        $options = [
            'AppName' => 'CedSmugmug/1.0 for (http://app.com)',
            'OAuthSecret' => '1dbc6fe499abf897405948be390cdefa',
            '_verbosity' => 1, # Reduce verbosity to reduce the amount of data in the response and to make using it easier. default is 2

        ];
        $apiKey = "2BIzXuustXcrE87qXeOJLgXpIYYp7IFd";
        $username = "cedricwalter";


        $client = new phpSmug\Client($apiKey, $options);

        $selectedAlbum = $params->get('gallery');

        $albums = $client->get("user/$username!albums");
        foreach ($albums->Album as $album)
        {
            if ($album == $selectedAlbum) { //TODO
                $images = $client->get($album->Uris->AlbumImages);
                $randomPosition = rand(0, sizeof($images));
                $image = $images[$randomPosition];

                $model->title = $image->Title;
                $model->imageKey = $image->ImageKey;
                $model->webUri = $image->WebUri;

                $model->thumbnailUrl = $client->signResource($image->ThumbnailUrl);
            }
        }

        $model->moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

        $library = $params->get('library', 'rokbox');
        // http://demo.rockettheme.com/joomla-extensions/rokbox/
        $model->meta = 'rel="' . $library . '"';
        if ($library == 'rokbox') {
            $model->meta = "data-rokbox";
        }

        return $model;
    }

}