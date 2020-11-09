<?php

namespace Shocklogic\Moderator\Shortcodes;

class QuestionsWidget
{
    public function questions_shortcode($atts = [], $content = null, $tag = '')
    {
        $output = null;

        $atts = $this->keysToLowercase($atts);

        $suportedAttributes = [
            'message' => 'How did you enjoy this session'
        ];

        // override default attributes with user attributes
        $plugin_atts = shortcode_atts($suportedAttributes, $atts, $tag);

        $message = $plugin_atts['message'];

        if (! is_null($content)) {
            // secure output by executing the_content filter hook on $content
            $content = apply_filters('the_content', $content);
    
            // run shortcode parser recursively to apply all shortcodes present in the content
            $content = do_shortcode($content);

            $output .= $content; 
        }

        $output = <<<EOT
            <div class="col-12 col-md-3 col-sm-4 mx-auto d-flex align-items-center bg-light" style="border: 1px solid black;">
                <div class="row bg-white align-self-center justify-content-center">
                    <span>
                        <p class="text-center">$message</p>
                    </span>
                    <div class="justify-content-center">
                        <i class="fas fa-star text-warning" style="font-size: xx-large ;"></i>
                        <i class="fas fa-star text-warning" style="font-size: xx-large ;"></i>
                        <i class="fas fa-star text-warning" style="font-size: xx-large ;"></i>
                        <i class="fas fa-star text-warning" style="font-size: xx-large ;"></i>
                        <i class="fas fa-star text-warning" style="font-size: xx-large ;"></i>
                    </div>
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
        add_shortcode('moderator_questions', [$this, 'questions_shortcode']);
    }
}