<?php
/**
* @package personalPLugin
*/

namespace Inc\Base; 

class BaseController
{
    public $plugin_path;

    public $plugin_url;

    public $plugin;

    public $managers = array(); //need to be an array

    public function __construct()
    {
        $this->plugin_url = plugin_dir_url( dirname( __FILE__, 2));
        $this->plugin = plugin_basename( dirname( __FILE__, 3).'/personalPlugin.php');
        $this->plugin_path = plugin_dir_path( dirname( __FILE__, 2 ) );

        /*
            Because we extended this entire class on Admin, wherever we write here we can use it on Admin.php
            We use $this cause we are refering to a variable declared inside a class.
        */
        $this->managers = [
            'cpt_manager' => 'Activate CTP Manager',
            'taxonomy_manager' => 'Activate Taxonomy Manager',
            'media_widget' => 'Activate Media Widget',
            'gallery_manager' => 'Activate Gallery Manager',
            'testimonial_manager' => 'Activate Testimonial Manager',
            'login_manager' => 'Activate Login Manager',
            'membership_manager' => 'Activate Membership Manager',
            'chat_manager' => 'Activate Chat Manager'
        ];
    }

}