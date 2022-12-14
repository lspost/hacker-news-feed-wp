<?php
/**
 * Store and manage background task instances
 *
 * @package HackerNewsFeed
 */

namespace Louis_Plugins\HackerNewsFeed\BackgroundTasks;

/**
 * Background task manager class.
 */
class Background_Task_Manager {

	/**
	 * Holds the instance of the background task mananger.
	 *
	 * @var Background_Task_Manager $instance
	 */
	private static $instance = null;

	/**
	 * Background Tasks
	 *
	 * @var,array $background_tasks All available background tasks
	 */
	private static $background_tasks = array();

	/**
	 * Return an instance of the the Background_Task_Manager class.
	 *
	 * @return Background_Task_Manager
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
			self::init();
		}

		return self::$instance;
	}

	/**
	 * Init the Background_Task_Manager;
	 */
	private static function init() {
		self::$background_tasks['populate_initial_stories'] = new Populate_Initial_Stories();
	}


	/**
	 * Run a background task
	 *
	 * @param string $task_name The background task to run .
	 */
	public static function run_task( $task_name ) {
		self::$background_tasks[ $task_name ]->dispatch();
	}
}
