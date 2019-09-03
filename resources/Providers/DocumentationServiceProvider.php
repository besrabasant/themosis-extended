<?php

namespace Themosis\ThemosisExtended\Providers;

use Themosis\ThemosisExtended\Support\Facades\Pages;

class DocumentationServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot() {
        parent::boot();
    }

    /**
     * Register any application services.
     */
    public function register() {

        parent::register();

        if($this->app->environment('local', 'development')) {
            Pages::create('themosis_extended_documentation', __('Themosis Extended Documentation', TH_EXTENDED_TD), '', '', 999);
        }
    }
}
