<?php


namespace Themosis\ThemosisExtended\Forms\Support;


use Themosis\Field\Contracts\FieldFactoryInterface;
use Themosis\Forms\Contracts\FormFactoryInterface;
use Themosis\Forms\Contracts\Formidable;
use Themosis\Forms\Contracts\FormInterface;
use Themosis\ThemosisExtended\Constants\TextDomainContexts;
use Themosis\ThemosisExtended\Forms\Contracts\ExtendedFieldFactoryInterface;
use Themosis\ThemosisExtended\Forms\FormGroups;

/**
 * Class BaseForm
 * @package Themosis\ThemosisExtended\Forms\Support
 */
abstract class BaseForm implements Formidable
{
    /**
     * @var null | mixed
     */
    protected $formData;

    /**
     * @var array
     */
    protected $defaultOptions = [
        'theme'      => 'admin.forms',
        'attributes' => [
            'class'      => 'form needs-validation',
            'novalidate' => true,
        ],
    ];

    /**
     * BaseForm constructor.
     * @param null | mixed $formData
     */
    public function __construct( $formData = null ) {
        $this->formData = $formData;
    }

    /**
     * Returns Form Options.
     * @return array
     */
    protected function getFormOptions() {
        return [];
    }

    /**
     * @param FieldFactoryInterface | ExtendedFieldFactoryInterface $fields
     * @return array
     */
    abstract protected function getFields( FieldFactoryInterface $fields );

    /**
     * @return string|void
     */
    protected function getFormSubmitLabel() {
        return _x( 'Submit', TextDomainContexts::BASE_FORM, TH_EXTENDED_TD );
    }

    /**
     * Build your form.
     *
     * @param FormFactoryInterface $factory
     * @param FieldFactoryInterface | ExtendedFieldFactoryInterface $fields
     *
     * @return FormInterface
     */
    public function build( FormFactoryInterface $factory, FieldFactoryInterface $fields ): FormInterface {

        $form_options = array_merge( $this->defaultOptions, $this->getFormOptions() );

        $form_builder = $factory->make( $this->formData, $form_options );

        foreach ( $this->getFields( $fields ) as $field ) {
            $form_builder->add( $field );
        }

        $form_builder->add( $fields->submit( 'form_submit', [
            'label'  => $this->getFormSubmitLabel(),
            'mapped' => false,
            'group'  => FormGroups::SIDEBAR_CTA,
        ] ) );

        $form = $form_builder->get();

        $form->setPrefix( '' );

        return $form;
    }
}