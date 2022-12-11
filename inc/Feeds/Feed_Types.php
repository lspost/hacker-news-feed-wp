<?php
/**
 * Hacker News Feed Types
 *
 * @package HackerNewsFeed
 */

namespace Louis_Plugins\HackerNewsFeed\Feeds;

/**
 * Class with static methods for returning API URL parts
 */
class Feed_Types {

	/**
	 * New Feed Type
	 *
	 * @const string NEW String value for "new" feed type
	 */
	public const NEWEST = 'newest';

	/**
	 * Top Feed Type
	 *
	 * @const string TOP String value for "top" feed type
	 */
	public const TOP = 'top';

	/**
	 * Best Feed Type
	 *
	 * @const string BEST String value for "best" feed type
	 */
	public const BEST = 'best';
}
