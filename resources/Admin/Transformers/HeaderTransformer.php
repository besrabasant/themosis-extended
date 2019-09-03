<?php


namespace Themosis\ThemosisExtended\Admin\Transformers;


use League\Fractal\TransformerAbstract;
use Themosis\ThemosisExtended\Admin\Header;

/**
 * Class HeaderTransformer
 * @package Themosis\ThemosisExtended\Admin\Transformers
 */
class HeaderTransformer extends TransformerAbstract
{
    /**
     * @param Header $header
     * @return array
     */
    public function transform(Header $header) {
        return [
            'title' => $header->getTitle()
        ];
    }
}