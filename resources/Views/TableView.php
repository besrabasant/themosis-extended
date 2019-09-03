<?php


namespace Themosis\ThemosisExtended\Views;


use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Themosis\ThemosisExtended\Support\UI\Table;

/**
 * Class TableView
 * @package Themosis\ThemosisExtended\Views
 */
class TableView extends BaseAdminView
{
    /**
     * @param Table $table
     * @return Factory|\Illuminate\View\Factory|View
     */
    public function render( $table ) {
        return view( 'admin.table', ['header' => $this->header, 'table' => $table, 'sidebar' => $this->sidebar] );
    }
}