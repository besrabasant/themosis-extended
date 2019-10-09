<?php


namespace Themosis\ThemosisExtended\Forms\Transformers;


use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use Themosis\Forms\Contracts\FieldTypeInterface;
use Themosis\Forms\Resources\Factory;
use Themosis\Forms\Resources\Transformers\FieldTransformer;
use Themosis\ThemosisExtended\Forms\Serializers\FormSerializer;
use Themosis\ThemosisExtended\Forms\Fields\Types\VirtualMultiSelect;

/**
 * Class VirtualMutliSelectTransformer
 * @package Themosis\ThemosisExtended\Forms\Transformers
 */
class VirtualMutliSelectTransformer extends FieldTransformer
{
    /**
     * @param VirtualMultiSelect $field
     * @return array
     */
    public function transform( FieldTypeInterface $field ) {
        $parentTransform = parent::transform( $field );

        $parentTransform['options']['virtual_resource'] = $this->includeVirtualResource( $field );
        $parentTransform['options']['filters'] = $this->includeFilters( $field );

        return $parentTransform;
    }

    private function includeVirtualResource( VirtualMultiSelect $field ) {
        return [
            'endpoint' => $field->getVirtualResource()->getEndpoint(),
        ];
    }

    /**
     * Serialize prototypeFields to Array.
     *
     * @param VirtualMultiSelect $field
     * @return array
     */
    private function includeFilters( VirtualMultiSelect $field ) {
        $resource = new Collection( $field->filterFields()->all(), function ( FieldTypeInterface $field ) {
            $field = $field->setResourceTransformerFactory( new Factory() );
            $transformer = $field->getResourceTransformerFactory()->make( $field->getResourceTransformer() );

            /** @var FieldTransformer $transformer */
            return $transformer->transform( $field );
        } );

        $manager = ( new Manager() )->setSerializer( new FormSerializer );

        return $manager->createData( $resource )->toArray();
    }

}