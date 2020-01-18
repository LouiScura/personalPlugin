<?php
/**
* @package personalPLugin
*/

namespace Inc\Templates;

class AdminTemplate
{
    public static function admin_template(){
        echo '<html>';
            echo '<h2 style="font-size:22px;color:red;font-weight:bold;letter-spacing:1px">This is the admin page</h2>';
        echo '</html>';
    }
}