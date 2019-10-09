<?php

namespace Themosis\ThemosisExtended\Support\UI;

use Illuminate\Contracts\View\Factory;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;
use phpDocumentor\Reflection\Types\String_;
use Themosis\Field\Contracts\FieldFactoryInterface;
use Themosis\Forms\Contracts\FieldsRepositoryInterface;
use Themosis\Forms\Contracts\FormInterface;
use Themosis\Forms\Fields\FieldsRepository;
use Themosis\Forms\Form;
use Themosis\ThemosisExtended\Constants\TextDomainContexts;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Themosis\ThemosisExtended\Forms\Contracts\ExtendedFieldFactoryInterface;
use Themosis\ThemosisExtended\Forms\Contracts\ExtendedFieldsRepositoryInterface;
use Themosis\ThemosisExtended\Forms\ExtendedFieldRepository;
use Themosis\ThemosisExtended\Forms\ExtendedForm;
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
     * @var string
     */
    protected $filtersBaseUrl = "";

    /**
     * @var string
     */
    protected $tableBaseUrl = "";

    /**
     * @var TableFilters
     */
    private $filterForm;

    /**
     * @var
     */
    private $page;

    /**
     * Table constructor.
     * @param string $page
     */
    public function __construct( $page = '' ) {
        $this->filterForm = new TableFilters( $this );
        $this->page = $page;

        $this->setManager( new Manager() );
        $this->prepare();

        $this->setTableBaseUrl( ['page' => $this->getPage()] );
    }

    /**
     * @param Table $page
     */
    public function setPage( $page ): void {
        $this->page = $page;
    }

    /**
     * Returns the page the table is set for.
     *
     * @return mixed
     */
    public function getPage() {
        return $this->page;
    }

    /**
     * @param array $query_args
     * @param string $admin_page
     */
    public function setTableBaseUrl( array $query_args, string $admin_page = 'admin.php' ) {
        $this->tableBaseUrl = add_query_arg( $query_args, admin_url( $admin_page ) );
    }

    /**
     * Returns Table baseUrl.
     *
     * @return string
     */
    public function getTableBaseUrl() {
        return $this->tableBaseUrl;
    }

    /**
     * @return Form | ExtendedForm
     */
    public function getFilterForm(): FormInterface {
        //TODO: Resolve dependencies from Container.using dependency injection.
        return $this->filterForm->build( app( 'form' ), app( 'field' ) );
    }

    /**
     * Returns all the  Filters currently applied to table.
     *
     * @return array|mixed
     */
    public function getAppliedFilters() {

        if ( request()->has( 'filters' ) ) {
            return request()->get( 'filters' );
        }

        return [];
    }

    /**
     * @param FieldFactoryInterface | ExtendedFieldFactoryInterface $fields
     * @return array
     */
    public static function getFilters( FieldFactoryInterface $fields ) {
        return [];
    }

    /**
     * Returns Table pre-defined  views.
     *
     * @return array
     */
    public function getViews() {
        return [];
    }

    /**
     * Check view is current view.
     *
     * @param $view
     * @return bool
     */
    public function isCurrentView( $view ) {
        $current_view = $this->getCurrentView();

        if ( in_array( $view, array_values( $current_view ) ) ) {
            return true;
        } elseif ( array_key_exists( $view, $current_view ) ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return array|mixed
     */
    public function getCurrentView() {
        $current_view_params = $this->getAppliedFilters();

        if ( empty( $current_view_params ) ) {
            return ['all'];
        }

        return $current_view_params;
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
     * @return Collection| LengthAwarePaginator
     */
    public function getItems() {
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

    /**
     * Returns Table Columns keys.
     *
     * @return array
     */
    private function getColumnsKeys() {
        return array_keys( $this->getColumns() );
    }

    /**
     * Returns Table rows.
     *
     * @return array
     */
    public function getRows() {
        return $this->getItems()
            ->map( function ( $item, $key ) {
                return [
                    'item' => $item,
                    'html' => $this->prepareRow( $item, $key ),
                ];
            } )->all();
    }

    /**
     * Prepares row items for render.
     *
     * @param $item
     * @param $key
     * @return string
     */
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

    /**
     * Returns Table ID.
     *
     * @return string
     * @throws \ReflectionException
     */
    public function getTableId() {
        return Str::kebab( ( new \ReflectionClass( static::class ) )->getShortName() );
    }

    public function getTableAttributes() {
        // TODO: Make this a Data Transfer Object.

        return (object)[
            'id'               => $this->getTableId(),
            'theme'            => $this->theme,
            'empty_records'    => $this->emptyRecords(),
            'filters_base_url' => $this->getTableBaseUrl(),
            'page'             => $this->getPage(),
        ];
    }

    /**
     * Returns empty record string.
     *
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
     * Sets Table Serializer.
     *
     * @return Table
     */
    protected function serialize(): Table {
        $this->manager->setSerializer( new TableSerializer() );

        return $this;
    }

    /**
     * Serializes table to Array.
     *
     * @return array
     */
    public function toArray(): array {
        return $this->serialize()->getManager()->createData( $this->getResource() )->toArray();
    }

    /**
     * Serializes table to JSON.
     *
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

    /**
     * Returns pagination per page value.
     * @param int $default
     * @return int
     * @throws \ReflectionException
     */
    public function getPaginationPerPage( $default = 10 ) {
        $per_page = (int)\get_user_option( $this->getTableId() . "_per-page" );

        if ( empty( $per_page ) || $per_page < 1 ) {
            $per_page = $default;
        }

        return $per_page;
    }

    /**
     * Returns pagination current page value.
     *
     * @return int
     */
    public function getCurrentPage() {
        return LengthAwarePaginator::resolveCurrentPage( 'paged' ) ?? 1;
    }

    /**
     * Returns items as paged.
     *
     * @return Collection|LengthAwarePaginator
     * @throws \ReflectionException
     */
    public function getPagedItems() {
        return $this->getItems()->forPage( $this->getCurrentPage(), $this->getPaginationPerPage() );
    }

    /**
     * Returns Table Pagination instance.
     *
     * @return LengthAwarePaginator
     * @throws \ReflectionException
     */
    public function getPaginator() {
        return new LengthAwarePaginator( $this->getPagedItems(), $this->getItems()->count(), $this->getPaginationPerPage(), $this->getCurrentPage(), [
            'pageName' => 'paged',
            'path'     => $this->getTableBaseUrl(),
        ] );
    }
}