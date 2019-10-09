<?php


namespace Themosis\ThemosisExtended\Forms;


use Themosis\Forms\Contracts\FieldTypeInterface;
use Themosis\Forms\Contracts\FormBuilderInterface;
use Themosis\Forms\Contracts\FormInterface;
use Themosis\Forms\DataMappers\DataMapperManager;
use Themosis\Forms\Fields\Types\BaseType;
use Themosis\Forms\FormBuilder;
use Themosis\Support\Section;
use Themosis\ThemosisExtended\Forms\Support\Page;

/**
 * Class ExtendedFormBuilder
 * @package Themosis\ThemosisExtended\Forms
 */
class ExtendedFormBuilder extends FormBuilder
{
    /**
     * @var null | string
     */
    private static $page;

    /**
     * ExtendedFormBuilder constructor.
     * @param FormInterface $form
     * @param DataMapperManager $dataMapperManager
     * @param null $dataClass
     */
    public function __construct( FormInterface $form, DataMapperManager $dataMapperManager, $dataClass = null ) {
        parent::__construct( $form, $dataMapperManager, $dataClass );

        static::$page = null;
    }

    /**
     * Add a field to the current form instance.
     *
     * @param FieldTypeInterface $field
     *
     * @return FormBuilderInterface
     */
    public function add( FieldTypeInterface $field ): FormBuilderInterface {
        /** @var BaseType $field */
        $opts = $this->validateOptions( array_merge( [
            'errors' => $this->form->getOption( 'errors' ),
            'theme'  => $this->form->getOption( 'theme' ),
        ], $field->getOptions() ), $field );
        $field->setLocale( $this->form->getLocale() );
        $field->setOptions( $opts );
        $field->setForm( $this->form );
        $field->setViewFactory( $this->form->getViewer() );
        $field->setResourceTransformerFactory( $this->form->getResourceTransformerFactory() );

        // DTO
        if ( !is_null( $this->dataClass ) && is_object( $this->dataClass ) && $field->getOption( 'mapped' ) ) {
            $this->dataMapperManager->mapFromObjectToField( $this->dataClass, $field );
        }

        if ( $field->getType() == 'page' ) {
            $this->addPageToRepository( $field );
        } else {
            $this->addFieldToRespository( $field );
        }


        return $this;
    }

    /**
     * @param FieldTypeInterface $field
     */
    private function addPageToRepository( FieldTypeInterface $field ) {

        static::$page = $field->getBaseName();

        if ( !$this->form->repository()->hasPage( $field->getBaseName() ) ) {

            $page = new Page( $field->getBaseName(), $field->getLabel() );

            $this->form->repository()->addPage( $page );
        }
    }

    /**
     * @param FieldTypeInterface $field
     */
    private function addFieldToRespository( FieldTypeInterface $field ) {

        if ( static::$page ) {
            $field->setOptions( ['page' => static::$page] );
        }

        // Check if section instance already exists on the form.
        // If not, create a new section instance.
        if ( $this->form->repository()->hasGroup( $field->getOption( 'group' ) ) ) {
            // The section/group instance is already registered, just fetch it.
            $section = $this->form->repository()->getGroup( $field->getOption( 'group' ) );
        } else {
            // No defined group. Let's create an instance so we can attach
            // the field to it right after.
            $section = new Section( $field->getOption( 'group' ) );
        }

        // Setup group/section default view.
        $section->setTheme( $this->form->getTheme() );
        $section->setView( 'form.group' );

        // Add the field first to section instance.
        // Then pass both objects to the repository.
        $section->addItem( $field );
        $this->form->repository()->addField( $field, $section );
    }
}