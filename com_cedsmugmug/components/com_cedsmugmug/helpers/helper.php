<?php

/**
 * Created by PhpStorm.
 * User: cedric
 * Date: 6/7/2016
 * Time: 10:29 AM
 */
class CedSmugMugHelper
{

    public function connect()
    {
        // Optional, but definitely nice to have, options
        $options = [
            'AppName' => 'CedSmugmug/1.0 for (http://app.com)',
            'OAuthSecret' => '1dbc6fe499abf897405948be390cdefa',
            '_verbosity' => 1, # Reduce verbosity to reduce the amount of data in the response and to make using it easier. default is 2

        ];

        $apiKey = "2BIzXuustXcrE87qXeOJLgXpIYYp7IFd";
        $username = "cedricwalter";

        $client = new phpSmug\Client($apiKey, $options);


        $albums = $client->get("user/$username!albums");
        $profile = $client->get("user/$username!profile");


        $username = $client->get('!authuser')->User->NickName;
        // Get the first public album
        $albums = $client->get("user/{$username}!albums", array('count' => 1));
        // Get the first 25 photos in the album
        $images = $client->get($albums->Album[0]->Uris->AlbumImages, array('count' => 25));


        foreach ($images->AlbumImage as $image) {
            printf('<a href="%s"><img src="%s" title="%s" alt="%s" width="150" height="150" /></a>', $image->WebUri, $client->signResource($image->ThumbnailUrl), $image->Title, $image->ImageKey);
        }
  }




}