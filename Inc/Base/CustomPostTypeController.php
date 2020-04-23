<?php 
/**
 * @package personalPlugin
 */
namespace Inc\Base;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;

/**
* 
*/
class CustomPostTypeController extends BaseController
{
    public $callbacks;

    public $settings_api;
    
    public $subpage = [];

    public function register(){

        if ( ! $this->activated( 'cpt_manager' ) ) return;

        $this->callbacks = new AdminCallbacks;

        $this->settings_api = new SettingsApi; //this is a new instance of settingsApi 

        $this->setSubpage();

        $this->settings_api->addSubPages( $this->subpage )->register(); //from this class, we keep ading subpages to the main page.(chaning-method)

		add_action( 'init', array( $this, 'activate' ) );

    }

    public function setSubpage(){
        $this->subpage = [
            [
                'parent_slug' => 'plural_plugin', 
				'page_title' => 'Custom Post Types', 
				'menu_title' => 'CPT Manager', 
				'capability' => 'manage_options', 
				'menu_slug' => 'plural_cpt', 
				'callback' => array( $this->callbacks, 'cpt')
            ]
        ];
    }

    public function activate(){
        register_post_type('plugin_products',
            array(
                'labels' => array(
                    'name' => 'Catalogs',
                    'singular_name' => 'Catalog'
                ),
                'public' => true,
                'has_archive' => true
            )
        );
    } 

}