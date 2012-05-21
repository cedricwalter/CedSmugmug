<?php
/**
 * @package Component cedThumbnails for Joomla! 2.5
 * @author waltercedric.com
 * @copyright (C) 2012 http://www.waltercedric.com
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html v3.0
 **/
defined('_JEXEC') or die('Restricted access');

// Load the javascript
JHtml::_('behavior.framework');
JHtml::_('behavior.modal', 'a.modal');
?>

<div class="smugmugpanel">
    <!--
    <div style="float: left;">
        <div class="icon">
            <a class="modal"
               rel="{handler: 'iframe', size: {x: 875, y: 550}, onClose: function() {}}"
               href="index.php?option=com_config&view=component&component=com_cedsmugmug&path=&tmpl=component"
               title="<?php echo JText::_('CONFIGURATION FOR CedTags');?>"> <img
                src="<? echo JURI::root() ?>/media/com_cedsmugmug/images/config.png"
                alt="<?php echo JText::_('CONFIGURATION');?>"/>
                <span><?php echo JText::_('CONFIGURATION');?></span></a></div>
    </div>
    -->
    <div style="float: left;">
        <div class="icon"><a href="http://www.waltercedric.com" target="_blank"
                             title="<?php echo JText::_('HOME PAGE');?>"> <img
            src="<? echo JURI::root() ?>/media/com_cedsmugmug/images/frontpage.png"/>
            <span><?php echo JText::_('HOME PAGE');?></span></a>
        </div>
    </div>
    <div style="float: left;">
        <div class="icon"><a
            href="http://wiki.waltercedric.com/index.php?title=CedThumbnails_for_Joomla"
            target="_blank"
            title="<?php echo JText::_('MANUAL');?>"> <img
            src="<? echo JURI::root() ?>/media/com_cedsmugmug/images/manual.png"/>
            <span><?php echo JText::_('MANUAL');?></span></a>
        </div>
    </div>
    <div style="float: left;">
        <div class="icon"><a
            href="http://forums.waltercedric.com"
            target="_blank"
            title="<?php echo JText::_('FORUM');?>"> <img
            src="<? echo JURI::root() ?>/media/com_cedsmugmug/images/forum.png"/>
            <span><?php echo JText::_('FORUM');?></span></a>
        </div>
    </div>
    <div style="float: left;">
        <div class="icon"><a
            href="http://www.gnu.org/copyleft/gpl.html"
            target="_blank"
            title="<?php echo JText::_('LICENSE');?>"> <img
            src="<? echo JURI::root() ?>/media/com_cedsmugmug/images/license.png"/>
            <span><?php echo JText::_('LICENSE');?></span></a>
        </div>
    </div>
    <div style="float: left;">
        <div class="icon">
            <a href="skype:cedric.walter?call"
               title="<?php echo JText::_('SKYPE ME');?>"> <img
                src="<? echo JURI::root() ?>/media/com_cedsmugmug/images/skype.png"/>
                <span><?php echo JText::_('SKYPE ME');?></span></a>
        </div>
    </div>
    <div style="float: left;">
        <div class="icon">
            <a href="http://extensions.joomla.org/extensions/social-web/social-media/video-channels/20873"
               target="_blank"
               title="<?php echo JText::_('JED VOTE');?>"> <img
                src="<? echo JURI::root() ?>/media/com_cedsmugmug/images/jed.png"/>
                <span><?php echo JText::_('JED VOTE');?></span></a>
        </div>
    </div>
    <div style="float: left;">
        <div class="icon">
            <a href="http://extensions.joomla.org/extensions/owner/cedric_walter"
               target="_blank"
               title="<?php echo JText::_('Other Extensions By the Same Author');?>"> <img
                src="<? echo JURI::root() ?>/media/com_cedsmugmug/images/jed.png"/>
                <span><?php echo JText::_('OTHER EXTENSIONS');?></span></a>
        </div>
    </div>
    <div style="float: left;">
        <div class="icon">
            <a href="http://www.waltercedric.com/downloads/smugmug.html"
               target="_blank"
               title="<?php echo JText::_('Download Latest Version');?>"> <img
                src="<? echo JURI::root() ?>/media/com_cedsmugmug/images/download.png"/>
                <span><?php echo JText::_('Download Latest Version');?></span></a>
        </div>
    </div>

</div>

<div class="tagversion">

    <p><a href="http://extensions.joomla.org/extensions/social-web/social-media/video-channels/20873" target="_blank">Joomla
        cedSmugmug</a>
    </p>

    <p>
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
    <input type="hidden" name="cmd" value="_s-xclick">
    <input type="hidden" name="hosted_button_id" value="QH6UGCKWW9KVL">
    <input type="image" src="<? echo JURI::root() ?>/media/com_cedsmugmug/images/paypal-donate.jpg" title="Thanks you for donations to waltercedric.com Joomla extensions development" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" style="width:174px;height:153px;">
    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
    </form>
    </p>

    <p>
        &copy; 2012 <a href="http://www.waltercedric.com">www.waltercedric.com</a> GNU-GPL v3.0
    </p>
</div>