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

    public function register()
    {
        if( ! empty( $this->admin_pages ) ){
            add_action('admin_menu', array( $this, 'addAdminMenu' )); //if the array is not empty we add it to the wordpress admin menu
        }
    }

    public function addPages( array $pages ) //we'll pass the pass the parameter on admin(register), will be all the pages that we want to add in wordpress admin menu.
    {   
        $this->admin_pages = $pages;

        return $this;//returning the instance of the class in order to be able to call methods.(chaining methods)
    }

    public function withSubPage( string $title = '' )
    {    
        if( empty( $this->admin_pages) ){
            return $this;
        }

        $admin_page = $this->admin_pages[0];

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
        $this->admin_subpages = array_merge( $this->admin_subpages, $pages);

        return $this;
    }

    public function addAdminMenu()//loop and activate all the pages at once.
    {
        foreach( $this->admin_pages as $page){
            add_menu_page( $page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'], $page['icon_url'], $page['position'] );            
        }

        foreach ( $this->admin_subpages as $page ) {
			add_submenu_page( $page['parent_slug'], $page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'] );
		}
    }
}