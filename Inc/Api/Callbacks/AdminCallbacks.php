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

    public function pluralPluginSettingsGroups( $input )
    {   
        return $input;
    }

    public function pluralPluginAdminSection()
    {
        echo 'Check this beatiful section!';
    }

    public function pluralPluginTextExample()
	{
		$value = esc_attr( get_option( 'text_example' ) );
		echo '<input type="text" class="regular-text" name="text_example" value="' . $value . '" placeholder="Write Something Here!">';
	}

	public function pluralPluginFirstName()
	{
		$value = esc_attr( get_option( 'first_name' ) );
		echo '<input type="text" class="regular-text" name="first_name" value="' . $value . '" placeholder="Write your First Name">';
    }

}
