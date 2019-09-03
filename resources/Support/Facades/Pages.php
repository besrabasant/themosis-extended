<?php

namespace Themosis\ThemosisExtended\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Pages
 * @package Themosis\ThemosisExtended\Support\Facades
 */
class Pages extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Themosis\ThemosisExtended\Admin\Pages::class;
    }
}
