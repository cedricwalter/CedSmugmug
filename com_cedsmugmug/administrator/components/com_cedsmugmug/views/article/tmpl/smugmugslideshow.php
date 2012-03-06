<?php
/**
 * @package		cedSmugmug for Joomla
 * @copyright	Copyright (C) 2010-2012 Cedric Walter. All rights reserved.
 *    www.waltercedric.com / www.cedricwalter.com
 * @license		GNU General Public License version 3 or later; see LICENSE.txt
*/
defined('_JEXEC') or die;

$script = 'function insertSmugmugSlideshow() {' . "\n\t";
// Get the pagebreak toc alias -- not inserting for now
// don't know which attribute to use...
$script .= 'var uri = document.getElementById("uri").value;' . "\n\t";
$script .= 'var id = document.getElementById("id").value;' . "\n\t";
$script .= 'var key = document.getElementById("key").value;' . "\n\t";

$script .= 'var tag = "{smugmugslideshow uri="+uri+" id="+id+" key="+key+"}";' . "\n\t";
$script .= 'window.parent.jInsertEditorText(tag, \'' . $this->eName . '\');' . "\n\t";
$script .= 'window.parent.SqueezeBox.close();' . "\n\t";
$script .= 'return false;' . "\n";
$script .= '}' . "\n";

JFactory::getDocument()->addScriptDeclaration($script);
?>
<h4>This module is a front end for the myriad of parameter that can set for the Smugmug flash applet.
A great visual and a lot of features are built into this widget.</h4>

<h4>uri of album</h4>
To get the correct feed according to your gallery,
<ol>
<li>At the bottom of your gallery, click on "Available Feeds"</li>
<li>click on RSS,</li>
<li>copy the url of your browser bar which MUST look like http://cedricwalter.smugmug.com/hack/feed.mg?Type=gallery&Data=8740425_h9ZXo&format=rss200</li>
<li>replace your nickname (xxxxxxxx) with api so it look like
http://api.smugmug.com/hack/feed.mg?Type=gallery&Data=8740425_h9ZXo&format=rss200</li>
</ol>

<h4>key of album</h4>
The album key is located in the URL when viewing any of your albums.
for instance when viewing an image from a gallery
<a href="http://cedricwalter.smugmug.com/gallery/2504559_f3ta9#131481399">http://cedricwalter.smugmug.com/gallery/2504559_f3ta9#131481399</a>
the album key is 2504559

<h4>id of album</h4>
The album key is located in the URL when viewing any of your albums.
for instance when viewing an image from a gallery
<a href="http://cedricwalter.smugmug.com/gallery/2504559_f3ta9#131481399">http://cedricwalter.smugmug.com/gallery/2504559_f3ta9#131481399</a>
the album key is f3ta9

<br />
<hr />
<br />

<form>
    <table width="100%" align="center">
        <tr width="50 % ">
            <td class="key" align="right">
                <label for="uri">
                    <?php echo JText::_('Rss'); ?>
                </label>
            </td>
            <td>
                <input type="text" id="uri" name="uri" size="50" value="http://api.smugmug.com/hack/feed.mg?Type=gallery&Data=8740425_h9ZXo&format=rss200"/>
            </td>
        </tr>
        <tr width="50 % ">
            <td class="key" align="right">
                <label for="id">
                    <?php echo JText::_('id'); ?>
                </label>
            </td>
            <td>
                <input type="text" id="id" name="id" value="f3ta9"/>
            </td>
        </tr>
        <tr width="50 % ">
            <td class="key" align="right">
                <label for="key">
                    <?php echo JText::_('key'); ?>
                </label>
            </td>
            <td>
                <input type="text" id="key" name="key" value="2504559"/>
            </td>
        </tr>
    </table>
</form>
<button onclick="insertSmugmugSlideshow();"><?php echo JText::_('Insert Smugmug Slideshow'); ?></button>