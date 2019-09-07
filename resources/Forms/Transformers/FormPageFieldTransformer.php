<?php


namespace Themosis\ThemosisExtended\Forms\Transformers;


use League\Fractal\TransformerAbstract;
use Themosis\Forms\Contracts\FieldTypeInterface;
use Themosis\Forms\Contracts\FormInterface;
use Themosis\Forms\Resources\Factory;
use Themosis\Forms\Resources\Transformers\FieldTransformer;

/**
 * Class DateTimeFieldTransformer
 * @package Themosis\ThemosisExtended\Forms\Transformers
 */
class FormPageFieldTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected $defaultIncludes = [
        'fields',
        //        'groups'
    ];

    public function transform( FieldTypeInterface $field ) {
        return [
            'attributes' => $field->getAttributes(),
        ];
    }

    public function includeFields( FieldTypeInterface $field ) {
        /** @var FieldTypeInterface|FormInterface $form */
        return $this->collection(
            $field->repository()->all(),
            function ( FieldTypeInterface $field ) {
                $field = $field->setResourceTransformerFactory( new Factory() );
                $transformer = $field->getResourceTransformerFactory()->make( $field->getResourceTransformer() );

                /** @var FieldTransformer $transformer */
                return $transformer->transform( $field );
            }
        );
    }
}