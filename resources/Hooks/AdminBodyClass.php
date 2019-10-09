<?php


namespace Themosis\ThemosisExtended\Hooks;

use Illuminate\Support\Facades\Request;
use Illuminate\Contracts\Debug\ExceptionHandler;
use mysql_xdevapi\Exception;
use Themosis\Hook\Hookable;
use Themosis\ThemosisExtended\Admin\PagesRepository;

/**
 * Class AdminBodyClass
 * @package Themosis\ThemosisExtended\Hooks
 */
class AdminBodyClass extends Hookable
{
    public $hook = 'admin_body_class';

    public $priority = 30;

    public function register( $body_classes ) {

        if ( Request::has( 'page' ) ) {
            $pages_repository = PagesRepository::getInstance();

            if ( $pages_repository->hasPage( Request::get( 'page' ) ) ) {
                $body_classes .= ' themosis-extended-admin-page';

                if ( app()->environment( 'production', 'staging' ) ) {
                    $body_classes .= ' themosis-extended-admin-page--loading';
                }
            }
        }

        return $body_classes;
    }
}