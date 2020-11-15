<?php
/**
 * Plugin Name: Shocklogic Moderator
 * Description: Virtual moderator for shocklogic virtual events
 * Version: 1.0
 * Author: Shocklogic Team
 * Author URI: https://shocklogic.com/
 */

define('MODERATOR_BASE_PATH', plugin_dir_path(__FILE__));
define('MODERATOR_BASE_URL', plugin_dir_url(__FILE__));
define('MODERATOR_FILE_PATH', __FILE__);

require MODERATOR_BASE_PATH . 'vendor/autoload.php';

use Shocklogic\Moderator\Classes\SLModerator;
use Shocklogic\Moderator\Shortcodes\FullModeratorWidget;
use Shocklogic\Moderator\Gifts\ModeratorGifts;
use Shocklogic\Moderator\Api\QuestionsRoutes;
use Shocklogic\Moderator\Api\FavoritesRoutes;

$moderator = new SLModerator();

$moderator->addElement('shortcodes', [
    new FullModeratorWidget()
]);

$moderator->addElement('gifts', [
    new ModeratorGifts()
]);

$moderator->addElement('routes', [
    new QuestionsRoutes(),
    new FavoritesRoutes
]);

$moderator->register();