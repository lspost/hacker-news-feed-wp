<?php
/**
 * Stories database functions
 *
 * @package HackerNewsFeed
 */

namespace Louis_Plugins\HackerNewsFeed\Data;

use Louis_Plugins\HackerNewsFeed\Data\Db_Manager as Db_Manager;

/**
 * Stories database functions class
 */
class Stories {

	/**
	 * Row Definitions
	 *
	 * @const array Row Definitions
	 */
	private const ROW_DEFININTIONS = array(
		'id bigint(20) unsigned NOT NULL AUTO_INCREMENT',
		'original_id int unsigned NOT NULL DEFAULT 0',
		'author varchar(60) NOT NULL DEFAULT ""',
		'create_date bigint(20) unsigned NOT NULL DEFAULT 0',
		'text varchar(2000) NOT NULL DEFAULT ""',
		'url varchar(2000) NOT NULL DEFAULT ""',
		'score mediumint(6) NOT NULL DEFAULT -1',
		'title varchar(400) NOT NULL DEFAULT ""',
	);

	/**
	 * Ensure database tables exist
	 */
	public static function ensure_db() {
		$db_manager = Db_Manager::get_instance();
		$db_manager::create_db_table( 'stories', self::ROW_DEFININTIONS, 'id' );
	}
}
