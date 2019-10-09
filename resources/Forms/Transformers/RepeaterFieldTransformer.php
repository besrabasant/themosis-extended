<?php


namespace Themosis\ThemosisExtended\Forms\Transformers;


use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use Themosis\Forms\Contracts\FieldTypeInterface;
use Themosis\Forms\Resources\Factory;
use Themosis\Forms\Resources\Transformers\FieldTransformer;
use Themosis\ThemosisExtended\Forms\Fields\Types\RepeaterField;
use Themosis\ThemosisExtended\Forms\Serializers\FormSerializer;


/**
 * Class RepeaterFieldTransformer
 * @package Themosis\ThemosisExtended\Forms\Transformers
 */
class RepeaterFieldTransformer extends FieldTransformer
{
    /**
     * @param RepeaterField $field
     * @return array
     */
    public function transform( FieldTypeInterface $field ) {
        $parentTransform = parent::transform( $field );

        unset( $parentTransform['options']['prototype'] );

        $parentTransform['prototype'] = $this->includePrototype( $field );

        return $parentTransform;
    }

    /**
     * Serialize prototypeFields to Array.
     *
     * @param RepeaterField $field
     * @return array
     */
    private function includePrototype( RepeaterField $field ) {
        $resource = new Collection( $field->prototype()->all(), function ( FieldTypeInterface $field ) {
            $field = $field->setResourceTransformerFactory( new Factory() );
            $transformer = $field->getResourceTransformerFactory()->make( $field->getResourceTransformer() );

            /** @var FieldTransformer $transformer */
            return $transformer->transform( $field );
        } );

        $manager = ( new Manager() )->setSerializer( new FormSerializer );

        return $manager->createData( $resource )->toArray();
    }
}