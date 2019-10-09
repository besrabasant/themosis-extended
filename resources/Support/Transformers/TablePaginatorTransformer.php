<?php


namespace Themosis\ThemosisExtended\Support\Transformers;


use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\TransformerAbstract;
use Themosis\ThemosisExtended\Support\UI\Table;

/**
 * Class TablePaginatorTransformer
 * @package Themosis\ThemosisExtended\Support\Transformers
 */
class TablePaginatorTransformer extends TransformerAbstract
{
    /**
     * @var Table
     */
    private $table;

    /**
     * TablePaginatorTransformer constructor.
     * @param Table $table
     */
    public function __construct( Table $table ) {
        $this->table = $table;
    }

    /**
     * @param LengthAwarePaginator $paginator
     * @return array
     */
    public function transform( LengthAwarePaginator $paginator ) {

        return [
            'total'            => $paginator->total(),
            'per_page'         => $paginator->perPage(),
            'current_page'     => $paginator->currentPage(),
            'last_page'        => $paginator->lastPage(),
            'current_page_url' => $paginator->url( $paginator->currentPage() ),
            'first_page_url'   => $paginator->url( 1 ),
            'last_page_url'    => $paginator->url( $paginator->lastPage() ),
            'next_page_url'    => $paginator->nextPageUrl(),
            'prev_page_url'    => $paginator->previousPageUrl(),
            'path'             => $this->table->getTableBaseUrl(),
            'from'             => $paginator->firstItem(),
            'to'               => $paginator->lastItem(),
        ];

    }
}