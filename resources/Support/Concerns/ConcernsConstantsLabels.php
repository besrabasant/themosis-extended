<?php


namespace Themosis\ThemosisExtended\Support\Concerns;


/**
 * Trait ConcernsConstantsLabels
 * @package Themosis\ThemosisExtended\Support\Concerns
 */
trait ConcernsConstantsLabels
{
    /**
     * @param $key
     * @return string
     */
    public static function getLabel( $key ): string {
        return array_flip( static::toFieldOptions() )[$key];
    }
}