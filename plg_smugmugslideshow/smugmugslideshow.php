<?php
/** ****************************************************************
 * This file is part of mod_smugmugslideshow.
 *
 * mod_smugmugslideshow is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.

 * mod_smugmugslideshow is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with mod_smugmugslideshow.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package	mod_smugmugslideshow
 * @copyright	Copyright (C) 2009  Cedric Walter - www.waltercedric.com - All rights reserved.
 *******************************************************************/

// Don't allow direct access to the module.
defined('_JEXEC') or die('Restricted access');

jimport('joomla.html.parameter');
jimport('joomla.plugin.plugin');

define('SMUGMUG_SLIDESHOW_REGEX_URL', "uri=(.*)\s*");
define('SMUGMUG_SLIDESHOW_REGEX_ALBUMID', "id=(.*)\s*");
define('SMUGMUG_SLIDESHOW_REGEX_ALBUMKEY', "key=(.*)\s*");

define('SMUGMUG_SLIDESHOW_REGEX_PATTERN',"~{smugmugslideshow\s*".SMUGMUG_SLIDESHOW_REGEX_URL.SMUGMUG_SLIDESHOW_REGEX_ALBUMID.SMUGMUG_SLIDESHOW_REGEX_ALBUMKEY."}~iU");

class plgContentSmugmugSlideshow extends JPlugin
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

	public function onContentPrepare($context, &$row, &$params, $page = 0)
	{ 
		$pluginparams 	= new JParameter(JPluginHelper::getPlugin('content', 'smugmugslideshow')->params);
		
		//Escape fast
		if (!$pluginparams->get('enabled', 1)) {
			return true;
		}
		
		//simple performance check to determine whether bot should process further
		if ( strpos( $row->text, '{smugmugslideshow' ) === false) {
			return true;
		}
		
		preg_match_all(SMUGMUG_SLIDESHOW_REGEX_PATTERN, $row->text, $matches);

		// catch and display multiple {smumugrandom...} tags in the same page
		for ($i = 0; $i < count($matches[0]); $i++) {
				
			//read but not all value may be set
			$url = (string) $matches[1][$i];
			$id = $matches[2][$i];
			$key = $matches[3][$i];
			
			//if url do not contains the word smumug.com then fallback to default to block script inclusion
			if (empty($url) || ($url != null && strstr($url, 'smugmug.com') == false)) {
				$url = $this->defaultUrl;
			}
			if (empty($id)) {
				$id = $this->defaultId;
			}
			if (empty($key)) {
				$key = $this->defaultKey;
			}
						
			//costly operations get their content cached
			//$cache = & JFactory :: getCache('plgContentSmugmugSlideshow');
			//$cache->setCaching(intval($params->get('cache','1')));
			//$html = $cache->   call(array( 'plgContentSmugmugSlideshow', 'init'), $url, $id, $key, $params);

			$html = plgContentSmugmugSlideshow::init($url, $id, $key);
			
			$row->text = str_replace($matches[0][$i], $html, $row->text);
		}

		return true;
	}


	public static function init($url, $id, $key) {
		$params 	= new JParameter(JPluginHelper::getPlugin('content', 'smugmugslideshow')->params);
		$debug= intval($params->get('debug','1'));

		$width         	 = $params->get('width');
		$height        	 = $params->get('height');
		$howSpeed      	 = $params->get('howSpeed') == 1 ? 'true' : 'false';
		$autoStart     	 = $params->get('autoStart') == 1 ? 'true' : 'false';
		$captions      	 = $params->get('captions') == 1 ? 'true' : 'false';
		$showLogo      	 = $params->get('showLogo') == 1 ? 'true' : 'false';
		$clickToImage  	 = $params->get('clickToImage') == 1 ? 'true' : 'false';
		$splashurl      	 = $params->get('splashurl', 'http://www.smugmug.com/img/ria/ShizamSlides/smugmug_black.png');
		$showThumbs     	 = $params->get('showThumbs') == 1 ? 'true' : 'false';
		$albumID        	 = $params->get('albumID');
		$albumKey       	 = $params->get('albumKey');
		$showStartButton   = $params->get('showStartButton') == 1 ? 'true' : 'false';
		$showButtons       = $params->get('showButtons') == 1 ? 'true' : 'false';
		$transparent       = $params->get('transparent') == 1 ? 'true' : 'false';
		$bgColor           = $params->get('bgColor');
		$crossFadeSpeed    = $params->get('crossFadeSpeed');
		$feedURL           = urlencode($params->get('feedURL'));
		$randomStart       = $params->get('randomStart') == 1 ? 'true' : 'false';
		$randomize         = $params->get('randomize') == 1 ? 'true' : 'false';
		$borderThickness   = $params->get('borderThickness');
		$borderColor       = $params->get('borderColor');
		$forceSize         = $params->get('forceSize');
		$borderCornerStyle = $params->get('borderCornerStyle');
		$imgAlign          = $params->get('imgAlign');
		
		
		$html = "<div><!-- smugmugslideshow by Cedric Walter - http://www.waltercedric.com - copyright 2011 -->
		<object type='application/x-shockwave-flash' data='media/com_cedsmugmug/ShizamSlides-2011042105.swf' width='".$width."' height='".$height."' id='smugmugslideshow'>';
		<param name='movie' value='media/com_cedsmugmug/ShizamSlides-2011042105.swf' />";
		
		$flashvars = "howSpeed=$howSpeed&amp;autoStart=$autoStart&amp;captions=$captions&amp;showLogo=$showLogo&amp;clickToImage=$clickToImage&amp;splashurl=$splashurl&amp;showThumbs=$showThumbs";
		
		if (strlen($albumID) > 0)
		{
		  $flashvars .= "&amp;albumID=$albumID&amp;albumKey=$albumKey";
		}
		
		$flashvars .= "&amp;showStartButton=$showStartButton&amp;showButtons=$showButtons&amp;transparent=$transparent&amp;bgColor=$bgColor&amp;crossFadeSpeed=$crossFadeSpeed";
		
		if (strlen($feedURL) > 0)
		{
		  $flashvars .= "&amp;feedURL=$feedURL";
		}
		$flashvars .= "&amp;randomStart=$randomStart&amp;randomize=$randomize&amp;borderThickness=$borderThickness&amp;borderColor=$borderColor&amp;forceSize=$forceSize&amp;borderCornerStyle=$borderCornerStyle&amp;imgAlign=$imgAlign";
		
		$html .= "
			<param name='flashvars' value='$flashvars' />
			<param name='wmode' value='transparent'>
			<param name='howSpeed' value='$howSpeed' />
			<param name='autoStart' value='$autoStart' />
			<param name='captions' value='$captions' />
			<param name='showLogo' value='$showLogo' />
			<param name='clickToImage' value='$clickToImage' />
			<param name='splashurl' value='$splashurl' />
			<param name='showThumbs' value='$showThumbs' />";
		
		if (strlen($albumID) > 0) {
			$html .= "
			<param name='albumID' value='$albumID' />
			<param name='albumKey' value='$albumKey' />";
		}
		$html .= "
		<param name='showStartButton' value='$showStartButton' />
		<param name='showButtons' value='$showButtons' />
		<param name='transparent' value='$transparent' />
		<param name='bgColor' value='$bgColor' />
		<param name='crossFadeSpeed' value='$crossFadeSpeed' />";
		
		if (strlen($feedURL) > 0) {
		$html .= "
		 <param name='feedURL' value='$feedURL' />";
		}
		$html .= "
			<param name='randomStart' value='$randomStart' />
			<param name='randomize' value='$randomize' />
			<param name='borderThickness' value='$borderThickness' />
			<param name='borderColor' value='$borderColor' />
			<param name='forceSize' value='$forceSize' />
			<param name='borderCornerStyle' value='$borderCornerStyle' />
			<param name='imgAlign' value='$imgAlign' />
			<param name='allowNetworking' value='all' />
			<param name='allowScriptAccess' value='always' />
			</object>
		   </div>
		  <div class='plgSmugMugRandomLink'><a hef='http://www.waltercedric.com' target='_new'>smugmugslideshow</a></div>";
		
		return $html;
	}

}

