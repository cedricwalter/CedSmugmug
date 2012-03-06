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
 * @package	mod_smugmugvideo
 * @copyright	Copyright (C) 2009  Cedric Walter - www.waltercedric.com - All rights reserved.
 *******************************************************************/

// Don't allow direct access to the module.
defined('_JEXEC') or die('Restricted access');

$Width       = $params->get('Width', '450');
$Height       = $params->get('Height', '450');
$Video       = $params->get('Video', 'ZT0xJmk9Mjg1MDE3NTgzJms9cnRxcWomYT0yNTA0NTU5X2YzdGE5JnU9Y21hYw==');

?>
<div class="module">
<!-- module by Cedric Walter - http://www.waltercedric.com - copyright 2009 -->
<object type="application/x-shockwave-flash" data="http://cdn.smugmug.com/ria/ShizVidz-2008042404.swf" width="<?php echo $Width ?>" height="<?php echo $Height ?>" id="smugmugslideshow">
<param name="movie" value="http://cdn.smugmug.com/ria/ShizVidz-2008042404.swf" />
<param name="allowFullScreen" value="true" />
<param name="allowScriptAccess" value="always" />
<param name="flashVars" value="s=<?php echo $Video ?>">
</object>
<div style="text-align: center;">
 <a href="http://www.waltercedric.com" style="font: normal normal normal 10px/normal arial; color: rgb(187, 187, 187); border-bottom-style: none; border-bottom-width: initial; border-bottom-color: initial; text-decoration: none; " onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'" target="_blank"><b>smugmugvideo</b></a>
</div>
</div>
