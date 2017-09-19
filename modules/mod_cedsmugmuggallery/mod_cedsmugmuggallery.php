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
 * @id ${licenseId}
 */

// Don't allow direct access to the module.
defined('_JEXEC') or die('Restricted access');

require_once(dirname(__FILE__) . '/helper.php');

$moduleClassSfx = htmlspecialchars($params->get('moduleclass_sfx'));
$backLink = $params->get('backlink', 1);

$helper = new ModCedSmugMugGalleryHelper();
$module->content = $helper->render($params);

require JModuleHelper::getLayoutPath('mod_cedsmugmuggallery', $params->get('layout', 'default'));