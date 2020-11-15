<?php

namespace Shocklogic\Moderator\Api;
use Shocklogic\Moderator\Classes\Tables;

class QuestionsRoutes
{ 
    private $wpdb;

    public function __construct() {
        global $wpdb;
        $this->wpdb = $wpdb;
    }

    public function saveQuestion($request) 
    {
        $question = $request->get_json_params();
        return $question;
    }

    public function getAllQuestions() 
    {
        return json_encode([
            'response' => 'questions routes'
        ]);
    }

    public function register_routes() {
        register_rest_route('shocklogic/moderator', 'questions', [
            'methods' => 'POST',
            'callback' => [$this, 'saveQuestion']
        ]);

        register_rest_route('shocklogic/moderator', 'questions', [
            'methods' => 'GET',
            'callback' => [$this, 'getAllQuestions']
        ]);
    }

    public function register() 
    {
        add_action ('rest_api_init', [$this, 'register_routes']);
    }
}
