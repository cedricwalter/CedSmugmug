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

defined('_JEXEC') or die;

$script = 'function insertPhotofeed() {' . "\n\t";
// Get the pagebreak toc alias -- not inserting for now
// don't know which attribute to use...
$script .= 'var limit = document.getElementById("limit").value;' . "\n\t";
$script .= 'var rss = document.getElementById("rss").value;' . "\n\t";
$script .= 'var startAtPhoto = document.getElementById("startAtPhoto").value;' . "\n\t";

$script .= 'var tag = "{rss uri="+rss+" limit="+limit+" from="+startAtPhoto+"}";' . "\n\t";
$script .= 'window.parent.jInsertEditorText(tag, \'' . $this->eName . '\');' . "\n\t";
$script .= 'window.parent.SqueezeBox.close();' . "\n\t";
$script .= 'return false;' . "\n";
$script .= '}' . "\n";

JFactory::getDocument()->addScriptDeclaration($script);
?>
<form>
    <h4>This is a small content plugin for Joomla! that allow you to inline a set of images from your favorite online
        gallery: Smugmug, Flickr, Picasa or any RSS feed in any article.</h4>


    <h4>Picasa</h4>
    <small>rss=http://picasaweb.google.com/data/feed/base/user/115504007740680881345/albumid/5447801847496445393?alt=rss&amp;kind=photo&amp;hl=en_US</small>

    Picasa provides atom feeds of public albums and images. There are two basic feeds, one for albums, and one for images:

    All albums: http://picasaweb.google.com/data/feed/api/user/cedricwalter?kind=album
    All images: http://picasaweb.google.com/data/feed/api/user/cedricwalter?kind=photo
    Images in an album: http://picasaweb.google.com/data/feed/api/user/cedricwalter/album/Moon?kind=photo


    <h4>Flickr</h4>
    <small>rss=http://api.flickr.com/services/feeds/photos_public.gne?id=45007589@N00〈=en-us&amp;format=rss_200</small>
    <h4>SmugMug</h4>
    <small>rss=http://cedricwalter.smugmug.com/hack/feed.mg?Type=gallery&amp;Data=4311718_bRCBj&amp;format=rss200</small>
    <br />
    <hr />
    <br />
    <table width="100%" align="center">
        <tr width="50%">
            <td class="key" align="right">
                <label for="title">
                    <?php echo JText::_('rss'); ?>
                </label>
            </td>
            <td>
                <input type="text" id="rss" name="rss" size="50"  value="http://cedricwalter.smugmug.com/hack/feed.mg?Type=gallery&Data=4311718_bRCBj&format=rss200"/>
            </td>
        </tr>
        <tr width="50%">
            <td class="key" align="right">
                <label for="alias">
                    <?php echo JText::_('Number of images to display'); ?>
                </label>
            </td>
            <td>
                <input type="text" id="limit" name="limit" value="10"/>
            </td>
        </tr>
        <tr width="50%">
                    <td class="key" align="right">
                        <label for="alias">
                            <?php echo JText::_('Start at images (optional)'); ?>
                        </label>
                    </td>
                    <td>
                        <input type="text" id="startAtPhoto" name="startAtPhoto" value=""/>
                    </td>
        </tr>
    </table>
</form>
<button onclick="insertPhotofeed();"><?php echo JText::_('Insert Photofeed'); ?></button>
