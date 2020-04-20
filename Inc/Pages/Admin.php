<?php
/**
* @package personalPLugin
*/

namespace Inc\Pages;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;
use \Inc\Api\Callbacks\ManagerCallbacks;

class Admin extends BaseController
{
	public $settings_api;
	
	public $callbacks;

	public $callbacks_mgnr;

    public $pages = array();

	public $subpages = array();
	
	public $args = array();


    public function register()
    {
        $this->settings_api = new SettingsApi;//in order to look for any methods in SettingsApi, we need to instantiate.

		$this->callbacks = new AdminCallbacks;

		$this->callbacks_mgnr = new ManagerCallbacks;

        $this->setPages();

		$this->setSubpages();

		$this->setSettings();
		$this->setSections();
		$this->setFields();
        
        $this->settings_api->addPages( $this->pages )->withSubPage( 'Dashboard' )->addSubPages( $this->subpages )->register();//addPages method inside SettingsApi class, this one need an array to be passed on the parameter, one the first method is done and because this method is returning($this, which is the entire class) we can keep calling the register(chaining methods).

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
				'callback' => array( $this->callbacks, 'cpt')
            ],
            [
                'parent_slug' => 'plural_plugin', 
				'page_title' => 'Custom Taxonomies', 
				'menu_title' => 'Taxonomies', 
				'capability' => 'manage_options', 
				'menu_slug' => 'plural_taxonomies', 
				'callback' => array( $this->callbacks, 'taxonomies')
            ],
            [
                'parent_slug' => 'plural_plugin', 
				'page_title' => 'Custom Widgets', 
				'menu_title' => 'Widgets', 
				'capability' => 'manage_options', 
				'menu_slug' => 'plural_widgets', 
				'callback' => array( $this->callbacks, 'widgets')
            ]
        ];
	}
	
	/*
	Settings -> database
	We used to store each field with a specific id on database, what we're doing now is store everything on 'plural_plugin'
	That way we don't occupate to many slots/rows on database. when you have the same or similar type of data,  can be store on one
	singular settings group.
	*/
	public function setSettings()
	{
		$args = [
			[
				'option_group' => 'plural_plugin_settings',
				'option_name' => 'plural_plugin', //should be the same one as menu_slug and page on field.
				'callback' => array($this->callbacks_mgnr, 'checkboxSanitize')
			]
		];
		
		return $this->settings_api->setSettings( $args );
	}

	public function setSections()
	{
		$args = [
			[
				"id" => 'plural_plugin_index',
				"title" => 'Section Manager',
				"callback" => array($this->callbacks_mgnr, 'adminSectionManager'),
				"page" => 'plural_plugin'
			]
		];

		return $this->settings_api->setSections( $args );
	}
 
	public function setFields()
	{
		$args = array();

		foreach($this->managers as $key => $value){
			
			/*
			If you dont specifed the [] ($args) you will constantly overwrite wherever date you have inside the array, 
			Otherwise, if you put $args[] you will inject/add one custom field after an other.
			*/
			$args[] = [
					'id' => $key,
					'title' => $value,
					'callback' => array( $this->callbacks_mgnr, 'checkboxField' ),
					'page' => 'plural_plugin', //where this section lives.(the same one as page in section)
					'section' => 'plural_plugin_index', //should be the same one as the id in section.
					'args' => array(
						'option_name' => 'plural_plugin', //the same as database setting group
						'label_for' => $key,
						'class' => 'ui-toggle' 
					)
				];					
		}	

		return $this->settings_api->setFields( $args );
	}
}