<?php

namespace Themosis\ThemosisExtended\Forms\Transformers;


use Themosis\Forms\Contracts\DataTransformerInterface;
use Themosis\Forms\Transformers\Exceptions\DataTransformerException;
use Themosis\Support\Section;
use Themosis\ThemosisExtended\Forms\Fields\Types\RepeaterField;

/**
 * Class RepeaterFieldDataTransformer
 * @package Themosis\ThemosisExtended\Forms\Transformers
 */
class RepeaterFieldDataTransformer implements DataTransformerInterface
{
    /**
     * @var RepeaterField
     */
    protected $repeaterField;

    /**
     * RepeaterFieldDataTransformer constructor.
     * @param RepeaterField $field
     */
    public function __construct( RepeaterField $field ) {
        $this->repeaterField = $field;
    }

    /**
     * @param mixed $data
     * @return mixed
     * @throws DataTransformerException
     */
    public function transform( $data ) {

        $field_prototype = $this->repeaterField->getOption( 'prototype' );

        if ( !$field_prototype ) {
            throw new DataTransformerException( "option \"prototype\" not defined for Repeater field \"{$this->repeaterField->getBaseName()}\"." );
        }

        foreach ( $field_prototype as $index => $field ) {

            $field->setPrefix( $this->repeaterField->getPrefix() );

            $field_atts = $field->getAttributes();

            $field_atts['id'] = $this->repeaterField->getAttribute( 'id' ) . "_" . $field_atts['id'];

            $field->setAttributes( $field_atts );

            $this->repeaterField->prototype()->addField( $field, new Section( "" ) );
        }

        return $data;
    }

    /**
     * @param mixed $data
     * @return mixed
     */
    public function reverseTransform( $data ) {
        return $data;
    }
}