@php
    /**
     * @var string $title
     * @var \Themosis\ThemosisExtended\Admin\Header $header
     * @var \Themosis\Page\Page $page
     * @var \Themosis\ThemosisExtended\Admin\Sidebar $sidebar
     */
@endphp

<div class="wrap wrap--exam-manager admin-page">
    <div class="admin-page__header" id="__themosis-extended-admin-header">
    <!--{!! $header->toJson() !!}-->
    </div>
    <div class="admin-page__content">
        @yield('page_content')
    </div>
    <div class="admin-page__sidebar" id="__themosis-extended-admin-sidebar">
    <!--{!! $sidebar->toJson() !!}-->
    </div>
</div>