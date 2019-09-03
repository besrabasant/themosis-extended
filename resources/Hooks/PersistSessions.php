<?php

namespace Themosis\ThemosisExtended\Hooks;

use Illuminate\Contracts\Session\Session;
use Themosis\Hook\Hookable;

class PersistSessions extends Hookable
{
    public $hook = 'shutdown';

    /**
     * Extend WordPress.
     */
    public function register() {
        $this->app->make( Session::class )->save();
    }
}
