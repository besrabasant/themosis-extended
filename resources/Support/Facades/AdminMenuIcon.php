<?php


namespace Themosis\ThemosisExtended\Support\Facades;

use Illuminate\Support\Facades\Facade;

class AdminMenuIcon extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor() {
        return \Themosis\ThemosisExtended\Support\AdminMenuIcon::class;
    }
}