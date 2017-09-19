<?php
/**
 * @package     CedSmugMug
 * @subpackage  com_cedsmugmug
 *
 * @copyright   Copyright (C) 2013-2017 galaxiis.com All rights reserved.
 * @license     The author and holder of the copyright of the software is Cédric Walter. The licensor and as such issuer of the license and bearer of the
 *              worldwide exclusive usage rights including the rights to reproduce, distribute and make the software available to the public
 *              in any form is Galaxiis.com
 *              see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

//http://www.jqueryrain.com/?HFocce9N
//https://github.com/jdunmore/PHP-SmugMug-Gallery-Getter/blob/master/fetch-images.php
//http://jsfiddle.net/joycse06/z6zvg/4/
//http://www.jqueryscript.net/other/jQuery-Plugin-To-Enlarge-Images-On-Mouse-Hover-HoverImageEnlarge-js.html
//http://www.jqueryrain.com/example/jquery-zoom-effect/

?>
<div class="module<?php echo $model->moduleclass_sfx ?>">
    <!-- Copyright (C) 2013-2017 galaxiis.com All rights reserved. -->

    <style type='text/css'>
        .smugmug_image {
            padding: 0 0 0 0;
            margin: <?php echo $model->gridSpacing ?>px;
            float: left;
        }

        .smugmug_image img {
        !important;
            padding: 0 0 0 0;
            margin: 0 0 0 0;
        }
    </style>

    <?php if ($model->galleryTitle) { ?>
        <h2><?php echo $model->title ?></h2>
    <?php } ?>

    <?php if ($model->galleryDescription) { ?>
    <h3><?php echo $model->description ?></h3>
    <?php } ?>

    <?php if ($model->galleryCategory) { ?>
    <h4><?php echo $model->category ?></h4>
    <?php } ?>

    <?php
    $line = 0;
    $row = 0;
    $limit = 0;
    foreach ($model->items as $item) {

        echo '<div class="smugmug_image" id="smugmug_image1" >
            <a data-rokbox
            data-rokbox-album="'.$model->uuid.'"
            data-rokbox-caption="' . $item->title . $item->category . '" href="' . $item->image->url . '">
               <img src="' . $item->thumb->url . '" />
            </a>
        </div>';

        $limit++;
        if ($limit >= $model->limit) {
            break;
        }

        $line++;
        if ($line % $model->colMax == 0) {
            echo '<div class="clearfix"/>';
            $row++;
            if ($row == $model->rowMax) {
                break;
            }
        }

    }
    ?>
    <?php if ($model->galleryLinkable) { ?>
        <div style="text-align: center;"><a href="<?php echo $model->link ?>">Gallery</a></div>
    <?php } ?>
    <div class="clearfix"/>
    <div style="text-align: center;">
        <a href="//www.galaxiis.com/cedsmugmug-showcase"
           style="font: normal normal normal 10px/normal arial; color: rgb(187, 187, 187); border-bottom: 0 none white; text-decoration: none; "
           onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'"
           target="_blank"><strong>cedsmugmug</strong></a>
    </div>
</div>

