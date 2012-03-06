<?php
/**
 * @version		photofeed.php
 * @package
 * @copyright	Copyright (C) 2009 Cedric Walter. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class PhotoFeedLog
{
	/**
	 * Simple log
	 * @param string $comment  The comment to log
	 * @param int $userId      An optional user ID
	 */
	function log($params, $comment)
	{
		if ($params->get('debug', 1)) 
		{
			jimport('joomla.error.log');
			$options = array(
            'format' => "{DATE}\t{TIME}\t{COMMENT}"
            );
            // Create the instance of the log file in case we use it later
            $log = &JLog::getInstance("plg.photofeed.log.php", $options);
            $log->addEntry(array('comment' => $comment));
		}
	}
}
