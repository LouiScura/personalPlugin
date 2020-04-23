<?php 
/**
 * @package personalPlugin
 */
namespace Inc\Base;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;

class ChatController extends BaseController 
{
    public $calllbacks;

    public $settings_api;

    public $base_controller;

    public $subpage = [];

    public function register()
    {
        if ( ! $this->activated('chat_manager')) return;

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
				'page_title' => 'Chat Manager', 
				'menu_title' => 'Chat Manager', 
				'capability' => 'manage_options', 
				'menu_slug' => 'chat_manager', 
				'callback' => array( $this->callbacks, 'chatManager')
            ]
        ];
    }
}