<?php
/**
 * @package     cedSmugMug
 * @subpackage  com_cedsmugmug
 *
 * @copyright   Copyright (C) 2013-2016 galaxiis.com All rights reserved.
 * @license     The author and holder of the copyright of the software is Cédric Walter. The licensor and as such issuer of the license and bearer of the
 *              worldwide exclusive usage rights including the rights to reproduce, distribute and make the software available to the public
 *              in any form is Galaxiis.com
 *              see LICENSE.txt
 * @id ${licenseId}
 */

defined('_JEXEC') or die;

$script = 'function insertSmugmugrandom() {' . "\n\t";

$script .= 'var uri = document.getElementById("uri").value;' . "\n\t";
$script .= 'var id = document.getElementById("id").value;' . "\n\t";
$script .= 'var key = document.getElementById("key").value;' . "\n\t";
$script .= 'var limit = document.getElementById("limit").value;' . "\n\t";
$script .= 'var size = document.getElementById("size").value;' . "\n\t";
$script .= 'var cols = document.getElementById("cols").value;' . "\n\t";
$script .= 'var tag = "{smugmugrandom uri="+uri+" id="+id+" key="+key+" limit="+limit+" size="+size+" cols="+cols+"}";' . "\n\t";
$script .= 'window.parent.jInsertEditorText(tag, \'' . $this->eName . '\');' . "\n\t";
$script .= 'window.parent.SqueezeBox.close();' . "\n\t";
$script .= 'return false;' . "\n";
$script .= '}' . "\n";

JFactory::getDocument()->addScriptDeclaration($script);
?>
<form>

    <table width="100%">
        <tr>
            <td class="key" align="right">
                <label for="uri">
                    <?php echo JText::_('Url'); ?>
                </label>
            </td>
            <td>
                <input type="text" id="uri" name="uri" size="50" value="http://cedricwalter.smugmug.com"/>
            </td>
        </tr>
        <tr>
            <td class="key" align="right">
                <label for="id">
                    <?php echo JText::_('id'); ?>
                </label>
            </td>
            <td>
                <input type="text" id="id" name="id" value="7421071"/>
            </td>
        </tr>
        <tr>
            <td class="key" align="right">
                <label for="key">
                    <?php echo JText::_('key'); ?>
                </label>
            </td>
            <td>
                <input type="text" id="key" name="key" value="53xgf"/>
            </td>
        </tr>
        <tr>
            <td class="key" align="right">
                <label for="Limit">
                    <?php echo JText::_('Limit'); ?>
                </label>
            </td>
            <td>
                <input type="text" id="limit" name="limit" size="3" value="10"/>
            </td>
        </tr>
        <tr>
            <td class="key" align="right">
                <label for="size">
                    <?php echo JText::_('Size'); ?>
                </label>
            </td>
            <td>
                <input type="text" id="size" name="size" size="15" value="150x150"/>
            </td>
        </tr>
        <tr>
            <td class="key" align="right">
                <label for="cols">
                    <?php echo JText::_('Number of Columns'); ?>
                </label>
            </td>
            <td>
                <input type="text" id="cols" name="cols" size="3" value="3"/>
            </td>
        </tr>


    </table>
</form>
<button onclick="insertSmugmugrandom();"><?php echo JText::_('Insert Smugmug Random'); ?></button>