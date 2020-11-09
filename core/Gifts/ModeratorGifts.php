<?php

namespace Shocklogic\Moderator\Gifts;

class ModeratorGifts
{
    public function register()
    {
        add_action('wp_enqueue_scripts', [$this, 'moderator_questions_script']);
    }

    public function moderator_questions_script()
    {   
        wp_enqueue_script('moderator_questions_script', MODERATOR_BASE_URL . 'core/Gifts/js/moderator_questions_script.js', [
            'jquery'
        ]);
    }
}