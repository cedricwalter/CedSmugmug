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

// Don't allow direct access to the module.
defined('_JEXEC') or die('Restricted access');

require_once(dirname(__FILE__) . '/model.php');

$smugMugBadgeModel = new CedSmugMugBadgeModel();
$isSSLConnection = JFactory::getApplication()->isSSLConnection();
$model = $smugMugBadgeModel->getModel($params, $isSSLConnection);

require JModuleHelper::getLayoutPath('mod_cedsmugmugbadge', $params->get('layout', 'rokbox'));