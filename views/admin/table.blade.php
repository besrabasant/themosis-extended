@php
    /** @var $table */
@endphp

@extends('layouts.admin')

@section('page_content')
    <div id="__themosis-extended-admin-table" class="admin-page__table">
    </div>
    {!! $table->render() !!}
@endsection