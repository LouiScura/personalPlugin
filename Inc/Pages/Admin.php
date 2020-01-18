<?php
/**
* @package personalPLugin
*/

namespace Inc\Pages;

use Inc\Templates\AdminTemplate;

class Admin
{
    public function register(){
        add_action('admin_menu', array($this,'add_admin_pages'));//when u call a function inside antoher function(callback) you need to specify the class.(using $this).
    }

    public function add_admin_pages(){//function that create the admin menu , a bunch of parametres and carry a callback function 
        add_menu_page('Personal Plugin'/*pagetitle*/,'Personal Plugin'/*menutitle*/,'manage_options'/*capability*/,'personal_plugin'/*menuSlug unique*/,
            array($this,'admin_index')/*callback function of the template*/,'dashicons-star-empty'/*Icon*/,110/*postion*/);
    }

    public function admin_index(){
        AdminTemplate::admin_template();
    }
}