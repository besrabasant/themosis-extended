<?php


namespace Themosis\ThemosisExtended\Providers;

use Themosis\Support\Facades\Asset;
use Themosis\Support\Facades\Filter;

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

        /** Frontend assets */
        Asset::add( $this->plugin->getHeader( 'plugin_id' ), $this->plugin->getUrl( 'dist/css/themosis-extended.css' ), [], $this->plugin->getHeader( 'version' ) )->to( 'front' );
        Asset::add( $this->plugin->getHeader( 'plugin_id' ), $this->plugin->getUrl( 'dist/js/themosis-extended.js' ), ['wp-url', 'wp-element', 'wp-data'], $this->plugin->getHeader( 'version' ) )->to( 'front' );

        /** Admin assets */
        Asset::add( $this->plugin->getHeader( 'plugin_id' ) . '-admin', $this->plugin->getUrl( 'dist/css/themosis-extended-admin.css' ), $this->css_Dependencies, $this->plugin->getHeader( 'version' ) )->to( 'admin' );
        $jsAsset = Asset::add( $this->plugin->getHeader( 'plugin_id' ) . '-admin', $this->plugin->getUrl( 'dist/js/themosis-extended-admin.js' ), $this->js_Dependencies, $this->plugin->getHeader( 'version' ) )->to( 'admin' );
        $jsAsset->localize( $this->plugin->getHeader( 'plugin_prefix' ), [
            'tiny_mce_table_plugin' => $this->plugin->getUrl( 'dist/tinymce/plugins/table/plugin.min.js' ),
        ] );
    }
}