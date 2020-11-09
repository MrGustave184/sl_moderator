<?php
/**
 * Plugin Name: Shocklogic Moderator
 * Description: Virtual moderator for shocklogic virtual events
 * Version: 1.0
 * Author: Shocklogic Team
 * Author URI: https://shocklogic.com/
 */

define('MODERATOR_BASE_PATH', plugin_dir_path(__FILE__));

require MODERATOR_BASE_PATH . 'vendor/autoload.php';

use Shocklogic\Moderator\Classes\SLModerator;
use Shocklogic\Moderator\Shortcodes\QuestionsWidget;

$moderator = new SLModerator();

$moderator->addElement('shortcodes', [
    new QuestionsWidget()
]);

$moderator->register();