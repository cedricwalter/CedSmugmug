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

// https://github.com/kthornbloom/Smoothzoom

$document = JFactory::getDocument();

//$document->addScript("http://photopile-js.com/js/jquery.ui.touch-punch.min.js");
//$document->addScript("http://photopile-js.com/js/bootstrap.min.js");
$document->addScript(JUri::base().'/media/com_cedsmugmug/js/bootstrap-select.js');
$document->addScript(JUri::base().'/media/com_cedsmugmug/js/bootstrap-switch.js');
$document->addScript(JUri::base().'/media/com_cedsmugmug/js/photopile.js');

//$document->addStyleSheet("http://photopile-js.com/bootstrap/css/bootstrap.css");
//$document->addStyleSheet("http://photopile-js.com/css/flat-ui.css");
//$document->addStyleSheet("http://photopile-js.com/css/main.css");
$document->addStyleSheet(JUri::base().'/media/com_cedsmugmug/css/photopile.css');

?>

<div class="module<?php echo $model->moduleclass_sfx ?>">
    <!-- Copyright (C) 2013-2017 galaxiis.com All rights reserved. -->

	<?php if ($model->galleryTitle)
	{ ?>
        <h2><?php echo $model->title ?></h2>
	<?php } ?>

	<?php if ($model->galleryDescription)
	{ ?>
        <h3><?php echo $model->description ?></h3>
	<?php } ?>

	<?php if ($model->galleryCategory)
	{ ?>
        <h4><?php echo $model->category ?></h4>
	<?php } ?>

    <div class="photopile-wrapper">
        <ul class="photopile">
			<?php
			$limit = 0;
			foreach ($model->items as $item)
			{
				echo '<li>
      <a href="' . $item->image->url . '">
        <img src="' . $item->thumb->url . '" alt="' . $item->description . '" width="' . $item->image->width . '" height="' . $item->image->height . '" />
      </a>
    </li>';

				$limit++;
				if ($limit >= $model->limit) {
					break;
				}

			}
			?>
        </ul>
    </div>

	<?php if ($model->galleryLinkable)
	{ ?>
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

