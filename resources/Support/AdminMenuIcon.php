<?php


namespace Themosis\ThemosisExtended\Support;


use Themosis\Core\Application;
use Themosis\Core\PluginManager;

/**
 * Class AdminMenuIcon
 * @package Themosis\ThemosisExtended\Support
 */
class AdminMenuIcon
{
    /**
     * @var Application
     */
    private $app;

    /**
     * @var PluginManager
     */
    private $plugin;

    public function __construct( Application $app, PluginManager $plugin ) {
        $this->app = $app;

        $this->plugin = $plugin;
    }

    /**
     * @param string $icon_name
     */
    public function get($icon_name) {
        return 'data:image/svg+xml;base64,'. base64_encode(file_get_contents($this->plugin->getPath("assets/icons/admin/{$icon_name}.svg")));
    }
}