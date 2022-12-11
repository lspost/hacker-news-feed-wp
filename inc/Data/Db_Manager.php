<?php
/**
 * Manage database functions
 *
 * @package HackerNewsFeed
 */

namespace Louis_Plugins\HackerNewsFeed\Data;

/**
 * Db Manager Class
 */
class Db_Manager {

	/**
	 * Holds the instance of the Db_Manager class
	 *
	 * @var Db_Manager $instance
	 */
	private static $instance = null;


	/**
	 * Hold reference to WordPress wpdb object.
	 *
	 * @var  wpdb $global_wpdb
	 */
	private static $global_wpdb = null;

	/**
	 * Return an instance of the Db_Manager Class
	 *
	 * @return Db_Manager class instance
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
			self::init();
		}
		return self::$instance;
	}

	/**
	 * Init Db_Manager
	 */
	public static function init() {
		global $wpdb;
		self::$global_wpdb = $wpdb;
	}

	/**
	 * Create DB tables
	 *
	 * @param string $name The table name (without prefixes).
	 *
	 * @param array  $row_definitions An array of SQL definitions for the table's rows.
	 *
	 * @param string $primary_key The name of the column to set as primary key.
	 */
	public static function create_db_table( $name, $row_definitions, $primary_key ) {
		if ( null === self::$instance ) {
			// Initialize Db_Throw DB_manager not initialized error.
		}

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';

		$table_name = self::$global_wpdb->prefix . 'hnf_' . $name;

		$table_rows = implode( ", \n", $row_definitions );

		$charset = self::$global_wpdb->get_charset_collate();

		$create_statement = "CREATE TABLE {$table_name} ( $table_rows, PRIMARY KEY  ({$primary_key})\n ) {$charset};";

		// TODO Add error handling in case table cannot be created.
		dbDelta( $create_statement );
	}

}
