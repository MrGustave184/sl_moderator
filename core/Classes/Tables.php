<?php

namespace Shocklogic\Moderator\Classes;

class Tables
{
    public static function getAll() : array 
    {
        global $wpdb;

        $tables = [
            'questions' => $wpdb->prefix . 'slmoderator_questions'
        ];

        return $tables;
    }

    public static function get(string $table) : string 
    {
        return self::getAll()[$table];
    }
}
