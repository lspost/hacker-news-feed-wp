<?php
/**
 * Populate initial stories in non-blocking background task.
 *
 * @package HackerNewsFeed
 */

namespace Louis_Plugins\HackerNewsFeed\BackgroundTasks;

use WP_Async_Request;
// use Louis_Plugins\HackerNewsFeed\Api\Api_Manager as Api_Manager;
// use Louis_Plugins\HackerNewsFeed\Feeds\Feed_Types as Feed_Types;
use Louis_Plugins\HackerNewsFeed\Stories\Stories_Manager as Stories_Manager;

/**
 * Class to create DB Table in Background
 */
class Populate_Initial_Stories extends WP_Async_Request {

	/**
	 * Name of add_action
	 *
	 * @var string Action name.
	 */
	protected $action = 'hnf_populate_initial_stories';

	/**
	 * Handle action
	 */
	protected function handle() {
		// $api_manager = Api_Manager::get_instance();
		// $stories     = $api_manager::get_stories( Feed_Types::NEWEST, 20 );
		// foreach ( $stories as $story ) {
		// error_log( $story->title );
		// }

		$stories_manager = Stories_Manager::get_instance();
		$stories_manager->load_initial_stories();
	}
}
