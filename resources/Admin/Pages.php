<?php

namespace Themosis\ThemosisExtended\Admin;

use Themosis\Support\Facades\Page;
use Illuminate\Support\Str;

/**
 * Class Pages
 * @package Themosis\ThemosisExtended\Admin
 */
class Pages
{
    /**
     * @var \Themosis\Core\Application
     */
    protected $app;

    /**
     * @var \Themosis\Page\Page
     */
    protected $page;

    /**
     * @var \Themosis\Page\Page[]
     */
    protected $subpages;

    /**
     * @var string Page slug
     */
    protected $page_slug;

    /**
     * @var string Page title.
     */
    protected $page_title;

    /**
     * @var string Page controller Namespace.
     */
    protected $page_controller_namespace;

    /**
     * @var PagesRepository
     */
    protected $pages_repository;


    /**
     * Pages constructor.
     * @param \Themosis\Core\Application $app
     */
    public function __construct( \Themosis\Core\Application $app ) {
        $this->app = $app;

        $this->pages_repository = PagesRepository::getInstance();
    }

    /**
     * @param string $page_slug Page slug
     * @param string $page_title Page Title
     */
    private function setPageAttributes( string $page_slug, string $page_title ): void {
        $this->page_slug = $page_slug;

        $this->page_title = $page_title;
    }

    /**
     * @param string $namespace
     * @return $this
     */
    public function setControllerNameSpace( string $namespace ) {
        $this->page_controller_namespace = $namespace . '\Http\Controllers\Admin\\';

        return $this;
    }

    /**
     * Creates Admin Pages.
     * @param string $page_slug
     * @param string $page_title
     * @param string|null $menu_title
     * @param string $page_icon
     * @param int $page_position
     * @return Pages
     */
    public function create( string $page_slug, string $page_title, string $menu_title = '', string $page_icon = '', int $page_position = 4 ): Pages {
        $this->setPageAttributes( $page_slug, $page_title );

        if ( empty( $menu_title ) ) {
            $menu_title = $page_title;
        }

        $this->page = Page::make( $page_slug, $page_title )
            ->setCapability( 'manage_options' )
            ->setMenu( $menu_title )
            ->setIcon( $page_icon )
            ->setPosition( $page_position )
            ->set();

        $this->addPageController( $this->page, 'index', $page_title );

        $this->pages_repository->addPage( $page_slug );

        return $this;
    }

    /**
     * @return \Themosis\Page\Page
     */
    public function getPage(): \Themosis\Page\Page {
        return $this->page;
    }

    /**
     * @param string $page_slug
     * @return \Themosis\Page\Page|null
     */
    public function getSubpage( string $page_slug ) {
        if ( array_key_exists( $page_slug, $this->subpages ) ) {
            return $this->subpages[$page_slug];
        }

        return null;
    }

    /**
     * @param string $page_slug
     * @param string $page_title
     * @param string $menu_title
     * @return $this
     */
    public function addSubPage( string $page_slug, string $page_title, string $menu_title = '' ) {
        if ( empty( $menu_title ) ) {
            $menu_title = $page_title;
        }

        $this->subpages[$page_slug] = Page::make( $page_slug, $page_title )
            ->setMenu( $menu_title )
            ->setParent( $this->page_slug )
            ->setCapability( 'manage_options' )
            ->set();


        $this->addPageController( $this->subpages[$page_slug], $page_slug, $page_title );

        $this->pages_repository->addPage( $page_slug );

        return $this;
    }

    /**
     * @param \Themosis\Page\Page $page
     * @param string $page_slug
     * @param string $page_title
     */
    private function addPageController( \Themosis\Page\Page $page, string $page_slug, string $page_title ) {
        $controller_method = Str::camel( $page_slug );
        $controller_name = $this->page_controller_namespace . Str::studly( $this->page_slug ) . 'Controller';
        $page->route( '/', $controller_name . '@' . $controller_method );

    }
}
