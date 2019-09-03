<?php


namespace Themosis\ThemosisExtended\Forms\Contracts;

/**
 * Interface CanExtendAllowedOptions
 * @package Themosis\ThemosisExtended\Forms\Contracts
 */
interface CanExtendAllowedOptions
{
    /**
     * @param array $options
     * @return mixed
     */
    public function extendAllowedOptions(array $options);
}