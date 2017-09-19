<?php
/**
 * @package     cedSmugMug
 * @subpackage  com_cedsmugmug
 *
 * @copyright   Copyright (C) 2013-2017 galaxiis.com All rights reserved.
 * @license     The author and holder of the copyright of the software is Cédric Walter. The licensor and as such issuer of the license and bearer of the
 *              worldwide exclusive usage rights including the rights to reproduce, distribute and make the software available to the public
 *              in any form is Galaxiis.com
 *              see LICENSE.txt
 * @id ${licenseId}
 */

defined('_JEXEC') or die;

$script = array();

$script[] = 'function insertSmugmugBadge() {';


$script[] = 'var type = document.getElementById("type").value;';
$script[] = 'var nickname = document.getElementById("nickname").value;';
$script[] = 'var keyword = document.getElementById("keyword").value;';
$script[] = 'var albumIdKey = document.getElementById("albumIdKey").value;';

$script[] = 'function getSmugmugFeed(type, albumIdKey, nickname, keyword) {';
$script[] = '    var feed="none";';
$script[] = '    switch (type) {';
$script[] = '        case "0": //Galleries badge';
//$script[] = '            if (albumIdKey = "") {alert("AlbumIdKey should not be empty"); }';
$script[] = '            feed = "http://api.smugmug.com/hack/feed.mg?Type=gallery&Data="+albumIdKey+"&format=rss200";';
$script[] = '            break;';
$script[] = '       case "1": //Popular Photo Feeds';
$script[] = '           feed = "http://api.smugmug.com/hack/feed.mg?Type=popularNickname&Data="+nickname+"&format=rss200&Size=Thumb";';
$script[] = '           break;';
$script[] = '       case "2": //Recent Photo Feeds';
$script[] = '           feed = "http://api.smugmug.com/hack/feed.mg?Type=nicknameRecentPhotos&Data="+nickname+"&format=rss200&Size=Thumb";';
$script[] = '           break;';
$script[] = '       case "3": //Keyword Photo Feeds';
$script[] = '           feed = "http://api.smugmug.com/hack/feed.mg?Type=userkeyword&NickName="+nickname+"&Data="+keyword+"&format=rss200&Size=Thumb";';
$script[] = '           break;';
$script[] = '   }';
$script[] = '   return feed;';
$script[] = '}';

$script[] = 'var rss = getSmugmugFeed(type, albumIdKey, nickname, keyword);';
$script[] = 'var rowMax = document.getElementById("rowMax").value;';
$script[] = 'var colMax = document.getElementById("colMax").value;';
$script[] = 'var gridSpacing = document.getElementById("gridSpacing").value;';

$script[] = 'var galleryTitle = document.getElementById("galleryTitle").value;';
$script[] = 'var galleryDescription = document.getElementById("galleryDescription").value;';
$script[] = 'var galleryCategory = document.getElementById("galleryCategory").value;';
$script[] = 'var galleryLinkable = document.getElementById("galleryLinkable").value;';

$script[] = 'var thumbnailssize = document.getElementById("thumbnailssize").value;';
$script[] = 'var imagesize = document.getElementById("imagesize").value;';

$script[] = 'var tag = "{cedsmugmugbadge rss="+rss+" rowMax="+rowMax+" colMax="+colMax+" gridSpacing="+gridSpacing+" galleryTitle="+galleryTitle+" galleryDescription="+galleryDescription+" galleryCategory="+galleryCategory+" galleryLinkable="+galleryLinkable+" thumbnailssize="+thumbnailssize+" imagesize="+imagesize+"}";';

$script[] = 'window.parent.jInsertEditorText(tag, \'' . $this->eName . '\');';
$script[] = 'window.parent.SqueezeBox.close();';
$script[] = 'return false;';
$script[] = '}';

JFactory::getDocument()->addScriptDeclaration(implode("\n\t", $script));
?>
<form>
    <table width="100%" align="center">
        <table>
            <tr>
                <td class="key" align="right">
                    <label for="title">
                        <?php echo JText::_('Type'); ?>
                    </label>
                </td>
                <td>
                    <select name="type" id="type">
                        <option value="0">Galleries badge</option>
                        <option value="1">Popular Photo Feeds</option>
                        <option value="2">Recent Photo Feeds</option>
                        <option value="3">Keyword Photo Feeds</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td class="key" align="right">
                    <label for="title">
                        <?php echo JText::_('Album IdKey '); ?>
                    </label>
                </td>
                <td>
                    <input class="input" type="text" id="albumIdKey" name="albumIdKey" placeholder="example: 7421071_53xgf"/>* for Galleries Badge.
                </td>
            </tr>

            <tr>
                <td class="key" align="right">
                    <label for="title">
                        <?php echo JText::_('Nickname'); ?>
                    </label>
                </td>
                <td>
                    <input class="input" type="text" id="nickname" name="nickname" placeholder="example: cedricwalter"/> * for Popular, Recent & Keyword.
                </td>
            </tr>

            <tr>
                <td class="key" align="right">
                    <label for="title">
                        <?php echo JText::_('Keyword'); ?>
                    </label>
                </td>
                <td>
                    <input class="input" type="text" id="keyword" name="keyword" placeholder="example: hornet"/> * for Keyword.
                </td>
            </tr>


            <tr>
                <td class="key" align="right">
                    <label for="alias">
                        <?php echo JText::_('Max Rows'); ?>
                    </label>
                </td>
                <td>
                    <input class="input" type="text" id="rowMax" name="rowMax" value="4" placeholder="Enter the max number of row."/>
                </td>
            </tr>

            <tr>
                <td class="key" align="right">
                    <label for="alias">
                        <?php echo JText::_('Max Columns'); ?>
                    </label>
                </td>
                <td>
                    <input class="input" type="text" id="colMax" name="colMax" value="1" placeholder="Enter the max number of columns."/>
                </td>
            </tr>

            <tr>
                <td class="key" align="right">
                    <label for="alias">
                        <?php echo JText::_('Grid Spacing in pixels'); ?>
                    </label>
                </td>
                <td>
                    <input class="input" type="text" id="gridSpacing" name="gridSpacing" value="1" placeholder="Enter the space in pixels between images."/>
                </td>
            </tr>

            <tr>
                <td class="key" align="right">
                    <label for="alias">
                        <?php echo JText::_('Display Gallery Title'); ?>
                    </label>
                </td>
                <td>
                    <input class="input" type="checkbox" name="galleryTitle" id="galleryTitle" value="1">
                </td>
            </tr>

            <tr>
                <td class="key" align="right">
                    <label for="alias">
                        <?php echo JText::_('Display Gallery Description'); ?>
                    </label>
                </td>
                <td>
                    <input class="input" type="checkbox" name="galleryDescription" id="galleryDescription" value="1">
                </td>
            </tr>

            <tr>
                <td class="key" align="right">
                    <label for="alias">
                        <?php echo JText::_('Display Gallery Category'); ?>
                    </label>
                </td>
                <td>
                    <input class="input" type="checkbox" name="galleryCategory" id="galleryCategory" value="1">
                </td>
            </tr>

            <tr>
                <td class="key" align="right">
                    <label for="alias">
                        <?php echo JText::_('Display Gallery Linkable'); ?>
                    </label>
                </td>
                <td>
                    <input class="input" type="checkbox" name="galleryLinkable" id="galleryLinkable" value="1">
                </td>
            </tr>

            <tr>
                <td class="key" align="right">
                    <label for="alias">
                        <?php echo JText::_('Thumbnails Size'); ?>
                    </label>
                </td>
                <td>
                    <select name="thumbnailssize" id="thumbnailssize">
                        <option value="-Ti">Tiny thumbnails - up to 100x100</option>
                        <option value="-Th">Large thumbnails - up to 150x150</option>
                        <option value="-S">Small - up to 400x300</option>
                        <option value="-M">Medium - up to 600x450</option>
                        <option value="-L">Large - up to 800x600</option>
                        <option value="-XL">XLarge - up to 1024x768</option>
                        <option value="-X2">X2Large - up to 1280x960</option>
                        <option value="-X3">X3Large - up to 1600x1200</option>
                        <option value="">Original size</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td class="key" align="right">
                    <label for="alias">
                        <?php echo JText::_('Image Size'); ?>
                    </label>
                </td>
                <td>
                    <select name="imagesize" id="imagesize">
                        <option value="-Ti">Tiny thumbnails - up to 100x100</option>
                        <option value="-Th">Large thumbnails - up to 150x150</option>
                        <option value="-S">Small - up to 400x300</option>
                        <option value="-M">Medium - up to 600x450</option>
                        <option value="-L">Large - up to 800x600</option>
                        <option value="-XL">XLarge - up to 1024x768</option>
                        <option value="-X2">X2Large - up to 1280x960</option>
                        <option value="-X3">X3Large - up to 1600x1200</option>
                        <option value="">Original size</option>
                    </select>
                </td>
            </tr>


        </table>


    </table>
</form>
<button onclick="insertSmugmugBadge();"><?php echo JText::_('Insert Smugmug Badge'); ?></button>