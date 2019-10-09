<?php


namespace Themosis\ThemosisExtended\Forms\Fields\Types;


use Themosis\Forms\Fields\Types\ChoiceType;
use Themosis\ThemosisExtended\Forms\Transformers\ExtendedChoiceFieldTransformer;

/**
 * Class ExtendedChoiceType
 * @package Themosis\ThemosisExtended\Forms\Fields\Types
 */
class ExtendedChoiceType extends ChoiceType
{
    /**
     * The choice field resource transformer.
     *
     * @var string
     */
    protected $resourceTransformer = ExtendedChoiceFieldTransformer::class;
}