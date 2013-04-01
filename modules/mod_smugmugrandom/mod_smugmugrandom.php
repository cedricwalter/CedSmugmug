<?php
/** ****************************************************************
 * This file is part of mod_smugmugrandom.
 *
 * mod_smugmugrandom is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.

 * mod_smugmugrandom is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with mod_smugmugrandom.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package	mod_smugmugrandom
 * @copyright	Copyright (C) 2009  Cedric Walter - www.waltercedric.com - All rights reserved.
 *******************************************************************/

// Don't allow direct access to the module.
defined('_JEXEC') or die('Restricted access');

$Base       = $params->get('Base', 'http://cedricwalter.smugmug.com');
$AlbumID       = $params->get('AlbumID', '7421071');
$AlbumKey       = $params->get('AlbumKey', '53xgf');
$Width       = $params->get('Width', '150');
$Height       = $params->get('Height', '150');
$Title       = $params->get('Title', 'Some of my Favorite Shots');
$Library     = $params->get('Library', 'lightbox');

$randomImage = $Base.'/photos/random.mg?AlbumID='.$AlbumID.'&AlbumKey='.$AlbumKey.'&Size='.$Width.'x'.$Height.'';
$baseGallery = $Base.'/gallery/'.$AlbumID.'_'.$AlbumKey;

require JModuleHelper::getLayoutPath('mod_smugmugrandom', $params->get('layout', 'default'));

