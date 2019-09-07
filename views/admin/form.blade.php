@php
    /** @var \Themosis\Forms\Form $form */
@endphp

@extends('layouts.admin')

@section('page_content')
    <div id="__themosis-extended-admin-form" class="admin-page__form admin-form">
    <!--{!! $form->toJson() !!}-->
    </div>
{{--    {!! $form->render() !!}--}}
@endsection