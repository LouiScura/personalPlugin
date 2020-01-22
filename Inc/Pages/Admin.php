<?php
/**
* @package personalPLugin
*/

namespace Inc\Pages;

use \Inc\Api\SettingsApi;

class Admin
{
    public $settings;

    public $pages = array();

    public function __construct(){

        $this->settings = new SettingsApi;//in order to look for any methods in SettingsApi, we need to instantiate.

        $this->pages = [
            [
                'page_title' => 'Plural Plugin', 
                'menu_title' => 'Plural Plugin', 
                'capability' => 'manage_options', 
                'menu_slug' => 'plural_plugin', 
                'callback' => function() { echo '<h2>Plural Plugin</h2>'; }, 
                'icon_url' => 'dashicons-star-empty', 
                'position' => 110
            ]
        ];
    }

    public function register(){   
        $this->settings->addPages( $this->pages )->register();//addPages method inside SettingsApi class, this one need an array to be passed on the parameter, one the first method is done and because this method is returning($this, which is the entire class) we can keep calling the register(chaining methods).
    }
}