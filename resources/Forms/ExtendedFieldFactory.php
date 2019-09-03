<?php


namespace Themosis\ThemosisExtended\Forms;


use Illuminate\Contracts\View\Factory as ViewFactoryInterface;
use League\Fractal\Manager;
use Themosis\Core\Application;
use Themosis\Field\Contracts\FieldFactoryInterface;
use Themosis\Field\Factory;
use Themosis\Forms\Contracts\FieldTypeInterface;
use Themosis\Forms\Fields\Types\BaseType;
use Themosis\ThemosisExtended\Forms\Contracts\ExtendedFieldFactoryInterface;
use Themosis\ThemosisExtended\Forms\Fields\Types\DateTime;

/**
 * This class extends Themosis Field Factory class by proxying the class.
 *
 * Any New Field Type can be registered here.
 *
 * Class ExtendedFieldFactory
 * @package Themosis\ThemosisExtended\Forms
 */
class ExtendedFieldFactory implements FieldFactoryInterface, ExtendedFieldFactoryInterface
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @var ViewFactoryInterface
     */
    protected $viewFactory;

    /**
     * @var Factory
     */
    protected $factory;


    /**
     * ExtendedFieldFactory constructor.
     * @param Application $app
     * @param ViewFactoryInterface $factory
     */
    public function __construct( Application $app, ViewFactoryInterface $factory ) {
        $this->app = $app;

        $this->viewFactory = $factory;

        $this->factory = new Factory( $this->app, $this->viewFactory );
    }

    /**
     * @param string $fnName
     * @param string $name
     * @param array $options
     * @return FieldTypeInterface
     */
    private function getFieldFromFactory( string $fnName, string $name, array $options ): FieldTypeInterface {
        $field = $this->factory->{$fnName}( $name, $options );
        $field->setOptions( ['placeholder' => $field->getOption( 'label' )] );
        return $field;
    }

    /**
     * @param BaseType $field
     * @param array $options
     * @return FieldTypeInterface
     */
    private function buildField( BaseType $field, array $options ): FieldTypeInterface {

        $field->setLocale( $this->app->getLocale() )
            ->setManager( new Manager() )
            ->setViewFactory( $this->viewFactory )
            ->setOptions( $options );

        $field->setOptions( ['placeholder' => $field->getOption( 'label' )] );

        return $field;
    }

    /**
     * @param string $name
     * @param array $options
     * @return FieldTypeInterface
     */
    public function text( string $name, array $options = [] ): FieldTypeInterface {
        return $this->getFieldFromFactory( 'text', $name, $options );
    }

    /**
     * @param string $name
     * @param array $options
     * @return FieldTypeInterface
     */
    public function password( string $name, array $options = [] ): FieldTypeInterface {
        return $this->getFieldFromFactory( 'password', $name, $options );
    }

    /**
     * @param string $name
     * @param array $options
     * @return FieldTypeInterface
     */
    public function number( string $name, array $options = [] ): FieldTypeInterface {
        return $this->getFieldFromFactory( 'number', $name, $options );
    }

    /**
     * @param string $name
     * @param array $options
     * @return FieldTypeInterface
     */
    public function integer( string $name, array $options = [] ): FieldTypeInterface {
        return $this->getFieldFromFactory( 'integer', $name, $options );
    }

    /**
     * @param string $name
     * @param array $options
     * @return FieldTypeInterface
     */
    public function email( string $name, array $options = [] ): FieldTypeInterface {
        return $this->getFieldFromFactory( 'email', $name, $options );
    }

    /**
     * @param string $name
     * @param array $options
     * @return FieldTypeInterface
     */
    public function textarea( string $name, array $options = [] ): FieldTypeInterface {
        return $this->getFieldFromFactory( 'textarea', $name, $options );
    }

    /**
     * @param string $name
     * @param array $options
     * @return FieldTypeInterface
     */
    public function checkbox( string $name, array $options = [] ): FieldTypeInterface {
        return $this->getFieldFromFactory( 'checkbox', $name, $options );
    }

    /**
     * @param string $name
     * @param array $options
     * @return FieldTypeInterface
     */
    public function choice( string $name, array $options = [] ): FieldTypeInterface {
        return $this->getFieldFromFactory( 'choice', $name, $options );
    }

    /**
     * @param string $name
     * @param array $options
     * @return FieldTypeInterface
     */
    public function media( string $name, array $options = [] ): FieldTypeInterface {
        return $this->getFieldFromFactory( 'media', $name, $options );
    }

    /**
     * @param string $name
     * @param array $options
     * @return FieldTypeInterface
     */
    public function editor( string $name, array $options = [] ): FieldTypeInterface {
        return $this->getFieldFromFactory( 'editor', $name, $options );
    }

    /**
     * @param string $name
     * @param array $options
     * @return FieldTypeInterface
     */
    public function collection( string $name, array $options = [] ): FieldTypeInterface {
        return $this->getFieldFromFactory( 'collection', $name, $options );
    }

    /**
     * @param string $name
     * @param array $options
     * @return FieldTypeInterface
     */
    public function color( string $name, array $options = [] ): FieldTypeInterface {
        return $this->getFieldFromFactory( 'color', $name, $options );
    }

    /**
     * @param string $name
     * @param array $options
     * @return FieldTypeInterface
     */
    public function button( string $name, array $options = [] ): FieldTypeInterface {
        return $this->getFieldFromFactory( 'button', $name, $options );
    }

    /**
     * @param string $name
     * @param array $options
     * @return FieldTypeInterface
     */
    public function submit( string $name, array $options = [] ): FieldTypeInterface {
        return $this->getFieldFromFactory( 'submit', $name, $options );
    }

    /**
     * @param string $name
     * @param array $options
     *
     * @return FieldTypeInterface
     */
    public function hidden( string $name, array $options = [] ): FieldTypeInterface {
        return $this->getFieldFromFactory( 'hidden', $name, $options );
    }

    /**
     * @param string $name
     * @param array $options
     * @return FieldTypeInterface
     */
    public function datetime( string $name, array $options = [] ): FieldTypeInterface {
        return $this->buildField( new DateTime( $name ), $options );
    }
}