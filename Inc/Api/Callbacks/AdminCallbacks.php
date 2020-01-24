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
        // echo 'hola';
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
}
