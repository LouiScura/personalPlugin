<?php
/**
* @package personalPLugin
*/

namespace Inc;

final class Init
{

    //store all the differents entires classes and put in an array.
    public static function get_services()
    {
        return[
            Pages\Admin::class,
            Base\SettingsLinks::class,
            Base\Enqueue::class
        ];
    }

    //for each class of the array, we stored it in $class,and we call the register method.
    public static function register_services()
    {
        foreach(self::get_services() as $class){
            $service = self::instantiate($class); //before look for any method we first need to create a new instace of the class.
            if( method_exists($service, 'register') ){//looks for register method inside service.
                $service->register();
            }
        }
   }

   //we create a new instance of each class.
   private static function instantiate( $class )
   {
        $service = new $class();   
        return $service;    
   }
} 


