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

    public $subpages = array();

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

        $this->subpages = [
            [
                'parent_slug' => 'plural_plugin', 
				'page_title' => 'Custom Post Types', 
				'menu_title' => 'CPT', 
				'capability' => 'manage_options', 
				'menu_slug' => 'plural_cpt', 
				'callback' => function() { echo '<h2>CPT Manager</h2>'; }
            ],
            [
                'parent_slug' => 'plural_plugin', 
				'page_title' => 'Custom Taxonomies', 
				'menu_title' => 'Taxonomies', 
				'capability' => 'manage_options', 
				'menu_slug' => 'plural_taxonomies', 
				'callback' => function() { echo '<h2>Taxonomies Manager</h2>'; }
            ],
            [
                'parent_slug' => 'plural_plugin', 
				'page_title' => 'Custom Widgets', 
				'menu_title' => 'Widgets', 
				'capability' => 'manage_options', 
				'menu_slug' => 'plural_widgets', 
				'callback' => function() { echo '<h2>Widgets Manager</h2>'; }
            ]
        ];

    }
    
    public function register(){   
        $this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->addSubPages($this->subpages)->register();//addPages method inside SettingsApi class, this one need an array to be passed on the parameter, one the first method is done and because this method is returning($this, which is the entire class) we can keep calling the register(chaining methods).
    }
}