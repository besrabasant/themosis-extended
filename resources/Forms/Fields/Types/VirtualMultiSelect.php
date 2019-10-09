<?php


namespace Themosis\ThemosisExtended\Forms\Fields\Types;


use Themosis\Forms\Fields\FieldsRepository;
use Themosis\Forms\Fields\Types\BaseType;
use Themosis\ThemosisExtended\Forms\Transformers\VirtualMultiSelectDataTransformer;
use Themosis\ThemosisExtended\Forms\Transformers\VirtualMutliSelectTransformer;
use Themosis\ThemosisExtended\VirtualResources\AbstractVirtualResource;

/**
 * Class VirtualMultiSelect
 * @package Themosis\ThemosisExtended\Forms\Fields\Types
 */
class VirtualMultiSelect extends BaseType
{
    /**
     * Field prefix.
     *
     * @var string
     */
    protected $prefix = '';

    /**
     * FormPage field view.
     *
     * @var string
     */
    protected $view = 'types.virtualmultiselect';

    /**
     * Field type.
     *
     * @var string
     */
    protected $type = 'virtualmultiselect';

    /**
     * The component name.
     *
     * @var string
     */
    protected $component = 'themosis.fields.virtualmultiselect';

    /**
     * @var
     */
    protected $virtualResource;


    /**
     * Field resource transformer.
     *
     * @var string
     */
    protected $resourceTransformer = VirtualMutliSelectTransformer::class;


    protected $filterFields;

    /**
     * VirtualMultiSelect constructor.
     * @param string $name
     */
    public function __construct( string $name ) {
        parent::__construct( $name );

        $this->filterFields = new FieldsRepository();

        $this->allowedOptions = $this->setAllowedOptions();
    }

    /**
     * Extends default allowed options.
     *
     * @return array
     */
    private function setAllowedOptions(): array {
        return array_merge( $this->allowedOptions, [
            'virtual_resource',
            'filters',
        ] );
    }

    /**
     * @param array $options
     * @return array
     */
    protected function parseOptions( array $options ): array {
        $this->setTransformer( new VirtualMultiSelectDataTransformer( $this ) );

        return parent::parseOptions( $options );
    }

    /**
     * Sets Virtual Resource.
     *
     * @param AbstractVirtualResource $virtualResource
     */
    public function setVirtualResource( $virtualResource ): void {
        $this->virtualResource = $virtualResource;
    }

    /**
     * Returns virtual resource.
     *
     * @return mixed
     */
    public function getVirtualResource(): AbstractVirtualResource {
        return $this->virtualResource;
    }

    /**
     * @return FieldsRepository
     */
    public function filterFields(): FieldsRepository {
        return $this->filterFields;
    }

}