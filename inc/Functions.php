<?php
/**
 * Helper functions for the plugin
 *
 * @package HackerNewsFeed
 */

namespace Louis_Plugins\HackerNewsFeed;

/**
 * Class Functions
 */
class Functions {

	/**
	 * Return the plugin slug.
	 *
	 * @return string plugin slug.
	 */
	public static function get_plugin_slug() {
		return dirname( plugin_basename( ( \Louis_Plugins\HACKER_NEWS_FEED_FILE ) ) );
	}

	/**
	 * Return the basefile for the plugin.
	 *
	 * @return string base file for the plugin.
	 */
	public static function get_plugin_file() {
		return plugin_basename( \Louis_Plugins\HACKER_NEWS_FEED_FILE );
	}

	/**
	 * Return the base directory for the plugin.
	 *
	 * @return string base directory for the plugin.
	 */
	public static function get_plugin_basedir() {
		return plugin_dir_url( \Louis_Plugins\HACKER_NEWS_FEED_FILE );
	}

	/**
	 * Return the version for the plugin.
	 *
	 * @return float version for the plugin.
	 */
	public static function get_plugin_version() {
		return \Louis_Plugins\HACKER_NEWS_FEED_VERSION;
	}
}
