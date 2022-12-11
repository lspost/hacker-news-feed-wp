<?php
/**
 * API URL parts class
 *
 * @package HackerNewsFeed
 */

namespace Louis_Plugins\HackerNewsFeed\Api;

use Louis_Plugins\HackerNewsFeed\Feeds\Feed_Types as Feed_Types;

/**
 * Class with static methods for returning API URL parts
 */
class Api_Url {

	/**
	 * API base URL.
	 *
	 * @const string BASE_API_URL The base of the Hacker News API URL.
	 */
	private const BASE_API_URL = 'https://hacker-news.firebaseio.com/v0/';

	/**
	 * Top stories endpoint name.
	 *
	 * @const string TOP_STORIES Top stories endpoint name.
	 */
	private const TOP_STORIES = 'topstories';

	/**
	 * New stories endpoint name
	 *
	 * @const string NEW_STORIES New stories endpoint name
	 */
	private const NEW_STORIES = 'newstories';

	/**
	 * Best stories endpoint name.
	 *
	 * @const string BEST_STORIES Best stories endpoint name
	 */
	private const BEST_STORIES = 'beststories';

	/** API Item endpoint name
	 *
	 * @const string ITEM API Item endpoint name.
	 */
	private const ITEM = 'item/';

	/** API Url terminator
	 *
	 * @const string URL_TERMINATOR API Url terminator.
	 */
	private const URL_TERMINATOR = '.json';

	/**
	 * Get story IDs API URL
	 *
	 * @param string $feed_type Type of feed for which to return IDs URL API.
	 *
	 * @return string API URL to retrieve stories for $feed_type.
	 */
	public static function get_story_ids_url( $feed_type ) {

		switch ( $feed_type ) {
			case Feed_Types::NEWEST:
				$type_url_part = self::NEW_STORIES;
				break;

			case Feed_Types::BEST:
					$type_url_part = self::BEST_STORIES;
				break;

			case Feed_Types::TOP:
			default:
				$type_url_part = self::TOP_STORIES;
		}

		return self::BASE_API_URL . $type_url_part . self::URL_TERMINATOR;
	}

	/** Get story details API URL
	 *
	 * @param int $id ID of the story for which to retreive the details API URL.
	 *
	 * @return string API URL to retrieve details for specified story
	 */
	public static function get_story_details_url( $id ) {

		return self::BASE_API_URL . self::ITEM . $id . self::URL_TERMINATOR;
	}
}


