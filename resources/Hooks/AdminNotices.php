<?php


namespace Themosis\ThemosisExtended\Hooks;

use Illuminate\Http\Request;
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

        /** @var Request $request */
        $request = app( 'request' );

        if ( $admin_notices = $request->session()->pull( WpCacheKey::ADMIN_NOTICES ) ) {

            foreach ( $admin_notices as $notice ) {
                AdminNotice::set( $notice['message'], $notice['title'], $notice['type'] );
            }
        }
    }
}