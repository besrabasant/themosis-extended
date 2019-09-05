<?php


namespace Themosis\ThemosisExtended\Support\Serializers;


use League\Fractal\Serializer\ArraySerializer;

/**
 * Class TableSerializer
 * @package Themosis\ThemosisExtended\Support\Serializers
 */
class TableSerializer extends ArraySerializer
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