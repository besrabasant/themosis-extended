<?php


namespace Themosis\ThemosisExtended\Providers;

use Themosis\Core\Application;
use Themosis\Support\Facades\Action;
use Themosis\ThemosisExtended\Hooks\AdminNotices;
use Themosis\ThemosisExtended\Support\AdminNotice;

class AdminNoticeServiceProvider extends BaseServiceProvider
{
    public function boot() {
        parent::boot();
    }

    public function register() {

        parent::register();

        $this->app->bind( AdminNotice::class, function ( Application $app ) {
            return new AdminNotice( $app );
        } );
    }
}