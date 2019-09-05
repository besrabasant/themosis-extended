@php
    /** @var Themosis\ThemosisExtended\Support\UI\Table $table */
@endphp

@extends('layouts.admin')

@section('page_content')
    <div id="__themosis-extended-admin-table" class="admin-page__table">
    <!--{!! $table->toJson() !!}-->
    </div>
@endsection