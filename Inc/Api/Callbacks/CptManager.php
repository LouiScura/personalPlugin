<?php
/**
* @package personalPLugin
*/

namespace Inc\Api\Callbacks; 

class CptManager
{
    public function cptSanitize( $input ) //information user fill up 
    {   
        $output = get_option('cpt_plugin'); //information on database

        foreach( $output as $key => $value ){ //for each option 
            if( $input['post_type'] == $key ){
                // echo "input['post_type'] is iqual to the key ----  ";
                $output[$key] = $input;
            }else{
                // echo "input['post_type'] IS NOT iqual to the key ----  ";
                $output[ $input[ 'post_type' ] ] = $input;
            }
        }

        return $output;
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

        echo '<input type="text" class="regular-text" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="" placeholder="' . $args['placeholder'] . '">';
    }
    
    public function checkboxField( $args )
    {
        $name = $args['label_for'];
        $classes = $args['class'];
        $option_name = $args['option_name'];
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
