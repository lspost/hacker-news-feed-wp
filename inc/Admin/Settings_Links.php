<?php
/**
 * Add settings links to the plugin screen.
 *
 * @package HackerNewsFeed
 */

namespace Louis_Plugins\HackerNewsFeed\Admin;

use Louis_Plugins\HackerNewsFeed\Functions as Functions;

/**
 * Add settings links to the plugin screen
 */
class Settings_Links {
	/**
	 * Main class runner.
	 */
	public static function run() {
		add_filter(
			'plugin_action_links_' . Functions::get_plugin_file(),
			array( static::class, 'add_settings_link' )
		);
	}

	/**
	 * Add a settings link to the plugin's options
	 *
	 * Add a settings link on the WordPress plugins page.
	 *
	 * @since 1.0,0
	 * @access public
	 *
	 * @see run
	 *
	 * @param array $links Array of plugin options.
	 * @return array $links Array of plugin options
	 */
	public static function add_settings_link( $links ) {
		$new_links    = array();
		$settings_url = admin_url( 'options-general.php?page=hacker-news-feed' );
		$docs_url     = 'https://plugindocs&supportlinkhere.com/';
		$site_url     = 'https://companywebsitelinkhere.com';

		if ( current_user_can( 'manage_options' ) ) {
			$new_links['hacker-news_settings'] = sprintf( '<a href="%s">%s</a>', esc_url( $settings_url ), _x( 'Settings', 'Options link', 'hacker-news-feed' ) );
			$new_links['hacker-news_docs']     = sprintf( '<a href="%s">%s</a>', esc_url( $docs_url ), _x( 'Support', 'Plugin Documentation', 'hacker-news-feed' ) );
			$new_links['hacker-new_site']      = sprintf( '<a href="%s">%s</a>', esc_url( $site_url ), _x( 'Louis Plugins', 'Plugin site', 'hacker-news-feed' ) );
		}

		return array_merge( $new_links, $links );
	}
}
