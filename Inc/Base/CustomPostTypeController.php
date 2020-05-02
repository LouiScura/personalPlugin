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

    public $custom_post_type = array();

    public function register(){

        if ( ! $this->activated( 'cpt_manager' ) ) return; //we pass the unique identifier for each subpage.If from database its false it stop all the code below.

        $this->callbacks = new AdminCallbacks;

        $this->settings_api = new SettingsApi; //this is a new instance of settingsApi 

        $this->setSubpage();

		$this->settings_api->addSubPages( $this->subpage )->register(); //from this class, we keep ading subpages to the main page.(chaning-method)       
		
		$this->storeCustomPostTypes(); 

        if( ! empty( $this->custom_post_type) ) {
            add_action( 'init', array( $this, 'registerCustomPostType' ) );
		}

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

    

    public function storeCustomPostTypes()
	{
		$this->custom_post_type = [
			[
				'post_type' => 'luis_products',
				'name' => 'Catalogs',
				'singular_name' => 'Catalog',
				'public' => true,
				'has_archive' => true
			],
			[
				'post_type' => 'luis_shirts',
				'name' => 'Shoes',
				'singular_name' => 'Shoe',
				'public' => true,
				'has_archive' => true
			]
		];
	}

    public function registerCustomPostType()
	{
		foreach( $this->custom_post_type as $post_type ){
			register_post_type($post_type['post_type'], array(
					'labels' => array(
						'name' => $post_type['name'],
						'singular_name' => $post_type['singular_name']
					),
					'public' => $post_type['public'],
					'has_archive' => $post_type['has_archive']
				)
			);
		}
	}
	 
}