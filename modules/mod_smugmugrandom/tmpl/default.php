<?php


// no direct access
defined('_JEXEC') or die;
?>
<div class="module<?php echo $params->get('moduleclass_sfx'); ?>">
    <!-- module by Cedric Walter - http://www.waltercedric.com - copyright 2009 -->
    <a href="<?php echo $baseGallery ?>" rel="<?php echo $Library ?>">
        <img src="<?php echo $randomImage ?>"
             alt=""
             title="<?php echo $Title ?>"/>
    </a>

    <div style="text-align: center;">
        <a href="http://www.waltercedric.com"
           style="font: normal normal normal 10px/normal arial; color: rgb(187, 187, 187); border-bottom: 0 none white; text-decoration: none; "
           onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'" target="_blank"><strong>smugmugbadge</strong></a>
    </div>
</div>