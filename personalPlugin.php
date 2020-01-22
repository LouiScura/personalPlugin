<?php
/**
* @package personalPLugin
*/

/*
PLugin Name: Personal Plugin
Plugin URI: http://luisscura.com/wordpress
Description: This is a custom plugin for wordpress.
Version: 1.0.0
Author: Luis  Scura
Autor URI: http://luisscura.com/wordpress
Text Domain: personalPLugin
*/

/*
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <https://www.gnu.org/licenses/>

Copyright 2019  Luis Scura
*/

//If somebody/something extern to wordpress get acess we avoid it.
defined('ABSPATH') or ('Hey you should not be here!');

// We require the autoload in order to use the namespace.
require_once  'vendor/autoload.php';

if( class_exists( 'Inc\\Init' ) ){//autoload convetion
    Inc\Init::register_services();
}

function personal_plugin_activate(){
    Inc\Base\Activate::activate();//because we have composer, just point to the file and call the method.(no neeed to use "use")
}
register_activation_hook( __FILE__ , 'personal_plugin_activate');

function personal_plugin_deactivate(){
    Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__ , 'personal_plugin_deactivate');





