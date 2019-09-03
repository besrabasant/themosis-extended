<?php


namespace Themosis\ThemosisExtended\Constants;

/**
 * Class Base
 * @package Themosis\ThemosisExtended\Constants
 */
abstract class Base
{
    public static function __callStatic( $name, $arguments ) {
        $class_name = get_class( __CLASS__ );
        $constant_reflex = new \ReflectionClassConstant( $class_name, $name );
        return $constant_reflex->getValue();
    }
}