<?php 
/**
 * @package personalPlugin
 */
namespace Inc\Base;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;

class CustomTaxonomyController extends BaseController 
{
    public $callbacks;

    public $settings_api;
    
    public $subpage = [];

    public function register()
    {
        if (! $this->activated( 'taxonomy_manager' ) ) return;

        $this->callbacks = New AdminCallbacks;

        $this->settings_api = New SettingsApi; //this is a new instance of settingsApi 

        $this->setSubpage();

        $this->settings_api->addSubPages( $this->subpage )->register();        

    }

    public function setSubpage()
    {
        $this->subpage = [
            [
                'parent_slug' => 'plural_plugin', 
				'page_title' => 'Taxonomy Manager', 
				'menu_title' => 'Taxonomy Manager', 
				'capability' => 'manage_options', 
				'menu_slug' => 'plural_taxonomies', 
				'callback' => array( $this->callbacks, 'taxonomies')
            ]
        ];
    }
}