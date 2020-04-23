<?php 
/**
 * @package personalPlugin
 */
namespace Inc\Base;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;

class MediaWidget extends BaseController 
{
    public $calllbacks;

    public $settings_api;

    public $base_controller;

    public $subpage = [];

    public function register()
    {
        if ( ! $this->activated( 'media_widget' ) ) return;

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
				'page_title' => 'Media Widgets', 
				'menu_title' => 'Media Widgets', 
				'capability' => 'manage_options', 
				'menu_slug' => 'plural_widgets', 
				'callback' => array( $this->callbacks, 'widgets')
            ]
        ];
    }
}