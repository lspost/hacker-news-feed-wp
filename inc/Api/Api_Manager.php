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
	 * Top story IDs
	 *
	 * @var array $story_ids Associative array with lists of story IDs per API endpoint.
	 */
	private $story_ids;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->story_ids = array(
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

			$this->story_ids[ $type ] = array_merge( $this->story_ids[ $type ], $retrieved_story_ids );
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
		$reponse     = wp_remote_get( $request_url );

		if ( isset( $reponse['body'] ) ) {
			return json_decode( $reponse['body'] );
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
		if ( ! $this->story_ids[ $type ] ) {
			$this->load_story_ids( $type );
		}

		// Handle no story IDs here for now, but will add exception handling to the API call directly later.
		if ( ! $this->story_ids[ $type ] ) {
			return array();
		}

		$story_ids             = $this->story_ids[ $type ];
		$requested_stories_ids = array_slice( $story_ids, 0, $num );

		$stories = array();
		foreach ( $requested_stories_ids as $story_id ) {
			array_push( $stories, $this->get_story_details( $story_id ) );
		}

		return $stories;
	}
}
