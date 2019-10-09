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
     * @param Table | string $table
     * @return Factory|\Illuminate\View\Factory|View
     */
    public function render( $table ) {

        if ( !( $table instanceof Table ) ) {
            $table = new $table;
        }

        return view( 'admin.table', ['header' => $this->header, 'table' => $table, 'sidebar' => $this->sidebar] );
    }
}