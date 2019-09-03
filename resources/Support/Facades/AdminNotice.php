<?php


namespace Themosis\ThemosisExtended\Support\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * Class AdminNotice
 * @package Themosis\ThemosisExtended\Support\Facades
 */
class AdminNotice extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Themosis\ThemosisExtended\Support\AdminNotice::class;
    }
}