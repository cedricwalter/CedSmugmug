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
 * @package    mod_smugmugslideshow
 * @copyright    Copyright (C) 2009  Cedric Walter - www.waltercedric.com - All rights reserved.
 *******************************************************************/

// Don't allow direct access to the module.
defined('_JEXEC') or die('Restricted access');

$width = $params->get('width');
$height = $params->get('height');
$howSpeed = $params->get('howSpeed') == 1 ? 'true' : 'false';
$autoStart = $params->get('autoStart') == 1 ? 'true' : 'false';
$captions = $params->get('captions') == 1 ? 'true' : 'false';
$showLogo = $params->get('showLogo') == 1 ? 'true' : 'false';
$clickToImage = $params->get('clickToImage') == 1 ? 'true' : 'false';
$splashurl = $params->get('splashurl');
$showThumbs = $params->get('showThumbs') == 1 ? 'true' : 'false';
$albumID = $params->get('albumID');
$albumKey = $params->get('albumKey');
$showStartButton = $params->get('showStartButton') == 1 ? 'true' : 'false';
$showButtons = $params->get('showButtons') == 1 ? 'true' : 'false';
$transparent = $params->get('transparent') == 1 ? 'true' : 'false';
$bgColor = $params->get('bgColor');
$crossFadeSpeed = $params->get('crossFadeSpeed');
$feedURL = urlencode($params->get('feedURL'));
//"http%3A%2F%2Fapi.smugmug.com%2Fhack%2Ffeed.mg%3FType%3Dgallery%2526Data%3D7421071_53xgf%2526format%3Drss200";
$randomStart = $params->get('randomStart') == 1 ? 'true' : 'false';
$randomize = $params->get('randomize') == 1 ? 'true' : 'false';
$borderThickness = $params->get('borderThickness');
$borderColor = $params->get('borderColor');
$forceSize = $params->get('forceSize');
$borderCornerStyle = $params->get('borderCornerStyle');
$imgAlign = $params->get('imgAlign');

$flashVariables = 'howSpeed=' . $howSpeed;
$flashVariables .= '&amp;autoStart=' . $autoStart;
$flashVariables .= '&amp;captions=' . $captions;
$flashVariables .= '&amp;showLogo=' . $showLogo;
$flashVariables .= '&amp;clickToImage=' . $clickToImage;
$flashVariables .= '&amp;splashurl=' . $splashurl;
$flashVariables .= '&amp;showThumbs=' . $showThumbs;

if (strlen($albumID) > 0) {
    $flashVariables .= '&amp;albumID=' . $albumID;
    $flashVariables .= '&amp;albumKey=' . $albumKey;
}

$flashVariables .= '&amp;showStartButton=' . $showStartButton;
$flashVariables .= '&amp;showButtons=' . $showButtons;
$flashVariables .= '&amp;transparent=' . $transparent;
$flashVariables .= '&amp;bgColor=' . $bgColor;
$flashVariables .= '&amp;crossFadeSpeed=' . $crossFadeSpeed;

if (strlen($feedURL) > 0) {
    $flashVariables .= '&amp;feedURL=' . $feedURL;
}
$flashVariables .= '&amp;randomStart=' . $randomStart;
$flashVariables .= '&amp;randomize=' . $randomize;
$flashVariables .= '&amp;borderThickness=' . $borderThickness;
$flashVariables .= '&amp;borderColor=' . $borderColor;
$flashVariables .= '&amp;forceSize=' . $forceSize;
$flashVariables .= '&amp;borderCornerStyle=' . $borderCornerStyle;
$flashVariables .= '&amp;imgAlign=' . $imgAlign;

require JModuleHelper::getLayoutPath('mod_smugmugslideshow', $params->get('layout', 'default'));
