<?php 
/**
 * @package personalPlugin
 */
namespace Inc\Base;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;

class MembershipController extends BaseController 
{
    public $calllbacks;

    public $settings_api;

    public $base_controller;

    public $subpage = [];

    public function register()
    {
        if ( ! $this->activated( 'membership_manager' ) ) return;

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
				'page_title' => 'Membership Controller', 
				'menu_title' => 'Membership Controller', 
				'capability' => 'manage_options', 
				'menu_slug' => 'plural_membership_controller', 
				'callback' => array( $this->callbacks, 'membershipController')
            ]
        ];
    }
}