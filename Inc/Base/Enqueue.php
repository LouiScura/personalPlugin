<?php
/**
* @package personalPLugin
*/

namespace Inc\Base;

class Enqueue
{
    public function register(){
        add_action('admin_enqueue_scripts', array($this,'enqueue') ); //admin -> backend , wp -> front-end. To have a class method as a callback, you need to specify the class.(using $this).
    }

    public function enqueue(){
        // enqueue all our scripts
        wp_enqueue_style('mypluginstyle', PLUGIN_URL . 'assets/mystyle.css');
        wp_enqueue_script('mypluginscript', PLUGIN_URL . 'assets/myscript.js');
    }
}