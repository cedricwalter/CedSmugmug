<?php
/** ****************************************************************
 * This file is part of mod_smugmugslideshow.
 *
 * mod_smugmugslideshow is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.

 * mod_smugmugslideshow is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with mod_smugmugslideshow.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package	mod_smugmugslideshow
 * @copyright	Copyright (C) 2009  Cedric Walter - www.waltercedric.com - All rights reserved.
 *******************************************************************/

// Don't allow direct access to the module.
defined('_JEXEC') or die('Restricted access');

$width          = $params->get('width');
$height         = $params->get('height');
$howSpeed       = $params->get('howSpeed') == 1 ? 'true' : 'false';
$autoStart      = $params->get('autoStart') == 1 ? 'true' : 'false';
$captions       = $params->get('captions') == 1 ? 'true' : 'false';
$showLogo       = $params->get('showLogo') == 1 ? 'true' : 'false';
$clickToImage   = $params->get('clickToImage') == 1 ? 'true' : 'false';
$splashurl      = $params->get('splashurl');
$showThumbs     = $params->get('showThumbs') == 1 ? 'true' : 'false';
$albumID        = $params->get('albumID');
$albumKey       = $params->get('albumKey');
$showStartButton   = $params->get('showStartButton') == 1 ? 'true' : 'false';
$showButtons       = $params->get('showButtons') == 1 ? 'true' : 'false';
$transparent       = $params->get('transparent') == 1 ? 'true' : 'false';
$bgColor           = $params->get('bgColor');
$crossFadeSpeed    = $params->get('crossFadeSpeed');
$feedURL           = urlencode($params->get('feedURL'));
//"http%3A%2F%2Fapi.smugmug.com%2Fhack%2Ffeed.mg%3FType%3Dgallery%2526Data%3D7421071_53xgf%2526format%3Drss200";
$randomStart       = $params->get('randomStart') == 1 ? 'true' : 'false';
$randomize         = $params->get('randomize') == 1 ? 'true' : 'false';
$borderThickness   = $params->get('borderThickness');
$borderColor       = $params->get('borderColor');
$forceSize         = $params->get('forceSize');
$borderCornerStyle = $params->get('borderCornerStyle');
$imgAlign          = $params->get('imgAlign');
?>

<div class="module">
<center>
<!-- module by Cedric Walter - http://www.waltercedric.com - copyright 2009 -->
<object type="application/x-shockwave-flash" data="media/com_cedsmugmug/ShizamSlides-2011042105.swf" align="center" width="<?php echo $width ?>" height="<?php echo $height ?>" id="smugmugslideshow">
<param name="movie" value="media/com_cedsmugmug/ShizamSlides-2011042105.swf" />

<?php
$flashvars = 'howSpeed='.$howSpeed;
$flashvars .= '&amp;autoStart='.$autoStart;
$flashvars .= '&amp;captions='.$captions;
$flashvars .= '&amp;showLogo='.$showLogo;
$flashvars .= '&amp;clickToImage='.$clickToImage;
$flashvars .= '&amp;splashurl='.$splashurl;
$flashvars .= '&amp;showThumbs='.$showThumbs;

if (strlen($albumID) > 0)
{
$flashvars .= '&amp;albumID='.$albumID;
$flashvars .= '&amp;albumKey='.$albumKey;
}

$flashvars .= '&amp;showStartButton='.$showStartButton;
$flashvars .= '&amp;showButtons='.$showButtons;
$flashvars .= '&amp;transparent='.$transparent;
$flashvars .= '&amp;bgColor='.$bgColor;
$flashvars .= '&amp;crossFadeSpeed='.$crossFadeSpeed;

if (strlen($feedURL) > 0)
{
  $flashvars .= '&amp;feedURL='.$feedURL;
}
$flashvars .= '&amp;randomStart='.$randomStart;
$flashvars .= '&amp;randomize='.$randomize;
$flashvars .= '&amp;borderThickness='.$borderThickness;
$flashvars .= '&amp;borderColor='.$borderColor;
$flashvars .= '&amp;forceSize='.$forceSize;
$flashvars .= '&amp;borderCornerStyle='.$borderCornerStyle;
$flashvars .= '&amp;imgAlign='.$imgAlign;
?>
<param name="flashvars" value="<?php echo $flashvars ?>" />

<param name="wmode" value="transparent">
<param name="howSpeed" value="<?php echo $howSpeed ?>" />
<param name="autoStart" value="<?php echo $autoStart ?>" />
<param name="captions" value="<?php echo $captions ?>" />
<param name="showLogo" value="<?php echo $showLogo ?>" />
<param name="clickToImage" value="<?php echo $clickToImage ?>" />
<param name="splashurl" value="<?php echo $splashurl ?>" />
<param name="showThumbs" value="<?php echo $showThumbs ?>" />

<?php
if (strlen($albumID) > 0) {
?>
<param name="albumID" value="<?php echo $albumID ?>" />
<param name="albumKey" value="<?php echo $albumKey ?>" />
<?php
}
?>

<param name="showStartButton" value="<?php echo $showStartButton ?>" />
<param name="showButtons" value="<?php echo $showButtons ?>" />
<param name="transparent" value="<?php echo $transparent ?>" />
<param name="bgColor" value="<?php echo $bgColor ?>" />
<param name="crossFadeSpeed" value="<?php echo $crossFadeSpeed ?>" />

<?php
if (strlen($feedURL) > 0) {
?>
 <param name="feedURL" value="<?php echo $feedURL ?>" />
<?php
}
?>
<param name="randomStart" value="<?php echo $randomStart ?>" />
<param name="randomize" value="<?php echo $randomize ?>" />
<param name="borderThickness" value="<?php echo $borderThickness ?>" />
<param name="borderColor" value="<?php echo $borderColor ?>" />
<param name="forceSize" value="<?php echo $forceSize ?>" />
<param name="borderCornerStyle" value="<?php echo $borderCornerStyle ?>" />
<param name="imgAlign" value="<?php echo $imgAlign ?>" />

<param name="allowNetworking" value="all" />
<param name="allowScriptAccess" value="always" />

</object>
</center>
<div style="text-align: center;">
 <a href="http://www.waltercedric.com" style="font: normal normal normal 10px/normal arial; color: rgb(187, 187, 187); border-bottom-style: none; border-bottom-width: initial; border-bottom-color: initial; text-decoration: none; " onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'" target="_blank"><b>smugmugslideshow</b></a>
</div>
</div>
