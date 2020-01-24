<?php
/**
* @package personalPLugin
*/

namespace Inc\Api\AdminCallbacks; 

class AdminCallbacks
{
    public function register()
    {
        return require_once $this->plugin_path . '/Templates/AdminTemplate.php';
    }
}