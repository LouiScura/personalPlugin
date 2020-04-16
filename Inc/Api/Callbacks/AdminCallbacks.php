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
        return require_once ($this->plugin_path . '/Templates/AdminTemplate.php');
    }

    public function cpt()
    {
        return require_once $this->plugin_path . '/Templates/Cpt.php';
    }

    public function taxonomies()
    {
        return require_once $this->plugin_path . '/Templates/Taxonomies.php';
    }

    public function widgets()
    {
        return require_once $this->plugin_path . '/Templates/Widgets.php';
    }

    public function pluralPluginSettingsGroups( $input )
    {   
        return $input;
    }

    public function pluralPluginAdminSection()
    {
        echo 'Check this beatiful section!';
    }

}
