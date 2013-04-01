<?php

defined('_JEXEC') or die('Restricted access');

require_once("./phpSmug.php");



//https://github.com/lildude/phpSmug
class cedsmugmughelper
{

    public function auth()
    {
        try {
            $f = new phpSmug("APIKey=<API KEY>", "AppName=<APP NAME/VER (URL)>", "OAuthSecret=<OAUTH SECRET>");

            // Perform the 3 step OAuth Authorisation process.
            // NOTE: This is a very simplified example that does NOT store the final token.
            // You will need to ensure your application does.
            if (!isset($_SESSION['SmugGalReqToken'])) {
                // Step 1: Get a Request Token
                $d = $f->auth_getRequestToken();
                $_SESSION['SmugGalReqToken'] = serialize($d);

                // Step 2: Get the User to login to SmugMug and Authorise this demo
                echo "<p>Click <a href='" . $f->authorize() . "' target='_blank'><strong>HERE</strong></a> to Authorize This Demo.</p>";
                echo "<p>A new window/tab will open asking you to login to SmugMug (if not already logged in).  Once you've logged it, SmugMug will redirect you to a page asking you to approve the access (it's read only) to your public photos.  Approve the request and come back to this page and click REFRESH below.</p>";
                echo "<p><a href='" . $_SERVER['PHP_SELF'] . "'><strong>REFRESH</strong></a></p>";
            } else {
                $reqToken = unserialize($_SESSION['SmugGalReqToken']);
                unset($_SESSION['SmugGalReqToken']);

                // Step 3: Use the Request token obtained in step 1 to get an access token
                $f->setToken("id={$reqToken['Token']['id']}", "Secret={$reqToken['Token']['Secret']}");
                $token = $f->auth_getAccessToken(); // The results of this call is what your application needs to store.

                // Set the Access token for use by phpSmug.
                $f->setToken("id={$token['Token']['id']}", "Secret={$token['Token']['Secret']}");

                // Get list of public albums
                $albums = $f->albums_get('Heavy=True');
                // Get list of public images and other useful information
                $images = $f->images_get("AlbumID={$albums['0']['id']}", "AlbumKey={$albums['0']['Key']}", "Heavy=1");
                // Display the thumbnails and link to the Album page for each image
                foreach ($images['Images'] as $image) {
                    echo '<a href="' . $image['URL'] . '"><img src="' . $image['TinyURL'] . '" title="' . $image['Caption'] . '" alt="' . $image['id'] . '" /></a>';
                }
            }
        } catch (Exception $e) {
            echo "{$e->getMessage()} (Error Code: {$e->getCode()})";
        }
    }
}
