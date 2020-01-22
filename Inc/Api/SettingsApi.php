<?php
/**
* @package personalPLugin
*/

namespace Inc\Api;

class SettingsApi
{   
    public $admin_pages = array(); //by default is an empty array

    public function register()
    {
        if( ! empty( $this->admin_pages ) ){
            add_action('admin_menu', array( $this, 'addAdminMenu' )); //if the array is not empty we add it to the wordpress admin menu
        }
    }

    public function addPages( array $pages ) //we'll pass the pass the parameter on admin(register), will be all the pages that we want to add in wordpress admin menu.
    {   
        $this->$admin_pages = $pages;

        return $this;//returning the instance of the class in order to be able to call methods.(chaining methods)
    }

    public function addAdminMenu()//loop and activate all the pages at once.
    {
        foreach( $this->admin_pages as $page){
            add_menu_page( $page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'], $page['icon_url'], $page['position'] );            
        }
    }
}