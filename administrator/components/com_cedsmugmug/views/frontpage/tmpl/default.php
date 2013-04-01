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
            href="http://wiki.waltercedric.com/index.php?title=Main_Page#CedSmugmug_add_Smugmug_Gallery_to_Joomla"
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
    <div style="float: left;">
        <div class="icon">
            <a href="https://www.facebook.com/pages/C%C3%A9dric-Walter-dot-com/113977625305022"
               target="_blank"
               title="<?php echo JText::_('Like on Facebook');?>"> <img
                src="<? echo JURI::root() ?>/media/com_cedsmugmug/images/facebook.png"/>
                <span><?php echo JText::_('Like on Facebook');?></span></a>
        </div>
    </div>
    <div style="float: left;">
        <div class="icon">
            <a href="http://twitter.com/cedricwalter"
               target="_blank"
               title="<?php echo JText::_('Follow Me on Twitter');?>"> <img
                src="<? echo JURI::root() ?>/media/com_cedsmugmug/images/twitter.png"/>
                <span><?php echo JText::_('Follow Me on Twitter');?></span></a>
        </div>
    </div>
    <div style="float: left;">
        <div class="icon">
            <a href="https://plus.google.com/u/0/104558366166000378462"
               target="_blank"
               title="<?php echo JText::_('Follow Me on Google+');?>"> <img
                src="<? echo JURI::root() ?>/media/com_cedsmugmug/images/google.png"/>
                <span><?php echo JText::_('Follow Me on Google+');?></span></a>
        </div>
    </div>
</div>

<div class="tagversion">

    <p><a href="http://extensions.joomla.org/extensions/social-web/social-media/video-channels/20873" target="_blank">Joomla
        cedSmugmug</a>
    </p>

    <table border="0" align="center" cellpadding="4" cellspacing="0">
        <tbody>
        <tr>
            <td class="right">&nbsp;</td>
            <td width="200" nowrap="" class="topunderright" align="center">
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" onsubmit="return validate_form(this)">
                    <script>
                        function validate_form(check) {
                            check.amount.value = check.amount.value.replace(/^\$/g, '');
                            if (check.amount.value < 5) {
                                alert("Please enter a $5 minimum amount to cover administration costs");
                                return false;
                            } else {
                                return true;
                            }
                        }
                    </script>
                    <div align="center">
                        <input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-butcc-donate.gif"
                               height="44px"
                               width="73px"
                               border="0" name="submit2"
                               alt="Make payments with PayPal - it's fast, free and secure!">
                        <img alt="" border="0" src="https://www.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1"></div>
                    <input type="hidden" name="cmd" value="_xclick">
                    <input type="hidden" name="business" value="cedric_walter@hotmail.com">
                    <input type="hidden" name="item_name" value="Thanks you for donations to waltercedric.com Joomla extensions development">
                    <input type="hidden" name="no_shipping" value="1">
                    <input type="hidden" name="no_note" value="1">
                    <input type="hidden" name="currency_code" value="USD">
                    <input type="hidden" name="tax" value="0">
                    <input type="hidden" name="lc" value="GB">
                    <input type="hidden" name="bn" value="PP-DonationsBF">
                    Amount in $USD:<br><input type="input" name="amount" size="3" value="$5">
                </form>
            </td>
            <td width="200" nowrap="" class="topunderright">
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                    <div align="center">
                        <input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-butcc-subscribe.gif"
                               height="44px"
                               width="73px"
                               border="0" name="submit"
                               alt="Make payments with PayPal - it's fast, free and secure!">
                        <img alt="" border="0" src="https://www.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1"> <br>
                        <select name="a3">
                            <option value="3.00" selected="">$3.00/month</option>
                            <option value="5.00">$5.00/month</option>
                            <option value="10.00">$10.00/month</option>
                            <option value="15.00">$15.00/month</option>
                            <option value="20.00">$20.00/month</option>
                            <option value="25.00">$25.00/month</option>
                        </select>
                        <br>
                        (You are free to cancel at any time)
                        <input type="hidden" name="cmd" value="_xclick-subscriptions">
                        <input type="hidden" name="business" value="cedric_walter@hotmail.com">
                        <input type="hidden" name="item_name" value="Thanks you for donations to waltercedric.com Joomla extensions development">
                        <input type="hidden" name="no_shipping" value="1">
                        <input type="hidden" name="no_note" value="1">
                        <input type="hidden" name="currency_code" value="USD">
                        <input type="hidden" name="lc" value="US">
                        <input type="hidden" name="bn" value="PP-SubscriptionsBF">
                        <input type="hidden" name="p3" value="1">
                        <input type="hidden" name="t3" value="M">
                        <input type="hidden" name="src" value="1">
                        <input type="hidden" name="sra" value="1">
                    </div>
                </form>
            </td>
        </tr>
        </tbody>
    </table>

    <p>
        &copy; 2012 <a href="http://www.waltercedric.com">www.waltercedric.com</a> GNU-GPL v3.0
    </p>
</div>