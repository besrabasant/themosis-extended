<?php


namespace Themosis\ThemosisExtended\Admin\Transformers;


use League\Fractal\TransformerAbstract;
use Themosis\ThemosisExtended\Admin\Sidebar;

/**
 * Class SidebarTransformer
 * @package Themosis\ThemosisExtended\Admin\Transformers
 */
class SidebarTransformer extends TransformerAbstract
{
    /**
     * @param Sidebar $sidebar
     * @return array
     */
    public function transform( Sidebar $sidebar ) {
        return [
            [
                'name'       => 'themosis.core.sidebartitle',
                'attributes' => [
                    'title' => $sidebar->getTitle(),
                ],
            ],
        ];
    }
}