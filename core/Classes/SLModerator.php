<?php

namespace Shocklogic\Moderator\Classes;

class SLModerator
{
    private $shortcodes;

    public function __construct()
    {
        $this->shortcodes = [];
    }

    public function install() {
        // 
    }

    public function uninstall() {
        // 
    }

    public function register() 
    {
        register_activation_hook(FILE_PATH, [$this, 'install']);
        register_deactivation_hook(FILE_PATH, [$this, 'uninstall']);

        $this->registerElement('shortcodes');
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
    }
}