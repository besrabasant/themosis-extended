<?php


namespace Themosis\ThemosisExtended\Forms;

use Illuminate\Contracts\Validation\Factory as ValidationFactoryInterface;
use Illuminate\Contracts\View\Factory as ViewFactoryInterface;
use Illuminate\Validation\Factory;
use Themosis\Forms\Contracts\FieldsRepositoryInterface;
use Themosis\Forms\DataMappers\DataMapperManager;
use Themosis\Forms\Form;
use Themosis\ThemosisExtended\Forms\Contracts\CanExtendAllowedOptions;
use Themosis\ThemosisExtended\Forms\Serializers\FormSerializer;
use Themosis\ThemosisExtended\Forms\Traits\ExtendAllowedOptions;
use Themosis\ThemosisExtended\Forms\Transformers\ExtendedFormTransformer;

/**
 * Class ExtendedForm
 * @package Themosis\ThemosisExtended\Forms
 */
class ExtendedForm extends Form
{
    /**
     * @var string
     */
    protected $resourceTransformer = ExtendedFormTransformer::class;

    /**
     * @var string
     */
    protected $prefix = '';

    /**
     * ExtendedForm constructor.
     * @param $dataClass
     * @param FieldsRepositoryInterface $repository
     * @param ValidationFactoryInterface $validation
     * @param ViewFactoryInterface $viewer
     * @param DataMapperManager $dataMapper
     */
    public function __construct( $dataClass, FieldsRepositoryInterface $repository, ValidationFactoryInterface $validation, ViewFactoryInterface $viewer, DataMapperManager $dataMapper ) {
        parent::__construct( $dataClass, $repository, $validation, $viewer, $dataMapper );

        $this->allowedOptions = $this->setAllowedOptions();
    }

    /**
     * @return array
     */
    protected function setAllowedOptions() {
        return array_merge( $this->allowedOptions, [
            'name',
        ] );
    }

    /**
     * @inheritDoc
     */
    protected function serialize(): Form {
        $this->manager->setSerializer( new FormSerializer() );

        return $this;
    }
}