<?php
/**
 * Manage stories displayed by plugin
 *
 * @package HackerNewsFeed
 */

namespace Louis_Plugins\HackerNewsFeed\Stories;

use Louis_Plugins\HackerNewsFeed\Api\Api_Manager as Api_Manager;
use Louis_Plugins\HackerNewsFeed\Data\Db_Manager as Db_Manager;
use Louis_Plugins\HackerNewsFeed\Feeds\Feed_Types as Feed_Types;

/**
 * Stories Manager class
 */
class Stories_Manager {


	/**
	 * Holds the instance of the Stories_Manager class
	 *
	 * @var Stories_Manager $instance
	 */
	private static $instance = null;

	/**
	 * Holds the instance of the Api_Manager class
	 *
	 * @var Api_Manager $instance
	 */
	private static $api_manager = null;

	/**
	 * Holds the instance of the Db_Manager class
	 *
	 * @var Db_Manager $instance
	 */
	private static $db_manager = null;

	/**
	 * Return an instance of the Stories Manager class
	 *
	 * @return Stories_Manager $instance
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
			self::init();
		}

		return self::$instance;
	}

	/**
	 * Init the Stories Manager
	 */
	private static function init() {
		self::$api_manager = Api_Manager::get_instance();
	}

	/**
	 * Load initial stories
	 */
	public function load_initial_stories() {
		$stories = self::$instance::$api_manager->get_stories( Feed_Types::NEWEST, 20 );
		foreach ( $stories as $story ) {
			error_log( $story->title );
		}
	}
}
