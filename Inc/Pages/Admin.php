<?php
/**
* @package personalPLugin
*/

namespace Inc\Pages;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;

class Admin extends BaseController
{
    public $settings;

    public $pages = array();

    public $subpages = array();

    public $callbacks;

    public function register()
    {
        $this->settings = new SettingsApi;//in order to look for any methods in SettingsApi, we need to instantiate.
        
        $this->callbacks = new AdminCallbacks;

        $this->setPages();

        $this->setSubpages();
        
        $this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->addSubPages($this->subpages)->register();//addPages method inside SettingsApi class, this one need an array to be passed on the parameter, one the first method is done and because this method is returning($this, which is the entire class) we can keep calling the register(chaining methods).

    }

    public function setPages()
    {
        $this->pages = [
            [
                'page_title' => 'Plural Plugin', 
                'menu_title' => 'Plural Plugin', 
                'capability' => 'manage_options', 
                'menu_slug' => 'plural_plugin', 
                'callback' => array($this->callbacks, 'adminDashboard'), 
                'icon_url' => 'dashicons-star-empty', 
                'position' => 110
            ]
        ];

    }

    public function setSubpages()
    {
        $this->subpages = [
            [
                'parent_slug' => 'plural_plugin', 
				'page_title' => 'Custom Post Types', 
				'menu_title' => 'CPT', 
				'capability' => 'manage_options', 
				'menu_slug' => 'plural_cpt', 
				'callback' => array($this->callbacks, 'cpt')
            ],
            [
                'parent_slug' => 'plural_plugin', 
				'page_title' => 'Custom Taxonomies', 
				'menu_title' => 'Taxonomies', 
				'capability' => 'manage_options', 
				'menu_slug' => 'plural_taxonomies', 
				'callback' => array($this->callbacks, 'taxonomies')
            ],
            [
                'parent_slug' => 'plural_plugin', 
				'page_title' => 'Custom Widgets', 
				'menu_title' => 'Widgets', 
				'capability' => 'manage_options', 
				'menu_slug' => 'plural_widgets', 
				'callback' => array($this->callbacks, 'widgets')
            ]
        ];

    }
}