<?php


// no direct access
defined('_JEXEC') or die;
?>

<div class="module">
    <!-- module by Cedric Walter - http://www.waltercedric.com - copyright 2009 -->
    <iframe frameborder="0"
            scrolling="no"
            width="<?php echo $Width ?>"
            height="<?php echo $Height ?>"
            src="http://api.smugmug.com/services/embed/<?php echo $albumID ?>_<?php echo $albumKey ?>?width=<?php echo $Width ?>&height=<?php echo $Height ?><?php echo $autoplayUrl ?>">
    </iframe>

    <div style="text-align: center;">
        <a href="http://www.waltercedric.com"
           style="font: normal normal normal 10px/normal arial; color: rgb(187, 187, 187); border-bottom-style: none; border-bottom-width: inherit; border-bottom-color: inherit; text-decoration: none; "
           onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'" target="_blank"><b>smugmugvideo</b></a>
    </div>
</div>