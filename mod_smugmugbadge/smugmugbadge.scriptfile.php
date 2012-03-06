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
 * @package	mod_smugmugbadge
 * @copyright	Copyright (C) 2009  Cedric Walter - www.waltercedric.com - All rights reserved.
 *******************************************************************/

class Mod_SmugmugBadgeInstallerScript {

	function install($parent) {
		//echo '<p>'. JText::_('1.6 Custom install script') . '</p>';
	}

	function uninstall($parent) {
		//echo '<p>'. JText::_('1.6 Custom uninstall script') .'</p>';
	}

	function update($parent) {
		//echo '<p>'. JText::_('1.6 Custom update script') .'</p>';
	}

	function preflight($type, $parent) {
		//echo '<p>'. JText::sprintf('1.6 Preflight for %s', $type) .'</p>';
	}

	function postflight($type, $parent) {
		//echo '<p>'. JText::sprintf('1.6 Postflight for %s', $type) .'</p>';
	}
}