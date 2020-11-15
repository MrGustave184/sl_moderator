<?php

namespace Shocklogic\Moderator\Api;
use Shocklogic\Moderator\Classes\Tables;

class CalificationRoutes
{ 
    private $wpdb;

    public function __construct() {
        global $wpdb;
        $this->wpdb = $wpdb;
    }

    public function saveCalification($request) 
    {
        $calification = $request->get_json_params();
        return $this->wpdb->insert(Tables::get('califications'), $calification);
    }

    public function getUserCalifications($request) 
    {
        $userId = $request['id'];
        $table_name = Tables::get('califications');

        return $this->wpdb->get_results("SELECT * FROM $table_name WHERE userId = $userId");
    }

    public function register_routes() {
        register_rest_route('shocklogic/moderator', 'calification', [
            'methods' => 'POST',
            'callback' => [$this, 'saveCalification']
        ]);

        register_rest_route('shocklogic/moderator', '/users/(?P<id>[\d]+)', [
            'methods' => 'GET',
            'callback' => [$this, 'getUserCalifications']
        ]);
    }

    public function register() 
    {
        add_action ('rest_api_init', [$this, 'register_routes']);
    }
}
