<?php


namespace Themosis\ThemosisExtended\Support\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * Class Form
 * @package Themosis\ThemosisExtended\Support\Facades
 */
class FormView extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor() {
        return \Themosis\ThemosisExtended\Views\FormView::class;
    }
}