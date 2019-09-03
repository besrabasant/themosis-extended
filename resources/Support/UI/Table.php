<?php

namespace Themosis\ThemosisExtended\Support\UI;

use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Themosis\ThemosisExtended\Constants\TextDomainContexts;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class Table
 * @package Themosis\ThemosisExtended\Support\UI
 */
abstract class Table
{
    /**
     * @var Collection
     */
    protected $items;

    public function __construct() {
        $this->prepare();
    }

    /**
     * @return array
     */
    abstract protected function getColumns();

    /**
     * @return void
     */
    abstract protected function prepareItems();

    /**
     * @param Model $item
     * @param string $column_name
     * @param int $key
     * @return mixed
     */
    abstract protected function columnDefault( $item, $column_name, $key );

    private function getColumnsKeys() {
        return array_keys( $this->getColumns() );
    }

    private function getRows() {
        return $this->items->map( function ( $item, $key ) {
            return [
                'item' => $item,
                'html' => $this->prepareRow( $item, $key ),
            ];
        } )->all();
    }

    private function prepareRow( $item, $key ) {
        $columns = $this->getColumnsKeys();
        $rowColumns = '';

        foreach ( $columns as $column ) {
            $columnCallback = Str::camel( 'column_' . $column );
            $tableCellData = ( method_exists( $this, $columnCallback ) ) ? $this->{$columnCallback}( $item, $key ) : $this->columnDefault( $item, $column, $key );
            $rowColumns .= sprintf( '<td class="table__td table__td--%1$s table__column table__column--%1$s">%2$s</td>', $column, $tableCellData );
        }

        return $rowColumns;
    }

    private function getTableProps() {
        // TODO: Make this a Data Transfer Object.

        $classShortName = ( new \ReflectionClass( static::class ) )->getShortName();

        return (object)[
            'name'          => Str::kebab( $classShortName ),
            'empty_records' => $this->emptyRecords()
        ];
    }

    /**
     * @return string|void
     */
    protected function emptyRecords() {
        return _x( 'No records found.', TextDomainContexts::TABLE, APP_TD );
    }

    /**
     * Prepares items
     */
    private function prepare() {
        $this->prepareItems();
    }

    /**
     * Renders Table.
     * @return Factory|\Illuminate\View\Factory|View
     */
    public function render() {
        $columns = $this->getColumns();
        $rows = $this->getRows();
        $table_props = $this->getTableProps();

        return view( 'app.ui.table', [
            'table_props' => $table_props,
            'columns'     => $columns,
            'rows'        => $rows,
        ] );
    }
}