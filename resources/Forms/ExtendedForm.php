<?php


namespace Themosis\ThemosisExtended\Forms;

use Illuminate\Contracts\Validation\Factory as ValidationFactoryInterface;
use Illuminate\Contracts\View\Factory as ViewFactoryInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\Factory;
use Themosis\Forms\Contracts\FieldsRepositoryInterface;
use Themosis\Forms\Contracts\FormInterface;
use Themosis\Forms\DataMappers\DataMapperManager;
use Themosis\Forms\Form;
use Themosis\ThemosisExtended\Forms\Contracts\CanExtendAllowedOptions;
use Themosis\ThemosisExtended\Forms\Contracts\ExtendedFieldsRepositoryInterface;
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
     * @var string
     */
    protected $form_submit_field = 'form_submit';

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

    /**
     * @param Request $request
     * @return FormInterface
     * @throws \Illuminate\Validation\ValidationException
     */
    public function handleRequest( Request $request ): FormInterface {

        if ( $request->has( $this->getFormSubmitField() ) ) {
            return parent::handleRequest( $request );
        }

        return $this;
    }

    /**
     * @param string $fieldName
     *
     * @return ExtendedForm
     */
    public function setFormSubmitField( string $fieldName ): self {
        $this->form_submit_field = $fieldName;

        return $this;
    }

    /**
     * Returns form submit field name.
     *
     * @return string
     */
    public function getFormSubmitField(): string {
        return $this->form_submit_field;
    }

    /**
     * @return ExtendedFieldsRepositoryInterface | FieldsRepositoryInterface
     */
    public function repository(): FieldsRepositoryInterface {
        return parent::repository();
    }
}