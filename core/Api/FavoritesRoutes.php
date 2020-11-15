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
        return $this->wpdb->insert(Tables::get('favorites'), $favorite);
    }

    public function deleteFavorite($request) 
    {
        $favoriteId = $request['id'];
        $table_name = Tables::get('favorites');

        return $this->wpdb->get_results("DELETE FROM $table_name WHERE id = $favoriteId");
    }

    public function getUserFavorites($request) 
    {
        $userId = $request['id'];
        $table_name = Tables::get('favorites');

        return $this->wpdb->get_results("SELECT * FROM $table_name WHERE userId = $userId");
    }

    public function register_routes() {
        register_rest_route('shocklogic/moderator', 'favorite', [
            'methods' => 'POST',
            'callback' => [$this, 'saveFavorite']
        ]);

        register_rest_route('shocklogic/moderator', 'favorite/(?P<id>[\d]+)', [
            'methods' => 'DELETE',
            'callback' => [$this, 'deleteFavorite']
        ]);

        register_rest_route('shocklogic/moderator', '/users/(?P<id>[\d]+)/favorites', [
            'methods' => 'GET',
            'callback' => [$this, 'getUserFavorites']
        ]);
    }

    public function register() 
    {
        add_action ('rest_api_init', [$this, 'register_routes']);
    }
}
