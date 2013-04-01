<?php


// no direct access
defined('_JEXEC') or die;
?>

<div class="module">
    <!-- module by Cedric Walter - http://www.waltercedric.com - copyright 2009 -->
    <object type="application/x-shockwave-flash" data="media/com_cedsmugmug/ShizamSlides-2011042105.swf" align="center" width="<?php echo $width ?>"
            height="<?php echo $height ?>" id="smugmugslideshow">
        <param name="movie" value="media/com_cedsmugmug/ShizamSlides-2011042105.swf"/>
        <param name="flashvars" value="<?php echo $flashVariables ?>"/>

        <param name="wmode" value="transparent">
        <param name="howSpeed" value="<?php echo $howSpeed ?>"/>
        <param name="autoStart" value="<?php echo $autoStart ?>"/>
        <param name="captions" value="<?php echo $captions ?>"/>
        <param name="showLogo" value="<?php echo $showLogo ?>"/>
        <param name="clickToImage" value="<?php echo $clickToImage ?>"/>
        <param name="splashurl" value="<?php echo $splashurl ?>"/>
        <param name="showThumbs" value="<?php echo $showThumbs ?>"/>

        <?php
        if (strlen($albumID) > 0) {
            ?>
            <param name="albumID" value="<?php echo $albumID ?>"/>
            <param name="albumKey" value="<?php echo $albumKey ?>"/>
            <?php
        }
        ?>

        <param name="showStartButton" value="<?php echo $showStartButton ?>"/>
        <param name="showButtons" value="<?php echo $showButtons ?>"/>
        <param name="transparent" value="<?php echo $transparent ?>"/>
        <param name="bgColor" value="<?php echo $bgColor ?>"/>
        <param name="crossFadeSpeed" value="<?php echo $crossFadeSpeed ?>"/>

        <?php
        if (strlen($feedURL) > 0) {
            ?>
            <param name="feedURL" value="<?php echo $feedURL ?>"/>
            <?php
        }
        ?>
        <param name="randomStart" value="<?php echo $randomStart ?>"/>
        <param name="randomize" value="<?php echo $randomize ?>"/>
        <param name="borderThickness" value="<?php echo $borderThickness ?>"/>
        <param name="borderColor" value="<?php echo $borderColor ?>"/>
        <param name="forceSize" value="<?php echo $forceSize ?>"/>
        <param name="borderCornerStyle" value="<?php echo $borderCornerStyle ?>"/>
        <param name="imgAlign" value="<?php echo $imgAlign ?>"/>

        <param name="allowNetworking" value="all"/>
        <param name="allowScriptAccess" value="always"/>

    </object>
    <div style="text-align: center;">
        <a href="http://www.waltercedric.com"
           style="font: normal normal normal 10px/normal arial; color: rgb(187, 187, 187); border-bottom: 0 none white; text-decoration: none; "
           onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'" target="_blank"><strong>smugmugbadge</strong></a>
    </div>
</div>
