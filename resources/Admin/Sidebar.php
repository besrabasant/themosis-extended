<?php


namespace Themosis\ThemosisExtended\Admin;

use Themosis\ThemosisExtended\Admin\Transformers\SidebarTransformer;

/**
 * Class Sidebar
 * @package Themosis\ThemosisExtended\Admin
 */
class Sidebar extends BaseAdminComponent
{
    /**
     * @var string
     */
    protected $resourceTransformer = SidebarTransformer::class;

    /**
     * @return string
     */
    public function getTitle() {
        return "Admin new sidebar";
    }
}