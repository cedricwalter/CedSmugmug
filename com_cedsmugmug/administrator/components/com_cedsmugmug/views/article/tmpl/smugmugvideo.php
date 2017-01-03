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

$script = array();
$script[] = 'function insertSmugmugVideo() {';

$script[] = '   var idKey = document.getElementById("idKey").value;';
$script[] = '   var size = document.getElementById("size").value;';
$script[] = '   var width = document.getElementById("width").value;';
$script[] = '   var height = document.getElementById("height").value;';

$script[] = '   var tag = "";';
$script[] = '   if (size != "") {';
$script[] = '       tag = "{smugmugvideo "+idKey+" "+size+"}";';
$script[] = '   } else {';
$script[] = '       tag = "{smugmugvideo "+idKey+" "+width+" "+height+"}";';
$script[] = '   }';
$script[] = '   window.parent.jInsertEditorText(tag, \'' . $this->eName . '\');';
$script[] = '   window.parent.SqueezeBox.close();';
$script[] = '   return false;';
$script[] = '}' ;

JFactory::getDocument()->addScriptDeclaration(implode("\n\t", $script));
?>
<form>
    <table width="100%" align="center">
        <table>
            <tr>
                <td class="key" align="right">
                    <label for="title">
                        <?php echo JText::_('Video id_key'); ?>
                    </label>
                </td>
                <td>
                    <input type="text" id="idKey" name="idKey" value="7421071_53xgf"/>
                </td>
            </tr>

            <tr>
                <td class="key" align="right">

                </td>
                <td>
                    <h2>Set Size</h2>
                </td>
            </tr>


            <tr>
                <td class="key" align="right">
                    <label for="key">
                        <?php echo JText::_('Standard Size'); ?>
                    </label>
                </td>
                <td>
                    <select name="size" id="size">
                        <option value=""></option>
                        <option value="S">S (425×318)</option>
                        <option value="M">M (640x480)</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td class="key" align="right">

                </td>
                <td>
                    <h2>Or</h2>
                </td>
            </tr>

            <tr>
                <td class="key" align="right">
                    <label for="key">
                        <?php echo JText::_('Custom Size'); ?>
                    </label>
                </td>
                <td>
                    <input type="text" id="width" name="width" value="" placeholder="Width"/> x <input type="text" id="height" name="height" value="" placeholder="Height"/>
                </td>
            </tr>

        </table>

</form>
<button onclick="insertSmugmugVideo();"><?php echo JText::_('Insert Smugmug Video'); ?></button>