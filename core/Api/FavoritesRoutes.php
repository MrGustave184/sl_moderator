<?php

namespace Shocklogic\Moderator\Api;
use Shocklogic\Moderator\Classes\Tables;

class FavoritesRoutes
{ 
    private $wpdb;

    public function __construct() {
        global $wpdb;
        $this->wpdb = $wpdb;
    }

    public function saveFavorite($request) 
    {
        $favorite = $request->get_json_params();
        // return $favorite;
        return $this->wpdb->insert(Tables::get('favorites'), $favorite);
    }

    public function getAllFavorites() 
    {
        return json_encode([
            'response' => 'questions routes'
        ]);
    }

    public function register_routes() {
        register_rest_route('shocklogic/moderator', 'favorite', [
            'methods' => 'POST',
            'callback' => [$this, 'saveFavorite']
        ]);

        register_rest_route('shocklogic/moderator', 'favorite', [
            'methods' => 'GET',
            'callback' => [$this, 'getAllFavorites']
        ]);
    }

    public function register() 
    {
        add_action ('rest_api_init', [$this, 'register_routes']);
    }
}
