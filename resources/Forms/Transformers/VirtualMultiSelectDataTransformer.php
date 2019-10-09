<?php


namespace Themosis\ThemosisExtended\Forms\Transformers;


use Themosis\Forms\Contracts\DataTransformerInterface;
use Themosis\Forms\Transformers\Exceptions\DataTransformerException;
use Themosis\Support\Section;
use Themosis\ThemosisExtended\Forms\Fields\Types\VirtualMultiSelect;

/**
 * Class VirtualMultiSelectDataTransformer
 * @package Themosis\ThemosisExtended\Forms\Transformers
 */
class VirtualMultiSelectDataTransformer implements DataTransformerInterface
{
    /**
     * @var VirtualMultiSelect
     */
    protected $virtualMultiSelectField;

    /**
     * VirtualMultiSelectDataTransformer constructor.
     * @param VirtualMultiSelect $field
     */
    public function __construct( VirtualMultiSelect $field ) {
        $this->virtualMultiSelectField = $field;
    }

    /**
     * @param mixed $data
     * @return mixed
     * @throws DataTransformerException
     */
    public function transform( $data ) {
        $virtual_resource = $this->virtualMultiSelectField->getOption( 'virtual_resource' );
        $filters = $this->virtualMultiSelectField->getOption( 'filters' );

        if ( !$virtual_resource ) {
            throw new DataTransformerException( "option \"virtual_resource\" not defined for Virtual MultiSelect field \"{$this->virtualMultiSelectField->getBaseName()}\"." );
        }

        $this->virtualMultiSelectField->setVirtualResource( new $virtual_resource() );

        // Add filters fields to filter fields repository.
        foreach ( $filters as $filterField ) {
            $filterField->setPrefix( $this->virtualMultiSelectField->getPrefix() );
            $this->virtualMultiSelectField->filterFields()->addField( $filterField, new Section( "" ) );
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