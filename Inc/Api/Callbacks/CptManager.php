<?php
/**
* @package personalPLugin
*/

namespace Inc\Api\Callbacks; 

class CptManager
{
    public function cptSanitize( $input )
    {   
        return $input;
    }

    public function cptSectionManager()
    {
        echo 'Customize as many CPT fields as you want!';
    }

    public function textField( $args )
	{
		$name = $args['label_for'];
		$option_name = $args['option_name'];
		$input = get_option( $option_name );
		$value = $input[ $name ];

        echo '<input type="text" class="regular-text" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="' . $value . '" placeholder="' . $args['placeholder'] . '">';
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
