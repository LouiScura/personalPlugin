<?php
/**
* @package personalPLugin
*/

namespace Inc\Api\Callbacks; 

use \Inc\Base\BaseController;

class AdminCallbacks extends BaseController 
{
    public function adminDashboard()
    {
        return require_once ($this->plugin_path . '/Templates/admin.php');
    }

    public function cpt()
    {
        return require_once $this->plugin_path . '/Templates/cpt.php';
    }

    public function taxonomies()
    {
        return require_once $this->plugin_path . '/Templates/taxonomies.php';
    }

    public function widgets()
    {
        return require_once $this->plugin_path . '/Templates/widgets.php';
    }

    public function pluralPluginSettingsGroups( $input )
    {   
        return $input;
    }

    public function pluralPluginAdminSection()
    {
        echo 'Check this beatiful section!';
    }

    public function adminAuth()
    {
	    echo "<h2>Login Manager</h2>";
    }

    public function membershipController()
    {
            echo "<h2>Membership Controller</h2>";
    }

    public function chatManager()
    {
    	echo "<h2>Chat Manager</h2>";
    }

    public function testimonialManager()
    {
        echo "<h2>Testimonial Manager</h2>";
    }

    public function galleryManager()
    {
        echo "<h2>Gallery Manager</h2>";
    }

}
