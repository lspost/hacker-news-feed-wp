<?php
/**
 * Render the newsfeed
 *
 * @package HackerNewsFeed
 */

namespace Louis_Plugins\HackerNewsFeed\Feeds;

use Louis_Plugins\HackerNewsFeed\Api\Api_Manager as Api_Manager;
use Louis_Plugins\HackerNewsFeed\Feeds\Feed_Types as Feed_Types;
use Louis_Plugins\HackerNewsFeed\Data\Stories as Data_Stories;
use Louis_Plugins\HackerNewsFeed\BackgroundTasks\Background_Task_Manager as Background_Task_Manager;

/**
 * Newsfeed Renderer Class
 */
class Newsfeed_Renderer {

	/**
	 * Render the newsfeed content
	 *
	 * @param array $props The properties of the newsfeed.
	 *
	 * @return string The output to be rendered.
	 */
	public static function render( $props ) {
		ob_start();

		// TODO Remove API Manager stuff here. This is just to check how data retrieval is going while I'm setting things up.
		// $api_manager = new Api_Manager();
		// $stories     = $api_manager->get_stories( Feed_Types::BEST, 20 );
		$stories = array();

		$bg_task_manager = Background_Task_Manager::get_instance();
		$bg_task_manager::run_task( 'populate_initial_stories' );
		?>

		<div data-props="<?php echo esc_attr( wp_json_encode( $props ) ); ?>">
			<h3>This will be the News Feed</h3>

			<?php if ( isset( $props['testProp'] ) ) : ?>
			<h4>Test Prop: <?php echo esc_html( $props['testProp'] ); ?></h4>
			<?php endif ?>

			<ul>
				<?php foreach ( $stories as $story ) : ?>
				<li>
				  <a href="<?php echo esc_attr( $story->url ); ?>"><?php echo esc_html( $story->title ); ?></a>
				  <p>Date: <?php echo gmdate( 'g:iA m/d/Y', $story->time ); ?></p>
				  <p>Score: <?php echo esc_html( $story->score ); ?></p>
				</li>
				<?php endforeach ?>
			</ul>
		</div>

				<?php
				return ob_get_clean();
	}
}
