<?php


namespace Themosis\ThemosisExtended\Forms\Contracts;

use Themosis\Forms\Contracts\FieldTypeInterface;

/**
 * Interface ExtendedFieldFactoryInterface
 * @package Themosis\ThemosisExtended\Forms\Contracts
 */
interface ExtendedFieldFactoryInterface
{
    public function datetime( string $name, array $options ): FieldTypeInterface;

    public function editor( string $name, array $options ): FieldTypeInterface;

    public function make( string $fieldClass, string $fieldName, array $options ): FieldTypeInterface;
}