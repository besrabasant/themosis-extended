<?php

namespace Themosis\ThemosisExtended\Providers;

use Barryvdh\Cors\HandleCors;
use Themosis\Core\Support\Providers\RouteServiceProvider as ServiceProvider;
use Themosis\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Controller namespace for plugin routes.
     *
     * @var string
     */
    protected $namespace = 'Themosis\ThemosisExtended\Http\Controllers';

    /**
     * @inheritDoc
     */
    public function boot()
    {
        parent::boot();
    }


    /**
     * Load plugin routes.
     */
    public function map() {
        $pluginName = ltrim(
            str_replace( muplugins_path(), '', realpath( __DIR__ . '/../../' ) ),
            '\/'
        );

        $this->mapWebRoutes( $pluginName );

        $this->mapApiRoutes( $pluginName );

        $this->mapVirtualResources( $pluginName );

    }

    /**
     * @param $pluginName
     */
    protected function mapWebRoutes( $pluginName ) {
        Route::middleware( 'web' )
            ->namespace( $this->namespace )
            ->group( muplugins_path( $pluginName . '/routes/web.php' ) );

    }

    /**
     * @param $pluginName
     */
    protected function mapApiRoutes( $pluginName ) {
        Route::middleware( [
            'web',
            'throttle:60,1',
            'bindings',
            HandleCors::class,
        ] )
            ->namespace( $this->namespace )
            ->group( muplugins_path( $pluginName . '/routes/api.php' ) );
    }

    /**
     * @param $pluginName
     */
    protected function mapVirtualResources( $pluginName ) {
        // Register virtual resource route.
        Route::name( 'virtualresource.' )
            ->middleware( [
                'throttle:60,1',
                'bindings',
                // Todo: Define a middleware for permission on ajax request.
                HandleCors::class,
            ] )
            ->prefix( 'themosis/virtualresource/v1' )
            ->group( muplugins_path( $pluginName . '/routes/virtual_resource.php' ) );

    }
}
