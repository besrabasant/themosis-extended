@php
    /** @var object $attributes Table Attributes. */
    /** @var string[] $columns Table Columns. */
    /** @var [] $rows Table Rows. */
@endphp

<tbody class="table__body">
@if($rows)
    @foreach($rows as $row)
        <tr class="table__row table__row--{{ $row['item']->id }}">
            {!! $row['html'] !!}
        </tr>
    @endforeach
@else
    <tr class="table__row table__row--empty">
        <td class="table__td" colspan="{{ count($columns) }}">
            {!! $attributes->empty_records !!}
        </td>
    </tr>
@endif
</tbody>