<?php

namespace Shocklogic\Moderator\Shortcodes;

class CalificationWidget
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
            <div class="row align-self-center justify-content-center" style="border:$border" id="sl_moderator_questions">
                <div class="col-12"><p class="text-center">$message</p></div>
                <div class="col-12 text-center">
                    <i class="fas fa-star text-warning" style="font-size: xx-large;"></i>
                    <i class="fas fa-star text-warning" style="font-size: xx-large;"></i>
                    <i class="fas fa-star text-warning" style="font-size: xx-large;"></i>
                    <i class="fas fa-star text-warning" style="font-size: xx-large;"></i>
                    <i class="fas fa-star text-warning" style="font-size: xx-large;"></i>
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
        add_shortcode('moderator_calification', [$this, 'create_shortcode']);
    }
}