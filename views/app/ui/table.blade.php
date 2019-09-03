@php
    /** @var object $table_props Table Properties. */
    /** @var string[] $columns Table Columns. */
    /** @var [] $rows Table Rows. */
@endphp

<table id="{{ $table_props->name }}" class="table table-bordered table--{{ $table_props->name }}">
    @include('app.ui.table-head', ['table_props' => $table_props, 'columns' => $columns])
    @include('app.ui.table-body', ['table_props' => $table_props, 'columns' => $columns, 'rows' => $rows])
</table>