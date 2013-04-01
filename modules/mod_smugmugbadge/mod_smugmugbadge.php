<?php
/** ****************************************************************
 * This file is part of mod_smugmugbadge.
 *
 * mod_smugmugbadgeis free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 * mod_smugmugbadge is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with mod_smugmugbadge.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package    mod_smugmugbadge
 * @copyright    Copyright (C) 2009  Cedric Walter - www.waltercedric.com - All rights reserved.
 *******************************************************************/

// Don't allow direct access to the module.
defined('_JEXEC') or die('Restricted access');

$Width = $params->get('Width', '200');
$Height = $params->get('Height', '200');
$autorepeat = $params->get('autorepeat') == 1 ? 'true' : 'false';
$gridRows = $params->get('gridRows', '3');
$gridColumns = $params->get('gridColumns', '4');
$gridSpacing = $params->get('gridSpacing', '1');
$gridDelay = $params->get('gridDelay', '2');
$autoHideDelay = $params->get('autoHideDelay', '4');
$slideshowDelay = $params->get('slideshowDelay', '4');
$autostart = $params->get('autostart') == 1 ? 'true' : 'false';
$useLargeImages = $params->get('useLargeImages') == 1 ? 'true' : 'false';

$aboutlink = $params->get('aboutlink', '');
$sharelink = $params->get('sharelink', '');

$background = $params->get('background', '000000');
$preloaderColor = $params->get('preloaderColor', 'FFFFFF');
$preloaderGlow = $params->get('preloaderGlow', 'FFFFFF');

$displayMode = $params->get('displayMode', 'full');
$forceSize = $params->get('forceSize', '');
$order = $params->get('order', 'norandom');

$gapImageTarget = '';

$AlbumID1 = $params->get('AlbumID1', '7421071');
$AlbumKey1 = $params->get('AlbumKey1', '53xgf');
$AlbumID2 = $params->get('AlbumID2', '7421071');
$AlbumKey2 = $params->get('AlbumKey2', '53xgf');
$AlbumID3 = $params->get('AlbumID3', '7421071');
$AlbumKey3 = $params->get('AlbumKey3', '53xgf');
$AlbumID4 = $params->get('AlbumID4', '7421071');
$AlbumKey4 = $params->get('AlbumKey4', '53xgf');

$count = 0;
$count = strlen($AlbumID1) > 0 ? $count + 1 : $count;
$count = strlen($AlbumID2) > 0 ? $count + 1 : $count;
$count = strlen($AlbumID3) > 0 ? $count + 1 : $count;
$count = strlen($AlbumID4) > 0 ? $count + 1 : $count;

$index = rand(1, $count);

$albumid = 'AlbumID' . $index;
$albumkey = 'AlbumKey' . $index;

$albums = 'http%3A%2F%2Fapi.smugmug.com%2Fhack%2Ffeed.mg%3FType%3Dgallery%26Data%3D' . $$albumid . '_' . $$albumkey . '%26format%3Drss200%26Sandboxed%3D1';

require JModuleHelper::getLayoutPath('mod_smugmugbadge', $params->get('layout', 'default'));



