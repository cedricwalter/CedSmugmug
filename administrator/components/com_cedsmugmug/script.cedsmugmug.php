<?php
/**
 * @version        $Id: script.k2.php 1778 2012-11-22 17:00:40Z lefteris.kavadas $
 * @package        K2
 * @author        JoomlaWorks http://www.joomlaworks.net
 * @copyright    Copyright (c) 2006 - 2012 JoomlaWorks Ltd. All rights reserved.
 * @license        GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;

jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');

class com_CedsmugmugInstallerScript
{

    public function postflight($type, $parent)
    {
        $db = JFactory::getDBO();
        $status = new stdClass;
        $status->modules = array();
        $status->plugins = array();
        $src = $parent->getParent()->getPath('source');
        $manifest = $parent->getParent()->manifest;
        $plugins = $manifest->xpath('plugins/plugin');
        foreach ($plugins as $plugin) {
            $name = (string)$plugin->attributes()->plugin;
            $group = (string)$plugin->attributes()->group;
            $path = $src . '/plugins/' . $group;
            if (JFolder::exists($src . '/plugins/' . $group . '/' . $name)) {
                $path = $src . '/plugins/' . $group . '/' . $name;
            }
            $installer = new JInstaller;
            $result = $installer->install($path);
            /* to support joomla 1.5 and joomla 2.5
            if ($result && $group != 'finder' && $group != 'josetta_ext')
            {
                if (JFile::exists(JPATH_SITE.'/plugins/'.$group.'/'.$name.'/'.$name.'.xml'))
                {
                    JFile::delete(JPATH_SITE.'/plugins/'.$group.'/'.$name.'/'.$name.'.xml');
                }
                JFile::move(JPATH_SITE.'/plugins/'.$group.'/'.$name.'/'.$name.'.j25.xml', JPATH_SITE.'/plugins/'.$group.'/'.$name.'/'.$name.'.xml');
            }
            */
            $query = "UPDATE #__extensions SET enabled=1 WHERE type='plugin' AND element=" . $db->Quote($name) . " AND folder=" . $db->Quote($group);
            $db->setQuery($query);
            $db->execute();
            $status->plugins[] = array('name' => $name, 'group' => $group, 'result' => $result);
        }
        $modules = $manifest->xpath('modules/module');
        foreach ($modules as $module) {
            $name = (string)$module->attributes()->module;
            $client = (string)$module->attributes()->client;
            if (is_null($client)) {
                $client = 'site';
            }
            ($client == 'administrator') ? $path = $src . '/administrator/modules/' . $name : $path = $src . '/modules/' . $name;

            if ($client == 'administrator') {
                $db->setQuery("SELECT id FROM #__modules WHERE `module` = " . $db->quote($name));
                $isUpdate = (int)$db->loadResult();
            }

            $installer = new JInstaller;
            $result = $installer->install($path);
            /* to support joomla 1.5
            if ($result)
            {
                $root = $client == 'administrator' ? JPATH_ADMINISTRATOR : JPATH_SITE;
                if (JFile::exists($root.'/modules/'.$name.'/'.$name.'.xml'))
                {
                    JFile::delete($root.'/modules/'.$name.'/'.$name.'.xml');
                }
                JFile::move($root.'/modules/'.$name.'/'.$name.'.j25.xml', $root.'/modules/'.$name.'/'.$name.'.xml');
            }*/
            $status->modules[] = array('name' => $name, 'client' => $client, 'result' => $result);
            if ($client == 'administrator' && !$isUpdate) {
                $position = version_compare(JVERSION, '3.0', '<') && $name == 'mod_k2_quickicons' ? 'icon' : 'cpanel';
                $db->setQuery("UPDATE #__modules SET `position`=" . $db->quote($position) . ",`published`='1' WHERE `module`=" . $db->quote($name));
                $db->execute();

                $db->setQuery("SELECT id FROM #__modules WHERE `module` = " . $db->quote($name));
                $id = (int)$db->loadResult();

                $db->setQuery("INSERT IGNORE INTO #__modules_menu (`moduleid`,`menuid`) VALUES (" . $id . ", 0)");
                $db->execute();
            }
        }

        //if (JFile::exists(JPATH_ADMINISTRATOR.'/components/com_k2/admin.k2.php'))
        //{
        //JFile::delete(JPATH_ADMINISTRATOR.'/components/com_k2/admin.k2.php');
        //}

        $this->installationResults($status);
    }

    public function uninstall($parent)
    {
        $db = JFactory::getDBO();
        $status = new stdClass;
        $status->modules = array();
        $status->plugins = array();
        $manifest = $parent->getParent()->manifest;
        $plugins = $manifest->xpath('plugins/plugin');
        foreach ($plugins as $plugin) {
            $name = (string)$plugin->attributes()->plugin;
            $group = (string)$plugin->attributes()->group;
            $query = "SELECT `extension_id` FROM #__extensions WHERE `type`='plugin' AND element = " . $db->Quote($name) . " AND folder = " . $db->Quote($group);
            $db->setQuery($query);
            $extensions = $db->loadColumn();
            if (count($extensions)) {
                foreach ($extensions as $id) {
                    $installer = new JInstaller;
                    $result = $installer->uninstall('plugin', $id);
                }
                $status->plugins[] = array('name' => $name, 'group' => $group, 'result' => $result);
            }

        }
        $modules = $manifest->xpath('modules/module');
        foreach ($modules as $module) {
            $name = (string)$module->attributes()->module;
            $client = (string)$module->attributes()->client;
            $db = JFactory::getDBO();
            $query = "SELECT `extension_id` FROM `#__extensions` WHERE `type`='module' AND element = " . $db->Quote($name) . "";
            $db->setQuery($query);
            $extensions = $db->loadColumn();
            if (count($extensions)) {
                foreach ($extensions as $id) {
                    $installer = new JInstaller;
                    $result = $installer->uninstall('module', $id);
                }
                $status->modules[] = array('name' => $name, 'client' => $client, 'result' => $result);
            }

        }
        $this->uninstallationResults($status);
    }

    public function update($type)
    {
    }

    private function installationResults($status)
    {
        $language = JFactory::getLanguage();
        $language->load('com_cedsmugmug');
        $rows = 0; ?>
    <img src="<?php echo JURI::root(true); ?>/media/com_cedsmugmug/images/config.png" alt="logo com_cedsmugmug" align="right"/>
    <h2><?php echo JText::_('CEDSMUGMUG_INSTALLATION_STATUS'); ?></h2>
    <table class="adminlist table table-striped">
        <thead>
        <tr>
            <th class="title" colspan="2"><?php echo JText::_('CEDSMUGMUG_EXTENSION'); ?></th>
            <th width="30%"><?php echo JText::_('CEDSMUGMUG_STATUS'); ?></th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <td colspan="3"></td>
        </tr>
        </tfoot>
        <tbody>
        <tr class="row0">
            <td class="key" colspan="2"><?php echo JText::_('CEDSMUGMUG_COMPONENT'); ?></td>
            <td><strong><?php echo JText::_('CEDSMUGMUG_INSTALLED'); ?></strong></td>
        </tr>
            <?php if (count($status->modules)): ?>
        <tr>
            <th><?php echo JText::_('CEDSMUGMUG_MODULE'); ?></th>
            <th><?php echo JText::_('CEDSMUGMUG_CLIENT'); ?></th>
            <th></th>
        </tr>
            <?php foreach ($status->modules as $module): ?>
            <tr class="row<?php echo(++$rows % 2); ?>">
                <td class="key"><?php echo $module['name']; ?></td>
                <td class="key"><?php echo ucfirst($module['client']); ?></td>
                <td><strong><?php echo ($module['result']) ? JText::_('CEDSMUGMUG_INSTALLED') : JText::_('CEDSMUGMUG_NOT_INSTALLED'); ?></strong></td>
            </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if (count($status->plugins)): ?>
        <tr>
            <th><?php echo JText::_('CEDSMUGMUG_PLUGIN'); ?></th>
            <th><?php echo JText::_('CEDSMUGMUG_GROUP'); ?></th>
            <th></th>
        </tr>
            <?php foreach ($status->plugins as $plugin): ?>
            <tr class="row<?php echo(++$rows % 2); ?>">
                <td class="key"><?php echo ucfirst($plugin['name']); ?></td>
                <td class="key"><?php echo ucfirst($plugin['group']); ?></td>
                <td><strong><?php echo ($plugin['result']) ? JText::_('CEDSMUGMUG_INSTALLED') : JText::_('CEDSMUGMUG_NOT_INSTALLED'); ?></strong></td>
            </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <?php
    }

    private function uninstallationResults($status)
    {
        $language = JFactory::getLanguage();
        $language->load('com_cedsmugmug');
        $rows = 0;
        ?>
    <h2><?php echo JText::_('CEDSMUGMUG_REMOVAL_STATUS'); ?></h2>
    <table class="adminlist table table-striped">
        <thead>
        <tr>
            <th class="title" colspan="2"><?php echo JText::_('CEDSMUGMUG_EXTENSION'); ?></th>
            <th width="30%"><?php echo JText::_('CEDSMUGMUG_STATUS'); ?></th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <td colspan="3"></td>
        </tr>
        </tfoot>
        <tbody>
        <tr class="row0">
            <td class="key" colspan="2"><?php echo 'CedSmugmug ' . JText::_('CEDSMUGMUG_COMPONENT'); ?></td>
            <td><strong><?php echo JText::_('CEDSMUGMUG_REMOVED'); ?></strong></td>
        </tr>
            <?php if (count($status->modules)): ?>
        <tr>
            <th><?php echo JText::_('CEDSMUGMUG_MODULE'); ?></th>
            <th><?php echo JText::_('CEDSMUGMUG_CLIENT'); ?></th>
            <th></th>
        </tr>
            <?php foreach ($status->modules as $module): ?>
            <tr class="row<?php echo(++$rows % 2); ?>">
                <td class="key"><?php echo $module['name']; ?></td>
                <td class="key"><?php echo ucfirst($module['client']); ?></td>
                <td><strong><?php echo ($module['result']) ? JText::_('CEDSMUGMUG_REMOVED') : JText::_('CEDSMUGMUG_NOT_REMOVED'); ?></strong></td>
            </tr>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if (count($status->plugins)): ?>
        <tr>
            <th><?php echo JText::_('PLUGIN'); ?></th>
            <th><?php echo JText::_('GROUP'); ?></th>
            <th></th>
        </tr>
            <?php foreach ($status->plugins as $plugin): ?>
            <tr class="row<?php echo(++$rows % 2); ?>">
                <td class="key"><?php echo ucfirst($plugin['name']); ?></td>
                <td class="key"><?php echo ucfirst($plugin['group']); ?></td>
                <td><strong><?php echo ($plugin['result']) ? JText::_('CEDSMUGMUG_REMOVED') : JText::_('CEDSMUGMUG_NOT_REMOVED'); ?></strong></td>
            </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <?php
    }
}

