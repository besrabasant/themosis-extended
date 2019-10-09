<?php


namespace Themosis\ThemosisExtended\Forms\Fields\Types;


use Themosis\Forms\Contracts\FieldTypeInterface;
use Themosis\Forms\Fields\Types\BaseType;

/**
 * Class FormPage
 * @package Themosis\ThemosisExtended\Forms\Fields\Types
 */
class FormPage extends BaseType
{
    /**
     * FormPage field view.
     *
     * @var string
     */
    protected $view = 'types.formpage';

    /**
     * Field type.
     *
     * @var string
     */
    protected $type = 'page';

    /**
     * The component name.
     *
     * @var string
     */
    protected $component = 'themosis.fields.formpage';

    /**
     * FormPage constructor.
     * @param string $name
     */
    public function __construct( string $name ) {
        parent::__construct( $name );

        $this->defaultOptions = $this->setDefaultOptions();
    }

    /**
     * @return array
     */
    protected function setDefaultOptions() {
        return array_merge( $this->defaultOptions, [
            'mapped' => false,
        ] );
    }

    /**
     * @param array|string $value
     * @return FieldTypeInterface
     */
    public function setValue( $value ): FieldTypeInterface {
        return $this;
    }

    /**
     * @return array|string|null
     */
    public function getLabel() {
        return $this->getOption( 'label' );
    }

}