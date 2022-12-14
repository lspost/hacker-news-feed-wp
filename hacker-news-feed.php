<?php
/**
 * Plugin Name: Hacker News Feed
 * Description: Displays a news feed of articles from Hacker News
 * Version: 1.0.0
 * Requires at least: 5.9
 * Requires PHP: 7.2
 * Author: Louis Spost
 * Text Domain: hacker-news-feed
 * Domain Path: /languages
 *
 * @package HackerNewsFeed
 */

namespace Louis_Plugins\HackerNewsFeed;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'Louis_Plugins\HACKER_NEWS_FEED_VERSION', '1.0.0' );
define( 'Louis_Plugins\HACKER_NEWS_FEED_FILE', __FILE__ );

if ( file_exists( __DIR__ . '/lib/autoload.php' ) ) {
	require_once __DIR__ . '/lib/autoload.php';
}

use Louis_Plugins\HackerNewsFeed\Data\Stories as StoriesDb;
use Louis_Plugins\HackerNewsFeed\BackgroundTasks\Background_Task_Manager as Background_Task_Manager;

/**
 * HackerNewsFeed class.
 */
class HackerNewsFeed {


	/** Holds the class instance.
	 *
	 * @var HackerNewsFeed $instance
	 */
	private static $instance = null;

	/**
	 * Return an instance of the HackerNewsFeed Class
	 *
	 * @since 1.0.0
	 *
	 * @return HackerNewsFeed class instance
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Class initializer.
	 */
	public function plugins_loaded() {
		load_plugin_textdomain(
			'hacker-news-feed',
			false,
			basename( dirname( __FILE__ ) ) . '/languages'
		);

		// Register the admin menu.
		Admin\Register_Menu::run();
		Admin\Settings_Links::run();

		// Plugin setup code.
		add_action( 'init', array( $this, 'init' ) );
	}

	/**
	 * Inititialize things.
	 */
	public function init() {
		Admin\Register_Block::run();
		Background_Task_Manager::get_instance();
	}

}

/**
 * Plugin Activation Code
 */
register_activation_hook(
	__FILE__,
	function() {
		StoriesDb::ensure_db();
	}
);

// TODO add deactivation hook for DB and other cleanup.

add_action(
	'plugins_loaded',
	function () {
		$hackernewsfeed = HackerNewsFeed::get_instance();
		$hackernewsfeed->plugins_loaded();
	}
);
