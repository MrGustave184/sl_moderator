<?php

namespace Shocklogic\Moderator\Shortcodes;

class QuestionsWidget
{
    public function questions_shortcode($atts = [], $content = null, $tag = '')
    {
        $atts = keysToLowercase($atts);

        // override default attributes with user attributes
        $suportedAttributes = [
            'howgo' => 'default'
        ];

        $plugin_atts = shortcode_atts($suportedAttributes, $atts, $tag);
        
        return "Dont go " .$plugin_atts['howgo']. " into that good night";
    }
    
    public function keysToLowercase(array $array) 
    {
        return array_change_key_case($array, CASE_LOWER);
    }

    public function register()
    {
        add_shortcode('moderator_questions', [$this, 'questions_shortcode']);
    }
}