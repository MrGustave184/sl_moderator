<?php

namespace Shocklogic\Moderator\Classes;

class Tables
{
    public static function getAll() : array 
    {
        global $wpdb;
        $prefix = $wpdb->prefix;

        $tables = [
            'questions' => $prefix . 'slmoderator_questions',
            'favorites' => $prefix . 'slmoderator_favorites'
        ];

        return $tables;
    }

    public static function get(string $table) : string 
    {
        return self::getAll()[$table];
    }
}
