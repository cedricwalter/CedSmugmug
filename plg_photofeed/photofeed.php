<?php
/**
 * @version        photofeed.php 01.06.01
 *
 * @package
 * @copyright    Copyright (C) 2009 Cedric Walter. All rights reserved.
 * @license        GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once(dirname(__FILE__) . DS . 'photofeed' . DS . 'PhotoFeedHTML.php');
require_once(dirname(__FILE__) . DS . 'photofeed' . DS . 'PhotoFeedLog.php');

jimport('joomla.plugin.plugin');

define('PF_REGEX_PATTERN', "#{rss(.*?)}#s");

class plgContentPhotoFEED extends JPlugin
{
    public function __construct(& $subject, $config)
    {
        parent::__construct($subject, $config);
        $this->loadLanguage();
        $this->debug = $this->params->get('debug', '1');
        $this->defaultThumbSize = $this->params->get('thumbsize', '75');
        $this->thumbBorder = $this->params->get('thumbborder', '3');
        $this->defaultThumbSquare = $this->params->get('thumbsquare', 'yes');
        $this->demo = intval($this->params->get('demo', '1'));

    }

    var $demo = false;
    var $debug = true;
    var $defaultThumbSize = null;
    var $thumbBorder = null;
    var $defaultThumbSquare = null;

    public function onContentPrepare($context, &$row, &$params, $page = 0)
    {
        //Escape fast
        if (!$this->params->get('enabled', 1)) {
            return true;
        }
        if ($this->demo) {
            $row->text .= '<h1>Plugin <a href="http://wiki.waltercedric.com/index.php?title=Photofeed_fo_Joomla">PhotoFeed</a> in demo mode</h1>
			<font color="red">Note if you copy some example below, add the { in front of rss to let the magic happens!</font><br />
			<h2>SmugMug</h2>
			rss uri=http://cedricwalter.smugmug.com/hack/feed.mg?Type=gallery&Data=4311718_bRCBj&format=rss200 limit=5} 
			<br />
			{rss uri=http://cedricwalter.smugmug.com/hack/feed.mg?Type=gallery&Data=4311718_bRCBj&format=rss200 limit=5} 
			<br /><h2>Flickr</h2>
			rss uri=http://api.flickr.com/services/feeds/photos_public.gne?id=45007589@N00&lang=en-us&format=rss_200 limit=12}
			<br />
			{rss uri=http://api.flickr.com/services/feeds/photos_public.gne?id=45007589@N00&lang=en-us&format=rss_200 limit=12}
			<br /><h2>Picasa</h2>
			rss uri=http://picasaweb.google.com/data/feed/base/user/115504007740680881345/albumid/5447801847496445393?alt=rss&kind=photo&hl=en_US limit=10}
			<br />
			{rss uri=http://picasaweb.google.com/data/feed/base/user/115504007740680881345/albumid/5447801847496445393?alt=rss&kind=photo&hl=en_US limit=9}
			<br /><h2>Gallery2 (g2)</h2>
			rss uri=http://aroundsarasota.com/rss/feed/gallery/album/223 limit=9
			<br />
			{rss uri=http://aroundsarasota.com/rss/feed/gallery/album/223 limit=9}
            <br /><h2>Youtube</h2>
            rss uri=http://gdata.youtube.com/feeds/api/users/joomla/uploads limit=9
            <br />
            {rss uri=http://gdata.youtube.com/feeds/api/users/joomla/uploads limit=9}
			';
        }

        //simple performance check to determine whether bot should process further
        if (strpos($row->text, '{rss uri') === false) {
            return true;
        }

        preg_match_all(PF_REGEX_PATTERN, $row->text, $matches);

        // Number of plugins
        $count = count($matches[0]);

        // plugin only processes if there are any instances of the plugin in the text
        if ($count) {

            $document =& JFactory::getDocument();
            $document->addStyleSheet('media/plg_content_photofeed/photofeed.css');

            for ($i = 0; $i < $count; $i++)
            {
                $theuri = '';
                $thelimit = '';
                $thesize = '';
                $thesquare = '';
                $thefrom = '';
                $theoutput = 'html';

                if (@$matches[1][$i]) {
                    $inline_params = $matches[1][$i];
                    $result = array();
                    $pairs = explode(' ', trim($inline_params));
                    foreach ($pairs as $pair) {
                        $pos = strpos($pair, "=");
                        $key = substr($pair, 0, $pos);
                        $value = substr($pair, $pos + 1);
                        $result[$key] = $value;
                    }

                    if (isset($result['uri'])) {
                        $theuri = trim($result['uri']);
                    }
                    if (isset($result['limit'])) {
                        $thelimit = trim($result['limit']);
                    }
                    if (isset($result['from'])) {
                        $thefrom = trim($result['from']);
                    }
                    if (isset($result['output'])) {
                        //http://workshop.rs/2010/04/coin-slider-image-slider-with-unique-effects/
                        $theoutput = trim($result['output']);
                    }

                    $PhotoFeedHTML = new PhotoFeedHTML($this->params);
                    $p_content = $PhotoFeedHTML->parseRSSFeed($this->params, $theuri, $thelimit, $thefrom);
                    $row->text = str_replace("{rss" . $matches[1][$i] . "}", $p_content, $row->text);
                }
            }
        }
        return true;
    }
}

?>