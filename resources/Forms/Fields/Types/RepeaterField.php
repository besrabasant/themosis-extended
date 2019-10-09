<?php


namespace Themosis\ThemosisExtended\Forms\Fields\Types;


use Themosis\Forms\Fields\FieldsRepository;
use Themosis\Forms\Fields\Types\BaseType;
use Themosis\ThemosisExtended\Forms\Transformers\RepeaterFieldDataTransformer;
use Themosis\ThemosisExtended\Forms\Transformers\RepeaterFieldTransformer;

/**
 * Class RepeaterField
 * @package Themosis\ThemosisExtended\Forms\Fields\Types
 */
class RepeaterField extends BaseType
{
    /**
     * Field prefix.
     *
     * @var string
     */
    protected $prefix = '';

    /**
     * FormPage field view.
     *
     * @var string
     */
    protected $view = 'types.repeater';

    /**
     * Field type.
     *
     * @var string
     */
    protected $type = 'repeater';

    /**
     * The component name.
     *
     * @var string
     */
    protected $component = 'themosis.fields.repeater';


    /**
     * Stores the prototype for the sub fields.
     *
     * @var FieldsRepository
     */
    protected $prototype;

    /**
     * @var string
     */
    protected $resourceTransformer = RepeaterFieldTransformer::class;


    /**
     * DateTime constructor.
     * @param string $name
     */
    public function __construct( string $name ) {
        parent::__construct( $name );

        $this->prototype = new FieldsRepository();

        $this->allowedOptions = $this->setAllowedOptions();
        $this->defaultOptions = $this->setDefaultOptions();
    }

    /**
     * Returns field repository.
     *
     * @return FieldsRepository
     */
    public function prototype(): FieldsRepository {
        return $this->prototype;
    }

    /**
     * @return array
     */
    protected function setDefaultOptions() {
        return array_merge( $this->defaultOptions, [
            'add_item_label'    => __( 'Add new item', TH_EXTENDED_TD ),
            'remove_item_label' => __( 'Remove item', TH_EXTENDED_TD ),
            'min_items'         => 1,
            'max_items'         => null,
        ] );
    }

    /**
     * @return array
     */
    protected function setAllowedOptions() {
        return array_merge( $this->allowedOptions, [
            'add_item_label',
            'remove_item_label',
            'prototype',
            'min_items',
            'max_items',
        ] );
    }

    /**
     * @param array $options
     * @return array
     */
    protected function parseOptions( array $options ): array {
        // Set Repeater field data transformer.
        $this->setTransformer( new RepeaterFieldDataTransformer( $this ) );

        return parent::parseOptions( $options );
    }
}