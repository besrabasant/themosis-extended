@php
    /** @var object $attributes Table Attributes. */
    /** @var string[] $columns Table Columns. */
    /** @var [] $rows Table Rows. */
@endphp

<table id="{{ $attributes->id }}" class="table table-bordered table--{{ $attributes->id }}">
    @include($attributes->theme .'.table-head', ['attributes' => $attributes, 'columns' => $columns])
    @include($attributes->theme .'.table-body', ['attributes' => $attributes, 'columns' => $columns, 'rows' => $rows])
</table>