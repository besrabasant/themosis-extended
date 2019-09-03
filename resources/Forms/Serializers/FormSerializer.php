<?php


namespace Themosis\ThemosisExtended\Forms\Serializers;


use League\Fractal\Serializer\ArraySerializer;

/**
 * Class FormSerializer
 * @package Themosis\ThemosisExtended\Forms\Serializers
 */
class FormSerializer extends ArraySerializer
{
    /**
     * @param string $resourceKey
     * @param array $data
     * @return array
     */
    public function collection( $resourceKey, array $data ) {
        return $data;
    }
}