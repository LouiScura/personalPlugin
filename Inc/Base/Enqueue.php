<?php
/**
* @package personalPLugin
*/

namespace Inc\Base;

use \Inc\Base\BaseController;

class Enqueue extends BaseController 
{
    public function register(){
        add_action('admin_enqueue_scripts', array($this,'enqueue') ); //admin -> backend , wp -> front-end. To have a class method as a callback, you need to specify the class.(using $this).
    }

    public function enqueue(){
        // enqueue all our scripts
        wp_enqueue_style('mypluginstyle', $this->plugin_url . 'assets/style.min.css');
        wp_enqueue_script('mypluginscript', $this->plugin_url . 'assets/script.min.js');
    }
}
//this is just a quickly test!