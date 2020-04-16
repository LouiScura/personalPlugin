<?php
/**
* @package personalPLugin
*/

namespace Inc\Api\Callbacks; 

class ManagerCallbacks
{
    public function checkboxSanitize( $input )
    {
        return (isset($input) ? true : false);
    }

    public function adminSectionManager()
    {
        echo 'Manage the Sections and Features of this Plugin by activating the checkboxes from the following list.';
    }

    public function checkboxField( $args )
    {
        $name = $args['label_for'];
        $classes = $args['class'];
        $checkbox = get_option($name);

        echo '<div class="' . $classes . '">
                <input type="checkbox" name="'. $name .'" id="'. $name .'" value="1" '. ($checkbox ? 'checked' : '').'>
                <label for="'. $name .'"><div></div></label>
            </div>';
    }
}