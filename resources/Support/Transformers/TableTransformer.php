<?php


namespace Themosis\ThemosisExtended\Support\Transformers;


use League\Fractal\TransformerAbstract;
use Themosis\ThemosisExtended\Support\UI\Table;

class TableTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected $defaultIncludes = [
        'rows',
    ];

    /**
     * @param Table $table
     * @return array
     */
    public function transform( Table $table ) {
        return [
            'attributes' => $table->getTableAttributes(),
            'columns'    => $table->getColumns(),
        ];
    }

    /**
     * @param Table $table
     * @return \League\Fractal\Resource\Collection
     */
    public function includeRows(Table $table) {
        return $this->collection($table->getItems(), $table->getItemsTransformer());
    }
}