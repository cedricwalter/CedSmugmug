<?php


// no direct access
defined('_JEXEC') or die;


$flashVariables = 'autorepeat=' . $autorepeat;
$flashVariables .= '&amp;gridRows=' . $gridRows;
$flashVariables .= '&amp;gridColumns=' . $gridColumns;
$flashVariables .= '&amp;gridSpacing=' . $gridSpacing;
$flashVariables .= '&amp;gridDelay=' . $gridDelay;
$flashVariables .= '&amp;autoHideDelay=' . $autoHideDelay;
$flashVariables .= '&amp;slideshowDelay=' . $slideshowDelay;
$flashVariables .= '&amp;autostart=' . $autostart;
$flashVariables .= '&amp;aboutlink=' . $aboutlink;
$flashVariables .= '&amp;sharelink=' . $sharelink;
$flashVariables .= '&amp;background=%23' . $background;
$flashVariables .= '&amp;forceSize=' . $forceSize;
$flashVariables .= '&amp;displayMode=' . $displayMode;
$flashVariables .= '&amp;useLargeImages=' . $useLargeImages;
$flashVariables .= '&amp;albums=' . $albums;
$flashVariables .= '&amp;gapImage=http%3A%2F%2Fphotos.smugmug.com%2Fimg%2Fbesocial%2Finvisible_filler.png';
$flashVariables .= '&amp;gapImageTarget=' . $gapImageTarget;
$flashVariables .= '&amp;preloaderGlow=%23' . $preloaderGlow;
$flashVariables .= '&amp;preloaderColor=%23' . $preloaderColor;
$flashVariables .= '&amp;order=' . $order;
$flashVariables .= '&amp;width=' . $Width;
$flashVariables .= '&amp;height=' . $Height;
$flashVariables .= '&amp;BadgeHost=cdn.smugmug.com';
$flashVariables .= '&amp;mode=box';
?>
<div class="module<?php echo $params->get('moduleclass_sfx');?>">
    <!-- module by Cedric Walter - http://www.waltercedric.com - copyright 2009 -->
    <object type="application/x-shockwave-flash" data="http://cdn.smugmug.com/swfs/badge/flashbadge.swf" width="<?php echo $Width ?>"
            height="<?php echo $Height ?>" id="smugmugbadge">
        <param name="movie" value="http://cdn.smugmug.com/swfs/badge/flashbadge.swf"/>
        <param name="flashvars" value="<?php echo $flashVariables ?>"/>
        <param name="wmode" value="transparent">
    </object>
    <div style="text-align: center;">
        <a href="http://www.waltercedric.com"
           style="font: normal normal normal 10px/normal arial; color: rgb(187, 187, 187); border-bottom: 0 none white; text-decoration: none; "
           onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'" target="_blank"><strong>smugmugbadge</strong></a>
    </div>
</div>