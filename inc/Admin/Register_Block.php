<?php
/**
 * Initialize the Gutenberg Block
 *
 * @package HackerNewsFeed
 */

namespace Louis_Plugins\HackerNewsFeed\Admin;

use \Louis_Plugins\HackerNewsFeed\Functions as functions;

/**
 * Register the Gutenberg Block
 */
class Register_Block {

	/**
	 * Main class runner
	 */
	public static function run() {
		wp_register_script(
			'hackernewsfeed-block',
			functions::get_plugin_basedir() . 'assets/js/index.js',
			array(
				'wp-blocks',
				'wp-element',
				'wp-editor',
			),
			'1.0.0',
			true
		);

		register_block_type(
			'hackernewsfeed/newsfeed',
			array(
				'editor_script'   => 'hackernewsfeed-block',
				'render_callback' => array( '\Louis_Plugins\HackerNewsFeed\Feeds\Newsfeed_Renderer', 'render' ),
			)
		);
	}
}
