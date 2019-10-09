<?php

namespace Themosis\ThemosisExtended\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Themosis\Core\Application;
use Themosis\Core\HooksRepository;
use Themosis\Forms\Resources\Factory;
use Themosis\ThemosisExtended\Admin\Pages;
use Themosis\ThemosisExtended\Constants\Plugin;
use Themosis\ThemosisExtended\Forms\ExtendedFieldFactory;
use Themosis\ThemosisExtended\Forms\ExtendedFormFactory;
use Themosis\ThemosisExtended\Support\AdminMenuIcon;


/**
 * Class BaseServiceProvider
 * @package Vidyayatan\Exam\ExamManager\Providers
 */
abstract class BaseServiceProvider extends ServiceProvider
{
    /**
     * @var \Themosis\Core\PluginManager
     */
    protected $plugin;

    /**
     * @var string
     */
    protected $plugin_context = Plugin::CONTAINER_ALIAS;

    /**
     * @inheritDoc
     */
    public function boot() {
        $this->setPluginInstance();
    }

    /**
     * @inheritDoc
     */
    public function register() {

        parent::register();

        $this->overrideBaseThemosisBindings();

        $this->setPluginInstance();

        $this->registerPluginHooks();

        $this->app->bind( AdminMenuIcon::class, function ( Application $app ) {
            return new AdminMenuIcon( $app, $this->plugin );
        } );
    }

    /**
     * Sets plugin instance from app container.
     */
    private function setPluginInstance() {
        $this->plugin = $this->app->make( $this->plugin_context );
    }

    /**
     * Registers plugin hooks.
     */
    protected function registerPluginHooks() {
        $hooks = Collection::make( $this->plugin->config( 'hooks' ) );

        ( new HooksRepository( $this->app ) )->load( $hooks->all() );
    }

    /**
     * Override base Themosis bindings.
     */
    protected function overrideBaseThemosisBindings() {
        $this->app->singleton( 'form', function ( $app ) {
            return new ExtendedFormFactory(
                $app['validator'],
                $app['view'],
                $app['league.fractal'],
                new Factory()
            );
        } );

        $this->app->singleton( 'field', function ( $app ) {
            return new ExtendedFieldFactory( $app, $app['view'] );
        } );
    }
}
