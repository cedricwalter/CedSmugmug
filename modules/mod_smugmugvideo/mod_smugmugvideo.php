<?php
/** ****************************************************************
 * This file is part of mod_smugmugvideo.
 *
 * mod_smugmugvideo is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 * mod_smugmugvideo is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with mod_smugmugvideo.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package    mod_smugmugvideo
 * @copyright    Copyright (C) 2009  Cedric Walter - www.waltercedric.com - All rights reserved.
 *******************************************************************/

// Don't allow direct access to the module.
defined('_JEXEC') or die('Restricted access');

$Width = $params->get('Width', '450');
$Height = $params->get('Height', '450');
$albumID = $params->get('albumID', "1792989446");
$albumKey = $params->get('albumKey', "726WRdK");
$autoplay = intval($params->get('autoplay', 0));

$autoplayUrl = "";
if ($autoplay) {
    $autoplayUrl = "&autoplay=$autoplay";
}
//http://help.smugmug.com/customer/portal/articles/84570-is-there-a-video-faq-

require JModuleHelper::getLayoutPath('mod_smugmugvideo', $params->get('layout', 'default'));


