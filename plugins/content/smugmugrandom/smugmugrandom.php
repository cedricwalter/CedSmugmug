<?php
/**
 * @version		smugmugrandom.php
 *
 * @package
 * @copyright	Copyright (C) 2010 Cedric Walter. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * smugmugrandom is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );
jimport( 'joomla.html.parameter' );

define('SMUGMUGRANDOM_REGEX_URL', "uri=(.*)\s*");
define('SMUGMUGRANDOM_REGEX_ALBUMID', "id=(.*)\s*");
define('SMUGMUGRANDOM_REGEX_ALBUMKEY', "key=(.*)\s*");
define('SMUGMUGRANDOM_REGEX_LIMIT', "limit=(.*)\s*");
define('SMUGMUGRANDOM_REGEX_SIZE', "size=(.*)\s*");
define('SMUGMUGRANDOM_COLS_SIZE', "cols=(.*)\s*");
define('SMUGMUGRANDOM__REGEX_PATTERN',"~{smugmugrandom\s*".SMUGMUGRANDOM_REGEX_URL.SMUGMUGRANDOM_REGEX_ALBUMID.SMUGMUGRANDOM_REGEX_ALBUMKEY.SMUGMUGRANDOM_REGEX_LIMIT.SMUGMUGRANDOM_REGEX_SIZE.SMUGMUGRANDOM_COLS_SIZE."}~iU");

class plgContentSmugmugRandom extends JPlugin
{
	function plgContentSmugmugRandom( &$subject, $params )
	{
		parent::__construct( $subject, $params );
		$plugin = JPluginHelper::getPlugin('content', 'smugmugrandom');
		$pluginParams 	= new JRegistry( $plugin->params );
		$this->debug= intval($this->params->get('debug','1'));
		$this->demo= intval($this->params->get('demo','1'));

		$this->defaultUrl = $this->params->get('defaultUrl', 'http://cedricwalter.smugmug.com');

		$this->defaultId = $this->params->get('defaultId', '2504559');
		$this->defaultKey = $this->params->get('defaultKey', 'f3ta9');
		$this->defaultLimit = intval($this->params->get('defaultLimit', '5'));
		$this->defaultSize = $this->params->get('defaultSize', '150x150');
		$this->defaultCols = intval($this->params->get('defaultCols', 3));
		$this->defaultText = $this->params->get('defaultText', "Go to Gallery");

		$document = JFactory::getDocument();
		$document->addStyleSheet('media/plg_smugmugrandom/plgSmugMugRandom.css');
	}

	var $demo = false;
	var $debug = false;
	var	$defaultUrl = null;
	var	$defaultId = null;
	var	$defaultKey = null;
	var	$defaultLimit = null;
	var	$defaultSize = null;
	var	$defaultCols = null;
	var	$defaultText = "Go to Gallery";
	

	function onPrepareContent( &$row, &$params, $page )
	{
        //Do not run in admin area
        $app = JFactory::getApplication();
        if ($app->isAdmin()) {
            return true;
        }

		//Escape fast
		if (!$this->params->get('enabled', 1)) {
			return true;
		}


		//simple performance check to determine whether bot should process further
		if ( strpos( $row->text, '{smugmugrandom' ) === false) {
			return true;
		}
		
		if ($this->demo) {
			$row->text .= '<h1>Plugin SmugmugRandom in demo mode</h1>
			<font color="red">Note if you copy some example below, add the { in front of smugmugrandom to let the magic happens!</font><br />
			smugmugrandom uri=http://cedricwalter.smugmug.com id=7421071 key=53xgf limit=6 size=150x150 cols=3
			<br />
			{smugmugrandom uri=http://cedricwalter.smugmug.com id=7421071 key=53xgf limit=6 size=150x150 cols=3}
			<br />
			smugmugrandom uri=http://cedricwalter.smugmug.com id=7421071 key=53xgf limit=6 size=150x150 cols=2}
			<br />
			{smugmugrandom uri=http://cedricwalter.smugmug.com id=7421071 key=53xgf limit=6 size=150x150 cols=2}
			<br />
			smugmugrandom uri=http://cedricwalter.smugmug.com id=7421071 key=53xgf limit=6 size=50x50 cols=2}
			<br />
			{smugmugrandom uri=http://cedricwalter.smugmug.com id=7421071 key=53xgf limit=6 size=50x50 cols=2}
			<br />			
			';
		}
		

		preg_match_all(SMUGMUGRANDOM__REGEX_PATTERN, $row->text, $matches);

		// catch and display multiple {smumugrandom...} tags in the same page
		for ($i = 0; $i < count($matches[0]); $i++) {
				
			//read but not all value may be set
			$url = (string) $matches[1][$i];
			$id = $matches[2][$i];
			$key = $matches[3][$i];
			$limit = intval($matches[4][$i]);
			$size = $matches[5][$i];
			$cols = intval($matches[6][$i]);

			
			
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
			if (empty($limit)) {
				$limit = $this->defaultLimit;
			}
			if (empty($size) || strstr($url, 'x')) {
				$size = $this->defaultSize;
			}
			if (empty($cols)) {
				$cols = intval($this->defaultCols);
			}
			
			//costly operations get their content cached
			$cache = & JFactory :: getCache('plgContentSmugmugRandom');
			$cache->setCaching(intval($params->get('cache','1')));
			$html = $cache->call(array( 'plgContentSmugmugRandom', 'init'), $url, $id, $key, $limit, $size, $cols,$this->defaultText);
				
			$row->text = str_replace($matches[0][$i], $html, $row->text);
		}

		return true;
	}


	public static function init($url, $id, $key, $limit = 10, $size = "150x150", $cols = 3, $galleryText) {
		$html = '<!-- smugmugrandom joomla created by www.waltercedric.com -->';
		//$html .=  "<br />Found limit=".$limit." size=".$size." col=".$cols."<br />";
		$galleryLink = '<a href="'.$url.'/gallery/'.$id.'_'.$key.'" rel="shadowbox">';
		
		//$html .= '<h3>'.$galleryLink.'</h3>';
		$html .= '<div class="plgSmugMugRandom"><div class="plgSmugMugRandomLine">';
		
		for ($i = 0; $i < $limit; $i++) {
			if ($i % $cols == 0 && $i != 0) {
				$html .= '</div><div class="plgSmugMugRandomLine">';
			}
			$html .= '<div class="plgSmugMugRandomItem">';
			$html .= $galleryLink.'<img src="'.$url.'/photos/random.mg?AlbumID='.$id.'&amp;AlbumKey='.$key.'&amp;Size='.$size.'&amp;uid='.rand().'" />'.'</a>';
			$html .= '</div>';
		}
		$endWith = '</div>';
		if (substr_compare($html, $endWith , -strlen($endWith), strlen($endWith)) === 0) {
			$html .= $endWith;
		}
		$html .= '</div>';
		$html .= '<div class="plgSmugMugRandomLink"><a hef="http://www.waltercedric.com" target="new">smugmugrandom</a></div>';
		
		return $html;
	}

}
?>