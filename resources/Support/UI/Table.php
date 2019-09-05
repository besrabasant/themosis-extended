<?php

namespace Themosis\ThemosisExtended\Support\UI;

use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;
use Themosis\ThemosisExtended\Constants\TextDomainContexts;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Themosis\ThemosisExtended\Support\Serializers\TableSerializer;
use Themosis\ThemosisExtended\Support\Transformers\TableTransformer;

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

    /**
     * Table theme.
     *
     * @var string
     */
    protected $theme = "admin.tables";


    /**
     * @var Manager
     */
    protected $manager;

    /**
     * Table constructor.
     */
    public function __construct() {
        $this->setManager( new Manager() );
        $this->prepare();
    }

    /**
     * @param Manager $manager
     * @return Table
     */
    public function setManager( Manager $manager ): Table {
        $this->manager = $manager;
        return $this;
    }

    /**
     * @return Manager
     */
    public function getManager(): Manager {
        return $this->manager;
    }

    /**
     * @return Collection
     */
    public function getItems(): Collection {
        return $this->items;
    }

    /**
     * @return TransformerAbstract
     */
    abstract public function getItemsTransformer(): TransformerAbstract;

    /**
     * @return TransformerAbstract
     */
    protected function getTableTransformer(): TransformerAbstract {
        return new TableTransformer();
    }

    /**
     * @return Item
     */
    protected function getResource(): Item {
        return new Item( $this, $this->getTableTransformer() );
    }

    /**
     * @return array
     */
    abstract public function getColumns(): array;

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

    public function getRows() {
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

    protected function getTableId() {
        return Str::kebab( ( new \ReflectionClass( static::class ) )->getShortName() );
    }

    public function getTableAttributes() {
        // TODO: Make this a Data Transfer Object.

        return (object)[
            'id'            => $this->getTableId(),
            'theme'         => $this->theme,
            'empty_records' => $this->emptyRecords(),
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
     * @return Table
     */
    protected function serialize(): Table {
        $this->manager->setSerializer( new TableSerializer() );

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array {
        return $this->serialize()->getManager()->createData( $this->getResource() )->toArray();
    }

    /**
     * @return string
     */
    public function toJson(): string {
        return $this->serialize()->getManager()->createData( $this->getResource() )->toJson();
    }

    /**
     * Renders Table.
     * @return Factory|\Illuminate\View\Factory|View
     */
    public function render() {
        $columns = $this->getColumns();
        $rows = $this->getRows();
        $attributes = $this->getTableAttributes();

        return view( $this->theme . '.table', [
            'attributes' => $attributes,
            'columns'    => $columns,
            'rows'       => $rows,
        ] );
    }
}