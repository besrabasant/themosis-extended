<?php


namespace Themosis\ThemosisExtended\Support\UI;


use Themosis\Field\Contracts\FieldFactoryInterface;
use Themosis\Forms\Contracts\FormFactoryInterface;
use Themosis\Forms\Contracts\Formidable;
use Themosis\Forms\Contracts\FormInterface;
use Themosis\Forms\Form;
use Themosis\ThemosisExtended\Forms\Contracts\ExtendedFieldFactoryInterface;

/**
 * Class TableFilters
 * @package Themosis\ThemosisExtended\Support\UI
 */
class TableFilters implements Formidable
{
    private $table;

    /***
     * TableFilters constructor.
     * @param Table $table
     */
    public function __construct( Table $table ) {
        $this->table = $table;
    }

    /**
     * @param FormFactoryInterface $factory
     * @param FieldFactoryInterface | ExtendedFieldFactoryInterface $fields
     * @return FormInterface
     */
    public function build( FormFactoryInterface $factory, FieldFactoryInterface $fields ): FormInterface {
        $formbuilder = $factory->make();

        foreach ( $this->table::getFilters( $fields ) as $filter ) {
            $formbuilder->add( $filter );
        }

        /** @var Form $form */
        $form = $formbuilder->get();

        $form->setPrefix("");

        return $form;
    }
}