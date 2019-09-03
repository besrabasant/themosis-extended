<?php


namespace Themosis\ThemosisExtended\Forms\Fields\Types;


use Themosis\Forms\Fields\Types\TextType;

/**
 * Class DateTime
 * @package Themosis\ThemosisExtended\Forms\Fields\Types
 */
class DateTime extends TextType
{
    /**
     * PasswordType field view.
     *
     * @var string
     */
    protected $view = 'types.datetime';

    /**
     * Field type.
     *
     * @var string
     */
    protected $type = 'date';

    /**
     * The component name.
     *
     * @var string
     */
    protected $component = 'themosis.fields.datetime';

    /**
     * Field resource transformer
     * @var string
     */
    protected $resourceTransformer = 'FieldTransformer';

    /**
     * DateTime constructor.
     * @param string $name
     */
    public function __construct( string $name ) {
        parent::__construct( $name );

        $this->allowedOptions = $this->setAllowedOptions();
        $this->defaultOptions = $this->setDefaultOptions();
    }

    /**
     * @return array
     */
    protected function setDefaultOptions() {
        return array_merge( $this->defaultOptions, [
            'attributes' => [
                'readonly' => false,
            ],
            'allow_null' => false,
        ] );
    }

    protected function setAllowedOptions() {
        return array_merge( $this->allowedOptions, [
            'allow_null',
        ] );
    }
}