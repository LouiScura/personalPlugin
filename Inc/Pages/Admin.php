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
	
	public function setSettings()
	{
		$args = [
			[
				"option_group" => "plural_plugin_settings", 
				"option_name" => "cpt_manager",
				"callback" => array($this->callbacks_mgnr, 'checkboxSanitize')
			],
			[
				"option_group" => "plural_plugin_settings", 
				"option_name" => "taxonomy_manager",
				"callback" => array($this->callbacks_mgnr, 'checkboxSanitize')
			],
			[
				"option_group" => "plural_plugin_settings", 
				"option_name" => "media_widget",
				"callback" => array($this->callbacks_mgnr, 'checkboxSanitize')
			],
			[
				"option_group" => "plural_plugin_settings", 
				"option_name" => "gallery_manager",
				"callback" => array($this->callbacks_mgnr, 'checkboxSanitize')
			],
			[
				"option_group" => "plural_plugin_settings", 
				"option_name" => "testimonial_manager",
				"callback" => array($this->callbacks_mgnr, 'checkboxSanitize')
			],
			[
				"option_group" => "plural_plugin_settings", 
				"option_name" => "login_manager",
				"callback" => array($this->callbacks_mgnr, 'checkboxSanitize')
			],
			[
				"option_group" => "plural_plugin_settings", 
				"option_name" => "membership_manager",
				"callback" => array($this->callbacks_mgnr, 'checkboxSanitize')
			],
			[
				"option_group" => "plural_plugin_settings", 
				"option_name" => "chat_manager",
				"callback" => array($this->callbacks_mgnr, 'checkboxSanitize')
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
		$args = [
			[
				'id' => 'cpt_manager',
				'title' => 'Active CPT Manager',
				'callback' => array( $this->callbacks_mgnr, 'checkboxField' ),
				'page' => 'plural_plugin', //where this section lives.(the same one as page in section)
				'section' => 'plural_plugin_index', //should be the same one as the id in section.
				'args' => array(
					'label_for' => 'cpt_manager',
					'class' => 'ui-toggle'
					)
			],
			[
				'id' => 'taxonomy_manager',
				'title' => 'Active Taxonomy Manager',
				'callback' => array( $this->callbacks_mgnr, 'checkboxField' ),
				'page' => 'plural_plugin', //where this section lives.(the same one as page in section)
				'section' => 'plural_plugin_index', //should be the same one as the id in section.
				'args' => array(
					'label_for' => 'taxonomy_manager',
					'class' => 'ui-toggle'
					)
			],
			[
				'id' => 'media_widget',
				'title' => 'Active Media Manager',
				'callback' => array( $this->callbacks_mgnr, 'checkboxField' ),
				'page' => 'plural_plugin', //where this section lives.(the same one as page in section)
				'section' => 'plural_plugin_index', //should be the same one as the id in section.
				'args' => array(
					'label_for' => 'media_widget',
					'class' => 'ui-toggle'
					)
			],
			[
				'id' => 'gallery_manager',
				'title' => 'Active Gallery Manager',
				'callback' => array( $this->callbacks_mgnr, 'checkboxField' ),
				'page' => 'plural_plugin', //where this section lives.(the same one as page in section)
				'section' => 'plural_plugin_index', //should be the same one as the id in section.
				'args' => array(
					'label_for' => 'gallery_manager',
					'class' => 'ui-toggle'
					)
			],
			[
				'id' => 'testimonial_manager',
				'title' => 'Active Testimonial Manager',
				'callback' => array( $this->callbacks_mgnr, 'checkboxField' ),
				'page' => 'plural_plugin', //where this section lives.(the same one as page in section)
				'section' => 'plural_plugin_index', //should be the same one as the id in section.
				'args' => array(
					'label_for' => 'testimonial_manager',
					'class' => 'ui-toggle'
					)
			],
			[
				'id' => 'login_manager',
				'title' => 'Active Login Manager',
				'callback' => array( $this->callbacks_mgnr, 'checkboxField' ),
				'page' => 'plural_plugin', //where this section lives.(the same one as page in section)
				'section' => 'plural_plugin_index', //should be the same one as the id in section.
				'args' => array(
					'label_for' => 'login_manager',
					'class' => 'ui-toggle'
					)
			],
			[
				'id' => 'membership_manager',
				'title' => 'Active Membership Manager',
				'callback' => array( $this->callbacks_mgnr, 'checkboxField' ),
				'page' => 'plural_plugin', //where this section lives.(the same one as page in section)
				'section' => 'plural_plugin_index', //should be the same one as the id in section.
				'args' => array(
					'label_for' => 'membership_manager',
					'class' => 'ui-toggle'
					)
			],
			[
				'id' => 'chat_manager',
				'title' => 'Active Chat Manager',
				'callback' => array( $this->callbacks_mgnr, 'checkboxField' ),
				'page' => 'plural_plugin', //where this section lives.(the same one as page in section)
				'section' => 'plural_plugin_index', //should be the same one as the id in section.
				'args' => array(
					'label_for' => 'chat_manager',
					'class' => 'ui-toggle'
					)
			]
		];

		return $this->settings_api->setFields( $args );
	}
}