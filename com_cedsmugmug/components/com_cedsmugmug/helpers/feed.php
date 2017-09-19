<?php
/**
 * @package     CedSmugMug
 * @subpackage  com_cedsmugmug
 *
 * @copyright   Copyright (C) 2013-2017 galaxiis.com All rights reserved.
 * @license     The author and holder of the copyright of the software is Cédric Walter. The licensor and as such issuer of the license and bearer of the
 *              worldwide exclusive usage rights including the rights to reproduce, distribute and make the software available to the public
 *              in any form is Galaxiis.com
 *              see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class cedSmugmugFeed
{
	const GALLERIES_BADGE = 0;
	const POPULAR_FEED = 1;
	const RECENT_PHOTO_FEEDS = 2;
	const KEYWORD_PHOTO_FEEDS = 3;

	var $thumbnailssize;
	var $imagesize;

	/**
	 * cedSmugmugFeed constructor.
	 *
	 * @param $thumbnailssize
	 * @param $imagesize
	 */
	public function __construct($thumbnailssize, $imagesize)
	{
		$this->thumbnailssize = $thumbnailssize;
		$this->imagesize      = $imagesize;
	}


	function getModel($type, $keyword, $webUri)
	{
		$componentParams = JComponentHelper::getParams("com_cedsmugmug");
		$nickname        = $componentParams->get('nickname');

		$url = $this->getFeed($type, $nickname, $keyword, $webUri);

		$data =  $this->getData($url);

		if ($data != "")
		{
			$xml = new SimpleXmlElement($data, LIBXML_NOCDATA);
			if (isset($xml->channel))
			{
				$model = $this->parseRSS($xml);
			}
		}
		else
		{
			$model        = new stdClass();
			$model->items = array();

			$item              = new stdClass();
			$item->description = "No images found in that Smugmug gallery";
			$item->link        = "media/com_cedsmugmug/img/no-image.jpg";
			$item->category    = "none";
			$item->title       = "no image found";

			$item->medias  = array();
			$image         = new stdClass();
			$image->url    = "media/com_cedsmugmug/img/no-image.jpg";
			$image->width  = 275;
			$image->height = 275;

			$item->thumb = $image;
			$item->image = $image;

			$item->medias[] = $image;
			$model->items[] = $item;
		}

		$model->rss = $url;

		return $model;
	}

	private function getFeed($type, $nickname, $keyword, $webUri)
	{
		switch ($type)
		{
			case cedSmugmugFeed::GALLERIES_BADGE:

				$htmlPage = $this->getData($webUri);
				preg_match_all('/Type=gallery&Data=(.*)&format=rss200/', $htmlPage, $matches);
				$albumIdKey = $matches[1][0];
				$feed       = "https://api.smugmug.com/hack/feed.mg?Type=gallery&Data=$albumIdKey&format=rss200";
				break;
		}

		return $feed;
	}


	private function getData($url)
	{
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$data = curl_exec($ch);
		curl_close($ch);

		// for later xml parsing, remove :
		$data = str_replace('media:group', 'mediagroup', $data);
		$data = str_replace('media:content', 'mediacontent', $data);

		return $data;
	}

	private function parseRSS($xml)
	{
		$model              = new stdClass();
		$model->title       = $xml->channel->title;
		$model->copyright   = $xml->channel->copyright;
		$model->link        = $xml->channel->link;
		$model->description = $xml->channel->description;
		$model->category    = $xml->channel->category;

		$model->items = array();
		foreach ($xml->channel->item as $someItem)
		{

			$item              = new stdClass();
			$item->description = $someItem['description'];
			$item->link        = $someItem['link'];
			$item->category    = $someItem['category'];
			$item->title       = $someItem['title'];

			$item->medias = array();

			$mediaGroup = $someItem->mediagroup;
			if (isset($mediaGroup))
			{
				if (isset($mediaGroup->mediacontent))
				{
					foreach ($mediaGroup->mediacontent as $content)
					{
						$medium = $content['medium'];
						if ($medium == "image")
						{

							$image         = new stdClass();
							$image->url    = $content['url'];
							$image->width  = $content['width'];
							$image->height = $content['height'];

							if ($this->endsWith($content['url'], $this->thumbnailssize . '.jpg'))
							{
								$item->thumb = $image;
							}
							if ($this->endsWith($content['url'], $this->imagesize . '.jpg'))
							{
								$item->image = $image;
							}

							$item->medias[] = $image;
						}
					}
				}
			}
			$model->items[] = $item;
		}

		return $model;
	}

	private function endsWith($haystack, $needle)
	{
		// search forward starting from end minus needle length characters
		return $needle === "" || strpos($haystack, $needle, strlen($haystack) - strlen($needle)) !== false;
	}

	function parseAtom($xml)
	{
		echo "<strong>" . $xml->author->name . "</strong>";
		$cnt = count($xml->entry);
		for ($i = 0; $i < $cnt; $i++)
		{
			$urlAtt = $xml->entry->link[$i]->attributes();
			$url    = $urlAtt['href'];
			$title  = $xml->entry->title;
			$desc   = strip_tags($xml->entry->content);

			echo '<a href="' . $url . '">' . $title . '</a>' . $desc . '';
		}
	}

}