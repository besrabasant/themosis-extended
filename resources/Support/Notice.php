<?php

namespace Themosis\ThemosisExtended\Support;

use Themosis\ThemosisExtended\Constants\WpCacheKey;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Themosis\Core\Application;
use Themosis\Support\Facades\Action;
use function array_push;

/**
 * Class Notice
 * @package Themosis\ThemosisExtended\Support
 */
class Notice
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

    /**
     * @var string
     */
    protected $notice_display_hook = 'user_notices';

    /**
     * @var string
     */
    protected $session_key = WpCacheKey::USER_NOTICES;

    public const TYPE_SUCCESS = 'success';

    public const TYPE_INFO = 'info';

    public const TYPE_ERROR = 'danger';

    public const TYPE_WARNING = 'warning';

    private $session;

    private $request;

    /**
     * AdminNotice constructor.
     * @param Application $app
     */
    public function __construct( Application $app ) {
        $this->app = $app;

        $this->request = $app['request'];

        $this->session = $this->request->session();
    }

    private function setType( $type ) {
        $this->type = $type;
    }

    private function build( $title, $message ) {
        $this->notice = view( 'app.ui.notice', [
            'title'   => $title,
            'message' => $message,
            'type'    => $this->type,
        ] );
    }


    private function add() {

        Action::add( $this->notice_display_hook, function () {
            echo $this->notice;
        } );
    }

    /**
     * @param string $message
     * @param string $title
     * @param string $type
     */
    public function set( string $message, string $title = "", $type = self::TYPE_INFO ) {
        $this->setType( $type );

        $this->build( $title, $message );

        $this->add();
    }

    /**
     * @param string $message
     * @param string $title
     * @param string $type
     */
    public function flash( string $message, string $title = "", $type = self::TYPE_INFO ) {
        $admin_notices = $this->session->get( $this->session_key );

        if ( !$admin_notices ) {
            $admin_notices = [];
        }

        array_push( $admin_notices, [
            'title'   => $title,
            'message' => $message,
            'type'    => $type,
        ] );

        $this->session->put( $this->session_key, $admin_notices );
    }

    /**
     * @param string $message
     * @param string $title
     * @param bool $flash
     */
    public function success( string $message, string $title = "", bool $flash = false ) {
        $this->prepareNoticeMessage( $message, $title, $flash, static::TYPE_SUCCESS );
    }

    /**
     * @param string $message
     * @param string $title
     * @param bool $flash
     */
    public function info( string $message, string $title = "", bool $flash = false ) {
        $this->prepareNoticeMessage( $message, $title, $flash, static::TYPE_INFO );
    }

    /**
     * @param string $message
     * @param string $title
     * @param bool $flash
     */
    public function warning( string $message, string $title = "", bool $flash = false ) {
        $this->prepareNoticeMessage( $message, $title, $flash, static::TYPE_WARNING );
    }

    /**
     * @param string $message
     * @param string $title
     * @param bool $flash
     */
    public function error( string $message, string $title = "", bool $flash = false ) {
        $this->prepareNoticeMessage( $message, $title, $flash, static::TYPE_ERROR );
    }

    /**
     * @param string $message
     * @param string $title
     * @param bool $flash
     * @param string $type
     */
    protected function prepareNoticeMessage( string $message, string $title, bool $flash, string $type ) {
        if ( $flash ) {
            $this->flash( $message, $title, $type );
        } else {
            $this->set( $message, $title, $type );
        }
    }
}