<?php


namespace Themosis\ThemosisExtended\Forms;


use Symfony\Component\PropertyAccess\PropertyAccess;
use Themosis\Forms\Contracts\FormBuilderInterface;
use Themosis\Forms\DataMappers\DataMapperManager;
use Themosis\Forms\Fields\FieldsRepository;
use Themosis\Forms\FormBuilder;
use Themosis\Forms\FormFactory;

/**
 * Class ExtendedFormFactory
 * @package Themosis\ThemosisExtended\Forms
 */
class ExtendedFormFactory extends FormFactory
{
    /**
     * Create a FormBuilderInterface instance.
     *
     * @param mixed  $dataClass Data object (DTO).
     * @param array  $options
     * @param string $builder   A FieldBuilderInterface class.
     *
     * @return FormBuilderInterface
     */
    public function make($dataClass = null, $options = [], $builder = FormBuilder::class): FormBuilderInterface
    {
        $dataMapperManager = new DataMapperManager(PropertyAccess::createPropertyAccessor());

        $form = new ExtendedForm(
            $dataClass,
            new FieldsRepository(),
            $this->validation,
            $this->viewer,
            $dataMapperManager
        );
        $form->setManager($this->manager);
        $form->setResourceTransformerFactory($this->factory);
        $form->setAttributes($this->attributes);
        $form->setOptions($options);

        $this->builder = new $builder($form, $dataMapperManager, $dataClass);

        return $this->builder;
    }

}