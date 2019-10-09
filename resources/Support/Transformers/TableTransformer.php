<?php


namespace Themosis\ThemosisExtended\Support\Transformers;


use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;
use Themosis\ThemosisExtended\Support\UI\Table;

/**
 * Class TableTransformer
 * @package Themosis\ThemosisExtended\Support\Transformers
 */
class TableTransformer extends TransformerAbstract
{
    /**
     * Default Includes.
     *
     * @var array
     */
    protected $defaultIncludes = [
        'rows',
        'paginate',
    ];

    /**
     * @param Table $table
     * @return array
     */
    public function transform( Table $table ) {
        return [
            'attributes'      => $table->getTableAttributes(),
            'columns'         => $table->getColumns(),
            'filters'         => $table->getFilterForm()->toArray(),
            'applied_filters' => $table->getAppliedFilters(),
            'views'           => $this->includeViews( $table ),
        ];
    }

    /**
     * Includes Table Rows to Transform.
     *
     * @param Table $table
     * @return Collection
     */
    public function includeRows( Table $table ) {
        return $this->collection( $table->getPagedItems(), $table->getItemsTransformer() );
    }

    /**
     * Returns views config.
     *
     * @param Table $table
     * @return array
     */
    private function includeViews( Table $table ) {
        return collect( $table->getViews() )->map( function ( $view, $viewkey ) use ( $table ) {
            $view['active'] = $table->isCurrentView( $viewkey );
            return $view;
        } )->all();
    }

    /**
     * @param Table $table
     * @return \League\Fractal\Resource\Item
     */
    public function includePaginate( Table $table ) {
        return $this->item( $table->getPaginator(), new TablePaginatorTransformer( $table ) );
    }
}