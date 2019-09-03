<?php


namespace Themosis\ThemosisExtended\Support\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * Class TableView
 * @package Themosis\ThemosisExtended\Support\Facades
 */
class TableView extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor() {
        return \Themosis\ThemosisExtended\Views\TableView::class;
    }
}