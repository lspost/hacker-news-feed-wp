<?php
/**
 * Manage data retrieval from Hacker News API
 *
 * @package HackerNewsFeed
 */

namespace Louis_Plugins\HackerNewsFeed\Api;

use Louis_Plugins\HackerNewsFeed\Feeds\Feed_Types as Feed_Types;
use Louis_Plugins\HackerNewsFeed\Api\Api_Url as Api_Url;

/**
 * API Manage Class
 */
class Api_Manager {

	/**
	 * Holds the instance of the Api_Manager class
	 *
	 * @var Api_Manager $instance
	 */
	private static $instance = null;

	/**
	 * Top story IDs
	 *
	 * @var array $story_ids Associative array with lists of story IDs per API endpoint.
	 */
	private static $story_ids;

	/**
	 * Return an instance of the of the Api_Manager class
	 *
	 * @return Api_Manager $instance
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
			self::init();
		}

		return self::$instance;
	}

	/**
	 * Init the Api_Manager
	 */
	private static function init() {
		self::$story_ids = array(
			Feed_Types::TOP    => array(),
			Feed_Types::BEST   => array(),
			Feed_Types::NEWEST => array(),
		);
	}

	/**
	 * Pulls story IDs from API and sets them in API Manager property.
	 *
	 * @param string $type Type of stories to retrieve.
	 */
	private function load_story_ids( $type ) {

		$request_url = Api_Url::get_story_ids_url( $type );
		$response    = wp_remote_get( $request_url );

		if ( isset( $response['body'] ) ) {
			$retrieved_story_ids = json_decode( $response['body'] );

			self::$story_ids[ $type ] = array_merge( $retrieved_story_ids, self::$story_ids[ $type ] );
		}
	}

	/**
	 * Get story details
	 *
	 * @param int $id ID of the story to retrieve details for.
	 *
	 * @return array The details of the story.
	 */
	private function get_story_details( $id ) {

		$request_url = Api_Url::get_story_details_url( $id );
		$response    = wp_remote_get( $request_url );

		if ( isset( $response['body'] ) ) {
			return json_decode( $response['body'] );
		}

		return array();
	}

	/**
	 * Get Stories
	 *
	 * @param string $type Type of feed to retrieve stories for.
	 *
	 * @param int    $num Number of desired stories.
	 *
	 * @param array  $existing_story_ids List of the IDs of stories that already exist in the feed requesting stories.
	 *
	 * @return array Return the requested stories.
	 */
	public function get_stories( $type, $num, $existing_story_ids = array() ) {
		if ( ! self::$instance::$story_ids[ $type ] ) {
			self::$instance->load_story_ids( $type );
		}

		// Handle no story IDs here for now, but will add exception handling to the API call directly later.
		if ( ! self::$story_ids[ $type ] ) {
			return array();
		}

		$story_ids             = self::$story_ids[ $type ];
		$requested_stories_ids = array_slice( $story_ids, 0, $num );

		$stories = array();
		foreach ( $requested_stories_ids as $story_id ) {
			array_push( $stories, self::$instance->get_story_details( $story_id ) );
		}

		return $stories;
	}
}
