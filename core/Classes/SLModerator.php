<?php

namespace Shocklogic\Moderator\Classes;
use Shocklogic\Moderator\Classes\Tables;

class SLModerator
{
    private $wpdb;
    private $shortcodes;
    private $gifts;
    private $routes;

    public function __construct()
    {
        global $wpdb;

        $this->wpdb = $wpdb;
        $this->shortcodes = [];
        $this->gifts = [];
        $this->routes = [];
    }

    public function install() 
    {
        $charset_collate = $this->wpdb->get_charset_collate();

        // Create questions table
        $table_name = Tables::get('questions');	
        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            userId int(11) NOT NULL,
            question TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY  (id)
        ) $charset_collate;";
    
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );

        $charset_collate = $this->wpdb->get_charset_collate();

        // Create favorites table
        $table_name = Tables::get('favorites');	
        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            userId int(11) NOT NULL,
            session_id varchar(100),
            session_day DATE,
            session_day_name varchar(100),
            session_title varchar(255),
            session_start_time varchar(100),
            session_end_time varchar(100),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY  (id)
        ) $charset_collate;";
    
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );

        // Create califications table
        $table_name = Tables::get('califications');	
        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            userId int(11) NOT NULL,
            session_id varchar (255),
            number_points int (11),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY  (id)
        ) $charset_collate;";
    
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }

    public function uninstall() 
    {
        foreach(Tables::getAll() as $table) {
            $sql = "DROP TABLE IF EXISTS $table;";
            $this->wpdb->query($sql);
        }
    }

    public function register() 
    {
        register_activation_hook(MODERATOR_FILE_PATH, [$this, 'install']);
        register_deactivation_hook(MODERATOR_FILE_PATH, [$this, 'uninstall']);

        $this->registerElement('shortcodes');
        $this->registerElement('gifts');
        $this->registerElement('routes');
    }

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

    public function addElement($property, array $elements)
    {
        if(! property_exists($this, $property)) {
            return false;
        }

        foreach($elements as $element) {
            array_push($this->$property, $element);
        }

        return true;
    }
}