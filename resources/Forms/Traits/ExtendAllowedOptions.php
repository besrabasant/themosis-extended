<?php


namespace Themosis\ThemosisExtended\Forms\Traits;


/**
 * Trait ExtendAllowedOptions
 * @package Themosis\ThemosisExtended\Forms\Traits
 */
trait ExtendAllowedOptions
{
    /**
     * @param array $options
     * @return $this
     */
    public function extendAllowedOptions( array $options ) {
        $this->allowedOptions = array_merge( $this->allowedOptions, $options );
        return $this;
    }
}