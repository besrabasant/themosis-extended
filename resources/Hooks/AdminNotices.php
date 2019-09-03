<?php


namespace Themosis\ThemosisExtended\Hooks;

use Illuminate\Support\Facades\Session;
use Themosis\Hook\Hookable;
use Themosis\ThemosisExtended\Constants\WpCacheKey;
use Themosis\ThemosisExtended\Support\Facades\AdminNotice;

/**
 * Class AdminNotices
 * @package Themosis\ThemosisExtended\Hooks
 */
class AdminNotices extends Hookable
{

    public $hook = 'admin_init';

    public function register() {
        if ( $admin_notices = Session::pull( WpCacheKey::ADMIN_NOTICES ) ) {
            foreach ( $admin_notices as $notice ) {
                AdminNotice::set( $notice['message'], $notice['title'], $notice['type'] );
            }
        }
    }
}