<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 * Editor Image buton
 *
 * @package Editors-xtd
 * @since 1.5
 */
class plgButtonPhotofeed extends JPlugin
{
    /**
     * Constructor
     *
     * @access      protected
     * @param       object  $subject The object to observe
     * @param       array   $config  An array that holds the plugin configuration
     * @since       1.5
     */
    public function __construct(& $subject, $config)
    {
        parent::__construct($subject, $config);
        $this->loadLanguage();
    }

    /**
     * Display the button
     *
     * @return array A two element array of (imageName, textToInsert)
     */
    public function onDisplay($name)
    {

        $link = 'index.php?option=com_cedsmugmug&amp;view=article&amp;layout=photofeed&amp;tmpl=component&amp;e_name=' . $name;

        JHtml::_('behavior.modal');

        $button = new JObject;
        $button->set('modal', true);
        $button->set('link', $link);
        $button->set('text', JText::_('Photofeed'));
        $button->set('name', 'photofeed');
        $button->set('options', "{handler: 'iframe', size: {x: 600, y: 500}}");

        return $button;
    }
}