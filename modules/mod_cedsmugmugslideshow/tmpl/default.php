<?php
/**
 * @package     CedSmugMug
 * @subpackage  com_cedsmugmug
 *
 * @copyright   Copyright (C) 2013-2016 galaxiis.com All rights reserved.
 * @license     The author and holder of the copyright of the software is Cédric Walter. The licensor and as such issuer of the license and bearer of the
 *              worldwide exclusive usage rights including the rights to reproduce, distribute and make the software available to the public
 *              in any form is Galaxiis.com
 *              see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>

<div class="module<?php echo $model->moduleclass_sfx ?>">

    <iframe src="https://<?php echo $model->baseUrl ?>/frame/slideshow?key=<?php echo $model->albumKey ?>&autoStart=<?php echo $model->autoStart ?>&captions=<?php echo $model->captions ?>&navigation=<?php echo $model->navigation ?>&playButton=<?php echo $model->playButton ?>&randomize=<?php echo $model->randomize ?>&speed=3&transition=<?php echo $model->transition ?>&transitionSpeed=2"
            width="<?php echo $model->width ?>" height="<?php echo $model->height ?>" frameborder="no" scrolling="no"></iframe>

    <div class="clearfix"/>
    <div style="text-align: center;">
        <a href="www.galaxiis.com/cedsmugmug-showcase"
           style="font: normal normal normal 10px/normal arial; color: rgb(187, 187, 187); border-bottom: 0 none white; text-decoration: none; "
           onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'"
           target="_blank"><strong>CedSmugmug</strong></a>
    </div>
</div>
