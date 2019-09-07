<?php


namespace Themosis\ThemosisExtended\Forms\Transformers;


use League\Fractal\TransformerAbstract;
use Themosis\ThemosisExtended\Forms\Contracts\PageInterface;

/**
 * Class PageTransformer
 * @package Themosis\ThemosisExtended\Forms\Transformers
 */
class PageTransformer extends TransformerAbstract
{
    /**
     * @param PageInterface $page
     * @return array
     */
    public function transform( PageInterface $page ) {
        return [
            'id'    => $page->getId(),
            'title' => $page->getTitle(),
        ];
    }
}