@php
    /**
     * @var object $attributes Table Attributes.
     * @var $columns Table columns.
     */
@endphp

<thead class="table__thead">
<tr class="table__row">
    @foreach($columns as $column_key => $column_name)
        <th class="table__th table__column table__column--{{ $column_key }}" scope="col">{!! $column_name !!}</th>
    @endforeach
</tr>
</thead>