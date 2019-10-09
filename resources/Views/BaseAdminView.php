<?php


namespace Themosis\ThemosisExtended\Views;


use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Request;
use Illuminate\View\View;
use Themosis\Core\Application;
use Themosis\Support\Facades\Filter;
use Themosis\ThemosisExtended\Admin\Header;
use Themosis\ThemosisExtended\Admin\Sidebar;

abstract class BaseAdminView
{
    /**
     * @var Application
     */
    private $app;

    /**
     * @var Header
     */
    protected $header;

    /**
     * @var Sidebar
     */
    protected $sidebar;

    /**
     * FormView constructor.
     * @param Application $app
     */
    public function __construct( Application $app ) {
        $this->app = $app;
        $this->header = new Header();
        $this->sidebar = new Sidebar();

        $this->setDefaults();
    }

    /**
     * Sets default Values.
     */
    private function setDefaults() {

        $this->setDefaultTitle();
    }

    /**
     * Sets default title for the view.
     */
    private function setDefaultTitle() {
        $page_slug = 'page.' . Request::get( 'page' );

        if ( !$this->app->has( $page_slug ) ) {
            return;
        }

        $page = $this->app->get( $page_slug );
        $this->setTitle( $page->getMenu() );

        Filter::add( 'admin_title', function () use ( $page ) {
            return $this->header->getTitle() . " &#8249; " . $page->getTitle();
        } );
    }

    /**
     * @param String $title
     * @return $this
     */
    public function setTitle( String $title ) {
        $this->header->setTitle( $title );

        return $this;
    }

    /**
     * @param $viewObject
     * @return Factory|\Illuminate\View\Factory|View
     *
     * @todo Implement an base generic View interface.
     */
    abstract function render( $viewObject );
}