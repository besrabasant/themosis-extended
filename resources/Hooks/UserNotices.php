<?php


namespace Themosis\ThemosisExtended\Hooks;

use Illuminate\Http\Request;
use Themosis\Hook\Hookable;
use Themosis\ThemosisExtended\Constants\WpCacheKey;
use Themosis\ThemosisExtended\Support\Facades\Notice;

/**
 * Class UserNotices
 * @package Themosis\ThemosisExtended\Hooks
 */
class UserNotices extends Hookable
{

    public $hook = 'parse_query';

    public function register() {

        /** @var Request $request */
        $request = app( 'request' );

        if ( $request->hasSession() && $user_notices = $request->session()->pull( WpCacheKey::USER_NOTICES ) ) {
            foreach ( $user_notices as $notice ) {
                Notice::set( $notice['message'], $notice['title'], $notice['type'] );
            }
        }
    }
}