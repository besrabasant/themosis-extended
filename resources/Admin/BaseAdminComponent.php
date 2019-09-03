<?php


namespace Themosis\ThemosisExtended\Admin;


use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\ResourceInterface;
use League\Fractal\Serializer\ArraySerializer;
use Themosis\Forms\Resources\Factory;
use Themosis\ThemosisExtended\Support\Contracts\AdminComponentInterface;

/**
 * Class BaseAdminComponent
 * @package Themosis\ThemosisExtended\Admin
 */
abstract class BaseAdminComponent implements AdminComponentInterface
{
    /**
     * @var Manager
     */
    protected $manager;

    /**
     * @var Factory
     */
    protected $factory;

    /**
     * @var string
     */
    protected $resourceTransformer;

    /**
     * Sidebar constructor.
     */
    public function __construct() {
        $this->manager = new Manager();
        $this->factory = new Factory();
    }

    /**
     * @return Manager
     */
    protected function getManager(): Manager {
        return $this->manager;
    }

    /**
     * Return the transformer factory.
     *
     * @return Factory
     */
    protected function getResourceTransformerFactory(): Factory {
        return $this->factory;
    }

    /**
     * Define the Fractal resource used by the field.
     *
     * @return ResourceInterface
     */
    protected function resource(): ResourceInterface {
        return new Item( $this, $this->getResourceTransformerFactory()->make( $this->resourceTransformer ) );
    }

    /**
     * @return BaseAdminComponent
     */
    protected function serialize(): BaseAdminComponent {
        $this->manager->setSerializer( new ArraySerializer() );

        return $this;
    }

    /**
     * @return string
     */
    public function toJson(): string {
        return $this->serialize()->getManager()->createData( $this->resource() )->toJson();
    }
}