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
    <!-- Copyright (C) 2013-2016 galaxiis.com All rights reserved. -->
    <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="<?php echo $model->width ?>" height="<?php echo $model->height ?>" id="ssidx">
        <param name="movie" value="<?php echo $model->protocol ?>://www.smugmug.com/ria/ShizamSlides-2013072402.swf"/>
        <param name="flashVars"
               value="<?echo $model->flashvars ?>"/>
        <param name="wmode" value="transparent"/>
        <param name="allowNetworking" value="all"/>
        <param name="allowScriptAccess" value="always"/>
        <embed src="<?php echo $model->protocol ?>://www.smugmug.com/ria/ShizamSlides-2013072402.swf"
               flashVars="<?php echo $model->flashvars ?>"
               width="<?php echo $model->width ?>" height="<?php echo $model->height ?>"
               wmode="transparent" type="application/x-shockwave-flash" allowScriptAccess="always"
               allowNetworking="all"></embed>
    </object>
    <div class="clearfix"/>
    <div style="text-align: center;">
        <a href="www.galaxiis.com/cedsmugmug-showcase"
           style="font: normal normal normal 10px/normal arial; color: rgb(187, 187, 187); border-bottom: 0 none white; text-decoration: none; "
           onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'"
           target="_blank"><strong>CedSmugmug</strong></a>
    </div>
</div>
