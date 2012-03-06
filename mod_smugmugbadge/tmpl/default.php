<?php


// no direct access
defined('_JEXEC') or die;


$flashvars = 'autorepeat='.$autorepeat;
$flashvars .= '&amp;gridRows='.$gridRows;
$flashvars .= '&amp;gridColumns='.$gridColumns;
$flashvars .= '&amp;gridSpacing='.$gridSpacing;
$flashvars .= '&amp;gridDelay='.$gridDelay;
$flashvars .= '&amp;autoHideDelay='.$autoHideDelay;
$flashvars .= '&amp;slideshowDelay='.$slideshowDelay;
$flashvars .= '&amp;autostart='.$autostart;
$flashvars .= '&amp;aboutlink='.$aboutlink;
$flashvars .= '&amp;sharelink='.$sharelink;
$flashvars .= '&amp;background=%23'.$background;
$flashvars .= '&amp;forceSize='.$forceSize;
$flashvars .= '&amp;displayMode='.$displayMode;
$flashvars .= '&amp;useLargeImages='.$useLargeImages;
$flashvars .= '&amp;albums='.$albums;
$flashvars .= '&amp;gapImage=http%3A%2F%2Fphotos.smugmug.com%2Fimg%2Fbesocial%2Finvisible_filler.png';
$flashvars .= '&amp;gapImageTarget='.$gapImageTarget;
$flashvars .= '&amp;preloaderGlow=%23'.$preloaderGlow;
$flashvars .= '&amp;preloaderColor=%23'.$preloaderColor;
$flashvars .= '&amp;order='.$order;
$flashvars .= '&amp;width='.$Width;
$flashvars .= '&amp;height='.$Height;
$flashvars .= '&amp;BadgeHost=cdn.smugmug.com';
$flashvars .= '&amp;mode=box';
?>
<div class="module<?php echo $params->get('moduleclass_sfx');?>">
<!-- module by Cedric Walter - http://www.waltercedric.com - copyright 2009 -->
<object type="application/x-shockwave-flash" data="http://cdn.smugmug.com/swfs/badge/flashbadge.swf" width="<?php echo $Width ?>" height="<?php echo $Height ?>" id="smugmugbadge">
<param name="movie" value="http://cdn.smugmug.com/swfs/badge/flashbadge.swf" />
<param name="flashvars" value="<?php echo $flashvars ?>" />
<param name="wmode" value="transparent">
</object>
<div style="text-align: center;">
 <a href="http://www.waltercedric.com" style="font: normal normal normal 10px/normal arial; color: rgb(187, 187, 187); border-bottom-style: none; border-bottom-width: initial; border-bottom-color: initial; text-decoration: none; " onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'" target="_blank"><b>smugmugbadge</b></a>
</div>
</div>