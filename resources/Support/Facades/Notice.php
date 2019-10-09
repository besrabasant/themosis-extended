<?php


namespace Themosis\ThemosisExtended\Support\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * Class Notice
 * @package Themosis\ThemosisExtended\Support\Facades
 */
class Notice extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor() {
        return \Themosis\ThemosisExtended\Support\Notice::class;
    }
}