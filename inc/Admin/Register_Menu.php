<?php
/**
 * Initialize the admin menu.
 *
 * @package HackerNewsFeed
 */

namespace Louis_Plugins\HackerNewsFeed\Admin;

use Louis_Plugins\HackerNewsFeed\Functions as Functions;

/**
 * Create the admin menu.
 */
class Register_Menu {

	/**
	 * The menu icon
	 *
	 * @const string HNF_ICON
	 */
	private const HNF_ICON = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNiIgaGVpZ2h0PSIxNiIgZmlsbD0iY3VycmVudENvbG9yIiBjbGFzcz0iYmkgYmktcGMtZGlzcGxheS1ob3Jpem9udGFsIiB2aWV3Qm94PSIwIDAgMTYgMTYiPgogIDxwYXRoIGQ9Ik0xLjUgMEExLjUgMS41IDAgMCAwIDAgMS41djdBMS41IDEuNSAwIDAgMCAxLjUgMTBINnYxSDFhMSAxIDAgMCAwLTEgMXYzYTEgMSAwIDAgMCAxIDFoMTRhMSAxIDAgMCAwIDEtMXYtM2ExIDEgMCAwIDAtMS0xaC01di0xaDQuNUExLjUgMS41IDAgMCAwIDE2IDguNXYtN0ExLjUgMS41IDAgMCAwIDE0LjUgMGgtMTNabTAgMWgxM2EuNS41IDAgMCAxIC41LjV2N2EuNS41IDAgMCAxLS41LjVoLTEzYS41LjUgMCAwIDEtLjUtLjV2LTdhLjUuNSAwIDAgMSAuNS0uNVpNMTIgMTIuNWEuNS41IDAgMSAxIDEgMCAuNS41IDAgMCAxLTEgMFptMiAwYS41LjUgMCAxIDEgMSAwIC41LjUgMCAwIDEtMSAwWk0xLjUgMTJoNWEuNS41IDAgMCAxIDAgMWgtNWEuNS41IDAgMCAxIDAtMVpNMSAxNC4yNWEuMjUuMjUgMCAwIDEgLjI1LS4yNWg1LjVhLjI1LjI1IDAgMSAxIDAgLjVoLTUuNWEuMjUuMjUgMCAwIDEtLjI1LS4yNVoiLz4KPC9zdmc+';

	/**
	 * Main class runner.
	 */
	public static function run() {
		add_action( 'admin_menu', array( static::class, 'init_menu' ) );
	}

	/**
	 * Register the plugin menu.
	 */
	public static function init_menu() {
		add_menu_page(
			__( 'Hacker News Feed', 'hacker-news-feed' ),
			__( 'Hacker News Feed', 'hacker-news-feed' ),
			'manage_options',
			functions::get_plugin_slug(),
			array( '\Louis_Plugins\HackerNewsFeed\Admin\Settings', 'settings_page' ),
			self::HNF_ICON,
			100
		);
	}
}
