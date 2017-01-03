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

// Don't allow direct access to the module.
defined('_JEXEC') or die('Restricted access');

require_once(dirname(__FILE__) . '/model.php');

$cedSmugmugSlideshowModel = new CedSmugmugSlideShowModel();
$model = $cedSmugmugSlideshowModel->getModel($params);


require JModuleHelper::getLayoutPath('mod_cedsmugmugslideshow', $params->get('layout', 'flash'));