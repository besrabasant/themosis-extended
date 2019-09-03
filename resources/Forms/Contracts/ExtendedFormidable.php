<?php


namespace Themosis\ThemosisExtended\Forms\Contracts;


use Themosis\Forms\Contracts\FormFactoryInterface;
use Themosis\Forms\Contracts\Formidable;
use Themosis\Forms\Contracts\FormInterface;

/**
 * Interface ExtendedFormidable
 * @package Themosis\ThemosisExtended\Forms\Contracts
 */
interface ExtendedFormidable extends Formidable
{
    /**
     * @param FormFactoryInterface $factory
     * @param \Themosis\Field\Contracts\FieldFactoryInterface $fields
     * @return FormInterface
     */
    public function build( FormFactoryInterface $factory,  ExtendedFieldFactoryInterface $fields ): FormInterface;
}