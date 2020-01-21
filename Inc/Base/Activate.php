<?php
/**
* @package personalPLugin
*/

namespace Inc\Base; 

class Activate 
{
    public static function activate(){
        flush_rewrite_rules();
        // echo 'This is my'. PLUGIN_PATH;
    }
}