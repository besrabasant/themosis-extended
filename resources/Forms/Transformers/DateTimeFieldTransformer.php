<?php


namespace Themosis\ThemosisExtended\Forms\Transformers;


use Themosis\Forms\Contracts\FieldTypeInterface;
use Themosis\Forms\Resources\Transformers\FieldTransformer;

/**
 * Class DateTimeFieldTransformer
 * @package Themosis\ThemosisExtended\Forms\Transformers
 */
class DateTimeFieldTransformer extends FieldTransformer
{
    public function transform( FieldTypeInterface $field ) {

        $parentTransform = parent::transform( $field );

        return array_merge(
            [
                'allow_null' => $field->getOption( 'allow_null' ),
            ],
            $parentTransform
        );
    }
}