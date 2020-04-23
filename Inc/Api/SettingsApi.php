<?php
/**
* @package personalPLugin
*/

namespace Inc\Api;

class SettingsApi
{   
    public $admin_pages = array(); //by default is an empty array

    public $admin_subpages = array();

    public $subpage = array();

    public $settings;
    
    public $sections;

    public $fields;

    public function register()
    {
        /*
        Is gonna look for admin_page(main page) or all the subpages related to the main page. 
        */
        if( ! empty( $this->admin_pages ) || ! empty( $this->admin_subpages )   ){
            add_action('admin_menu', array( $this, 'addAdminMenu' )); //if the array is not empty we add it to the wordpress admin menu
        }

        if ( ! empty( $this->settings ) ){
			add_action( 'admin_init', array( $this, 'registerCustomFields' ) ); //admin_init it's to initiliaze settings specific to the admin area
        }

    }

    public function addPages( array $pages ) //we'll pass the pass the parameter on admin(register), will be all the pages that we want to add in wordpress admin menu.
    {   
        $this->admin_pages = $pages;

        return $this;//returning the instance of the class in order to be able to call methods.(chaining methods)
    }

    public function withSubPage( string $title = '' ) //wp requires an exactly sub-page of main page
    {    
        if( empty( $this->admin_pages) ){
            return $this; //whenever u have a return, it's stops everything after the return.
        }

        $admin_page = $this->admin_pages[0]; //we need to declare this in order to use in subpage(it takes the first array(page) which is the main admin menu page).

        /*
            because this one is gonna be all the same as admin we do $admin_page[] in every spot.\
            submenu need parent_slug 
        */

        $subpage = [
            [
                'parent_slug' => $admin_page['menu_slug'], 
				'page_title' => $admin_page['page_title'], 
				'menu_title' => ($title) ? $title : $admin_page['menu_title'], //is gonna have whatever title you pass on the parameter if not take the $admin_page['menu_title']
				'capability' => $admin_page['capability'], 
				'menu_slug' => $admin_page['menu_slug'], 
				'callback' => $admin_page['callback']
            ]
        ];

        $this->admin_subpages = $subpage;

        return $this;
    }

    public function addSubPages( array $pages )
    {
        $this->admin_subpages = array_merge( $this->admin_subpages, $pages);//we merge the subpage array into pages(this one contain all pages)

        return $this;
    }


    /*
        Wordpress allow us to add subpages with the same method 'admin_menu' & 'addAdminMenu'.
    */

    public function addAdminMenu()//loop and activate all the pages at once.
    {
        foreach( $this->admin_pages as $page){
            add_menu_page( $page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'], $page['icon_url'], $page['position'] );            
        }

        foreach ( $this->admin_subpages as $page ) {
			add_submenu_page( $page['parent_slug'], $page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'] );
        } 
    }

    public function setSettings( array $settings )
    {
        $this->settings = $settings; //the empty variable will be all the args that we're passing on admin file. 

        return $this;
    }

    public function setSections( array $sections )
    {
        $this->sections = $sections;

        return $this;;
    }

    public function setFields( array $fields )
    {
        $this->fields  = $fields;

        return $this;
    }

    public function registerCustomFields()
    {
        //Register Settings
        foreach( $this->settings as $setting ){
            register_setting( $setting["option_group"], $setting["option_name"], ( isset( $setting["callback"] ) ? $setting["callback"] : '' ) );
        }

        //Add Settings Sections
        foreach( $this->sections as $section ){
            add_settings_section( $section["id"], $section["title"], ( isset( $section["callback"] ) ? $section["callback"] : '' ), $section["page"] );
        }

        //Add Fields
        foreach( $this->fields as $field ){
            add_settings_field( $field["id"], $field["title"], ( isset( $field["callback"] ) ? $field["callback"] : '' ), $field["page"], $field["section"], ( isset( $field["args"] ) ? $field["args"] : '' ) );
        }
    }
}