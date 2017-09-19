<?php
/**
 * @package     Galaxiis updater
 *
 * @copyright   Copyright (C) 2013-2017 galaxiis.com All rights reserved.
 * @license     The author and holder of the copyright of the software is Cédric Walter. The licensor and as such issuer of the license and bearer of the
 *              worldwide exclusive usage rights including the rights to reproduce, distribute and make the software available to the public
 *              in any form is Galaxiis.com
 *              see LICENSE.txt
 */

defined('_JEXEC') or die;

class plginstallerGalaxiisInstallerScript
{
        public function postflight($route, $adapter)
        {
            $db = JFactory::getDbo();
            $query = 'UPDATE ' . $db->quoteName('#__extensions') . ' SET ' . $db->quoteName('enabled') . ' = 1 WHERE ' . $db->quoteName('type') . ' = ' . $db->quote('plugin') . ' AND ' . $db->quoteName('element') . ' = ' . $db->quote('galaxiis');
            $db->setQuery($query);
            $db->execute();
        }

}