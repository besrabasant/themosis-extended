<?php

namespace Themosis\ThemosisExtended\Hooks;

use Illuminate\Http\Request;
use Themosis\Hook\Hookable;

class PersistSessions extends Hookable
{
    public $hook = 'shutdown';

    /**
     * Extend WordPress.
     */
    public function register() {

        /** @var Request $request */
        $request = app( 'request' );

        if ( is_admin() && $request->hasSession() ) {
            $request->session()->save();
        }
    }
}
