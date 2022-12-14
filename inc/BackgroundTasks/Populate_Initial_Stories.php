<?php
/**
 * Populate initial stories in non-blocking background task.
 *
 * @package HackerNewsFeed
 */

namespace Louis_Plugins\HackerNewsFeed\BackgroundTasks;

use WP_Async_Request;

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
		// sleep( 10 );
		error_log( 'This from a background process!!! (' . time() . ')' );
	}
}
