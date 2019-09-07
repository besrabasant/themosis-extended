<?php

namespace Themosis\ThemosisExtended\Providers;

use Themosis\Core\Application;
use Themosis\ThemosisExtended\Admin\Pages;
use Themosis\ThemosisExtended\Views\FormView;
use Themosis\ThemosisExtended\Views\TableView;

class AppServiceProvider extends BaseServiceProvider
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

        $this->app->bind( Pages::class, function ( Application $app ) {
            $pages = new Pages( $app );
            $pages->setControllerNameSpace( $this->plugin->getHeader( 'plugin_namespace' ) );
            return $pages;
        } );

        $this->app->bind( FormView::class, function ( Application $app ) {
            return new FormView( $app );
        } );

        $this->app->bind( TableView::class, function ( Application $app ) {
            return new TableView( $app );
        } );

    }
}
