<?php


namespace Themosis\ThemosisExtended\Forms\Contracts;


use Themosis\Core\Forms\FormHelper;
use Themosis\Forms\Contracts\FormInterface;

trait ExtendedFormHelper
{
    use FormHelper {
        FormHelper::form as parentForm;
        FormHelper::getFormFactory as parentGetFormFactory;
        FormHelper::getFieldsFactory as parentGetFieldsFactory;
    }

    /**
     * Create and return a form instance.
     *
     * @param ExtendedFormidable $formClass
     *
     * @return FormInterface
     */
    public function form( ExtendedFormidable $formClass ) {
        return $formClass->build( $this->parentGetFormFactory(), $this->parentGetFieldsFactory() );
    }
}