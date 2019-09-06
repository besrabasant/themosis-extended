<?php


namespace Themosis\ThemosisExtended\Support\Contracts;

/**
 * Interface FieldableContantMap
 * @package Themosis\ThemosisExtended\Support\Contracts
 */
interface FieldableConstantMap
{
    /**
     * @return array
     */
    public static function toFieldOptions(): array;
}