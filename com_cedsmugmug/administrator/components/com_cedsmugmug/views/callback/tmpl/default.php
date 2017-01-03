<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$cparams = JComponentHelper::getParams('com_cedsmugmug');

jimport('joomla.html.html.bootstrap');


$smugmug_options = [
	'AppName' => 'CedSmugmug/1.0 for (http://app.com)',
	'OAuthSecret' => '1dbc6fe499abf897405948be390cdefa',
	'_verbosity' => 2, # Reduce verbosity to reduce the amount of data in the response and to make using it easier. default is 2
	'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ) # so that it doesn't attempt to perform the ssl verification... Obviously on the live server it won't be an issue given that the live server will have a correct certificate (assumedly)

];

$apiKey = "2BIzXuustXcrE87qXeOJLgXpIYYp7IFd";
$username = "cedricwalter";

require JPATH_LIBRARIES. '/cedsmugmug\vendor\autoload.php';

$client = new phpSmug\Client($apiKey, $smugmug_options);

$app = JFactory::getApplication();

// Step 3: Use the Request token obtained in step 1 to get an access token
$oauth_token = $app->getUserState("cedsmugmug_oauth_token", "");
$oauth_token_secret = $app->getUserState("cedsmugmug_oauth_token_secret", "");
$client->setToken($oauth_token, $oauth_token_secret);

$verifier = $app->input->get('oauth_verifier'); // This comes back with the callback request.

$token = $client->getAccessToken($oauth_verifier);  // The results of this call is what your application needs to store.


$cparams->def('token',$token );



?>

done