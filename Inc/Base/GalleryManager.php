<?php 
/**
 * @package personalPlugin
 */
namespace Inc\Base;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;

class GalleryManager extends BaseController 
{
    public $calllbacks;

    public $settings_api;

    public $base_controller;

    public $subpage = [];

    public function register()
    {
        if ( ! $this->activated( 'gallery_manager' ) ) return;

        $this->callbacks = new AdminCallbacks;

        $this->settings_api = new SettingsApi; //This is a new instance of settingsApi

        $this->setSubpage();

        $this->settings_api->addSubPages( $this->subpage )->register();
    }

    public function setSubpage()
    {
        $this->subpage = [
            [
                'parent_slug' => 'plural_plugin', 
				'page_title' => 'Gallery Manager', 
				'menu_title' => 'Gallery Manager', 
				'capability' => 'manage_options', 
				'menu_slug' => 'gallery_manager', 
				'callback' => array( $this->callbacks, 'galleryManager')
            ]
        ];
    }
}