<?php

use Shocklogic\Moderator\Classes\ISource;
namespace Shocklogic\Moderator\Classes;

class Moderator implements ISource 
{
    private $wpdb;
    private $routes;
    private $tables;
    private $postTypes;
    private $gitfs;

    public function __construct() {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->postTypes = [];
        $this->routes = [];
        $this->gifts = [];
        $this->tables = [
            'game_icons' => $this->wpdb->prefix . 'game_icons',
            'categories' => $this->wpdb->prefix . 'categories',
            'users' => $this->wpdb->prefix . 'gamification_users'
        ];
    }

    // ISource
    public function install() 
    {
        // need to mplement try catch error handling
        $charset_collate = $this->wpdb->get_charset_collate();

        // Create game icons table
        $table_name = $this->tables['game_icons'];	
        $sql = "CREATE TABLE $table_name (
            id varchar(100) NOT NULL,
            category varchar (255) NOT NULL,
            url varchar (255) NOT NULL,
            userId int(11) NOT NULL,
            points int(11) NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";
    
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );

        // create categories table
        $table_name = $this->tables['categories'];	
        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            name tinytext NOT NULL,
            points mediumint(9),
            PRIMARY KEY  (id)
        ) $charset_collate;";
    
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );

        // create users table
        $table_name = $this->tables['users'];	
        $sql = "CREATE TABLE $table_name (
            userId int(11) NOT NULL,
            points int(11),
            PRIMARY KEY  (userId)
        ) $charset_collate;";
    
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }

    // ISource
    public function uninstall() 
    {
        global $wpdb;

        // Implement try catch error handling
        foreach($this->tables as $table) {
            $sql = "DROP TABLE IF EXISTS $table;";
            $wpdb->query($sql);
        }
    }

    // ISource
    public function register() 
    {
        register_activation_hook(FILE_PATH, [$this, 'install']);
        register_deactivation_hook(FILE_PATH, [$this, 'uninstall']);

        $this->registerElement('routes');
        $this->registerElement('postTypes');
        $this->registerElement('gifts');
    }

    // ISource
    public function registerElement($property)
    {
        if(! property_exists($this, $property)) {
            return false;
        }

        if(count($this->$property)) {
            foreach($this->$property as $element) {
                $element->register();
            }
        }
    }

    // ISource
    public function addElement($property, array $elements)
    {
        if(! property_exists($this, $property)) {
            return false;
        }

        foreach($elements as $element) {
            array_push($this->$property, $element);
        }
    }
}
