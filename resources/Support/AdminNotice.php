<?php

namespace Themosis\ThemosisExtended\Support;

use Themosis\ThemosisExtended\Constants\WpCacheKey;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Themosis\Core\Application;
use Themosis\Support\Facades\Action;

/**
 * Class AdminNotice
 * @package Themosis\ThemosisExtended\Support
 */
class AdminNotice
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var View
     */
    protected $notice;

    public const TYPE_SUCCESS = 'success';

    public const TYPE_INFO = 'info';

    public const TYPE_ERROR = 'danger';

    public const TYPE_WARNING = 'warning';

    /**
     * AdminNotice constructor.
     * @param Application $app
     */
    public function __construct( Application $app ) {
        $this->app = $app;
    }

    private function setType( $type ) {
        $this->type = $type;
    }

    private function build( $title, $message ) {
        $this->notice = view( 'app.ui.admin-notice', [
            'title'   => $title,
            'message' => $message,
            'type'    => $this->type,
        ] );
    }

    private function add() {
        Action::add( 'admin_notices', function () {
            echo $this->notice;
        } );
    }

    public function set( string $message, string $title = "", $type = self::TYPE_INFO ) {
        $this->setType( $type );

        $this->build( $title, $message );

        $this->add();
    }

    public function flash( string $message, string $title = "", $type = self::TYPE_INFO ) {
        $admin_notices = Session::get( WpCacheKey::ADMIN_NOTICES );

        if ( !$admin_notices ) {
            $admin_notices = [];
        }

        array_push( $admin_notices, [
            'title'   => $title,
            'message' => $message,
            'type'    => $type,
        ] );

        Session::put( WpCacheKey::ADMIN_NOTICES, $admin_notices );
    }
}