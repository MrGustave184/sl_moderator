<?php

namespace Shocklogic\Moderator\Shortcodes;

class FullModeratorWidget
{
    public function create_shortcode($atts = [], $content = null, $tag = '')
    {
        $output = null;
        $atts = $this->keysToLowercase((array)$atts);

        $suportedAttributes = [
            // 
        ];

        // override default attributes with user attributes
        $plugin_atts = shortcode_atts($suportedAttributes, $atts, $tag);

        if (! is_null($content)) {
            // secure output by executing the_content filter hook on $content
            $content = apply_filters('the_content', $content);
    
            // run shortcode parser recursively to apply all shortcodes present in the content
            $content = do_shortcode($content);

            $output .= $content; 
        }

        $output = <<<EOT
        <div class="p-2">
            <div class="row bg-dark p-5">
                <div class="col-12 form-group">
                    <input class="form-control text-center" type="text" placeholder="Type your question here" class="m-2 p-3">
                </div>
                <div class="col-12 d-flex justify-content-center my-2">
                    <button id="moderator_send_question" type="button" class="px-4 bg-white">Send</button>
                </div>
            </div>
            <div class="row bg-secondary p-5">
                <div class="col-12"><p class="text-center">How did you enjoy the session?</p></div>
                <div class="col-12 text-center">
                    <i class="fas fa-star text-warning" style="font-size: xx-large;"></i>
                    <i class="fas fa-star text-warning" style="font-size: xx-large;"></i>
                    <i class="fas fa-star text-warning" style="font-size: xx-large;"></i>
                    <i class="fas fa-star text-warning" style="font-size: xx-large;"></i>
                    <i class="fas fa-star text-warning" style="font-size: xx-large;"></i>
                </div>
            </div>
            <div class="row bg-dark d-flex justify-content-center align-items-center p-5">
                <button class="btn btn-block btn-warning"> REQUEST A MEETING / DEMO</button>
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
        add_shortcode('moderator_full_widget', [$this, 'create_shortcode']);
    }
}