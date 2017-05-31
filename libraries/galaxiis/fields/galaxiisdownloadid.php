<?php
/**
 * @package     Galaxiis
 * @subpackage  Galaxiis
 *
 * @copyright   Copyright (C) 2013-2016 galaxiis.com All rights reserved.
 * @license     The author and holder of the copyright of the software is Cédric Walter. The licensor and as such issuer of the license and bearer of the
 *              worldwide exclusive usage rights including the rights to reproduce, distribute and make the software available to the public
 *              in any form is Galaxiis.com
 *              see LICENSE.txt
 */

defined('_JEXEC') or die;

class JFormFieldgalaxiisdownloadid extends JFormField
{

	protected $type = 'galaxiisdownloadid';

	private function isInstallerEnabled()
	{
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('enabled');
		$query->from('#__extensions');
		$query->where($query->qn('type') . ' = ' . $db->quote('plugin'));
		$query->where($query->qn('folder') . ' = ' . $db->quote('installer'));
		$query->where($query->qn('element') . ' = ' . $db->quote('galaxiis'));
		$db->setQuery($query);

		$component          = $db->loadObject();
		$isComponentEnabled = $component && $component->enabled;

		return $isComponentEnabled;
	}

	private function getInstallerId()
	{
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('extension_id AS id');
		$query->from('#__extensions');
		$query->where($query->qn('type') . ' = ' . $db->quote('plugin'));
		$query->where($query->qn('folder') . ' = ' . $db->quote('installer'));
		$query->where($query->qn('element') . ' = ' . $db->quote('galaxiis'));
		$db->setQuery($query);

		$component = $db->loadObject();

		return $component->id;
	}

	private function isInstallerDownloadIdSet()
	{
		$installer = JPluginHelper::getPlugin('installer', 'galaxiis');
		$params    = new JRegistry($installer->params);

		return $params->get('download-id') != "";
	}


	protected function getInput()
	{

		$installed = JPluginHelper::getPlugin('installer', 'galaxiis');
		if (sizeof($installed) == 0) {
			$html   = array();
			$html[] = '<div class="alert alert-block">';
			$html[] = '<button type="button" class="close" data-dismiss="alert">&times;</button>';
			$html[] = '<strong>' . JText::_('Galaxiis installer plugin is not installed. Did you remove it? you need it to get free/premium automatic update. it is recommended to reinstall the latest version of the product.') . '</strong>';
			$html[] = '</div>';
			echo implode('', $html);

			return;
		}

		$installerEnabled = self::isInstallerEnabled();
		if (!$installerEnabled)
		{
			$html   = array();
			$html[] = '<div class="alert alert-block">';
			$html[] = '<button type="button" class="close" data-dismiss="alert">&times;</button>';
			$html[] = '<strong>' . JText::_('Galaxiis installer plugin is not enabled. You can not get free/premium automatic update.') . '</strong>';
			$id     = self::getInstallerId();

			$html[] = '<a target="_new" href="index.php?option=com_plugins&task=plugin.edit&extension_id=' . $id . '"> Enable Galaxiis Installer plugin</a>';
			$html[] = '</div>';
			echo implode('', $html);

			return;
		}

		$downloadIdSet = self::isInstallerDownloadIdSet();
		if (!$downloadIdSet)
		{
			$html   = array();
			$html[] = '<div class="alert alert-block">';
			$html[] = '<button type="button" class="close" data-dismiss="alert">&times;</button>';
			$html[] = '<strong>' . JText::_('Galaxiis installer installed but download id not set. You can not get free/premium automatic update.') . '</strong>';
			$id     = self::getInstallerId();

			$html[] = '<a  target="_new" href="index.php?option=com_plugins&task=plugin.edit&extension_id=' . $id . '"> Add your download-id in Galaxiis Installer plugin</a>';
			$html[] = '</div>';
			echo implode('', $html);

			return;
		}

		$html   = array();
		$html[] = '<div class="alert alert-info">';
		$html[] = '<button type="button" class="close" data-dismiss="info">&times;</button>';
		$html[] = '<strong>' . JText::_('Galaxiis installer and download id set. You will get free/premium automatic update.') . '</strong>';
		$html[] = '</div>';
		echo implode('', $html);

		return;
	}

	protected function getLabel()
	{
	}

}
