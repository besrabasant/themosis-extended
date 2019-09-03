<?php


namespace Themosis\ThemosisExtended\Providers;

use Themosis\Support\Facades\Asset;

/**
 * Class AssetServiceProvider
 * @package Vidyayatan\Exam\ExamManager\Providers
 */
class AssetServiceProvider extends BaseServiceProvider
{
    /**
     * Css asset dependencies.
     * @var array
     */
    private $css_Dependencies = [
        'wp-components',
    ];

    /**
     * Js asset dependencies.
     *
     * @var array
     */
    private $js_Dependencies = [
        'wp-compose',
        'wp-element',
        'wp-data',
        'wp-components',
        'wp-date',
        'wp-editor',
    ];

    /**
     * @inheritDoc
     */
    public function register() {
        parent::register();

        Asset::add( $this->plugin->getHeader( 'plugin_prefix' ), $this->plugin->getUrl( 'dist/css/themosis-extended-admin.css' ), $this->css_Dependencies, $this->plugin->getHeader( 'version' ) )->to( 'admin' );
        Asset::add( $this->plugin->getHeader( 'plugin_prefix' ), $this->plugin->getUrl( 'dist/js/themosis-extended-admin.js' ), $this->js_Dependencies, $this->plugin->getHeader( 'version' ) )->to( 'admin' );
    }
}