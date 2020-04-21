<?php
/**
* @package personalPLugin
*/

namespace Inc\Api\Callbacks; 

use Inc\Base\BaseController;    

class ManagerCallbacks extends BaseController 
{
    public function checkboxSanitize( $input )
    {
        $output = [];

        foreach( $this->managers as $key => $value){ //loop through all managers fields 
            $output[$key] = isset( $input[$key] ) ? true : false; //check if are checks(specific key is on the form) 
        }

        echo $input[$key];

        return $output; //array of data as wordpress wanted
    }

    public function adminSectionManager()
    {
        echo 'Manage the Sections and Features of this Plugin by activating the checkboxes from the following list.';
    }

    public function checkboxField( $args )
    {
        $name = $args['label_for'];
        $classes = $args['class'];
        $option_name = $args['option_name'];
        // $checked = isset($checkbox[$name] ? true : false);
        $checkbox = get_option(  $option_name );

        echo '<div class="' . $classes . '">
                <input type="checkbox" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="1" ' . ($checkbox[$name] ? 'checked' : '') . '>
                <label for="'. $name .'">
                    <div>
                        <span>Plural Plugin</span>
                    </div>
                </label>
              </div>';
    }
}