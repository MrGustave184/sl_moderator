<?php

namespace Shocklogic\Moderator\Shortcodes;

class QuestionsWidget
{
    public function create_shortcode($atts = [], $content = null, $tag = '')
    {
        $output = null;
        $atts = $this->keysToLowercase((array)$atts);

        $suportedAttributes = [
            'message' => 'How did you enjoy this session',
            'border' => '1px solid black'
        ];

        // override default attributes with user attributes
        $plugin_atts = shortcode_atts($suportedAttributes, $atts, $tag);

        $message = $plugin_atts['message'];
        $border = $plugin_atts['border'];

        if (! is_null($content)) {
            // secure output by executing the_content filter hook on $content
            $content = apply_filters('the_content', $content);
    
            // run shortcode parser recursively to apply all shortcodes present in the content
            $content = do_shortcode($content);

            $output .= $content; 
        }

        $output = <<<EOT
            <div>
                <div class="row d-flex justify-content-center">
                    <input type="text" placeholder="Type your question here" class="m-2 p-3 ">
                </div>
                <div class="row d-flex justify-content-center">
                    <button type="button" class="px-4 bg-white">Send</button>
                </div>
            </div>
EOT;

        return $output;
    }
    
    public function keysToLowercase(array $array) 
    {
        return array_change_key_case($array, CASE_LOWER);
    }

    public function register()
    {
        add_shortcode('moderator_questions', [$this, 'create_shortcode']);
    }
}