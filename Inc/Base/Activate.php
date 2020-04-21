<?php
/**
* @package personalPLugin
*/

namespace Inc\Base; 

class Activate 
{
    public static function activate(){
        flush_rewrite_rules();

        if( get_option('plural_plugin') ){
            return; //if the plural_plugin table is there already, we return it.(everything after a return stop working)
        }

        $default = array();

        update_option('plural_plugin', $default); //if it's not there, we inject an empty array.
         
    }
}