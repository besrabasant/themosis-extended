<?php


namespace Themosis\ThemosisExtended\Forms\Transformers;

use Themosis\Forms\Contracts\FieldTypeInterface;
use Themosis\Forms\Contracts\FormInterface;
use Themosis\Forms\Resources\Transformers\FormTransformer;

/**
 * Class ExtendedFormTransformer
 * @package Themosis\ThemosisExtended\Forms\Transformers
 */
class ExtendedFormTransformer extends FormTransformer
{

    /**
     * @var array
     */
    protected $defaultIncludes = [
        'fields',
        'groups',
        'pages',
    ];

    /**
     * @param FieldTypeInterface $form
     * @return array
     */
    public function transform( FieldTypeInterface $form ) {

        $parentData = parent::transform( $form );

        $extendedData = [
            'name'          => $form->getName(),
            'nonce_value'   => wp_create_nonce( $form->getOption( 'nonce_action' ) ),
            'referer_value' => esc_attr( wp_unslash( $_SERVER['REQUEST_URI'] ) ),
            'csrf_token'    => csrf_token(),
        ];

        return array_merge(
            $parentData,
            $extendedData
        );
    }

    /**
     * Include "pages" property to resource.
     *
     * @param FieldTypeInterface $form
     *
     * @return \League\Fractal\Resource\Collection
     */
    public function includePages( FieldTypeInterface $form ) {
        /** @var FieldTypeInterface|FormInterface $form */
        return $this->collection(
            $form->repository()->pages(),
            $form->getResourceTransformerFactory()->make( PageTransformer::class )
        );
    }
}