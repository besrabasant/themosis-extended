<?php


namespace Themosis\ThemosisExtended\Admin;

/**
 * Class PagesRepository
 * @package Themosis\ThemosisExtended\Admin
 */
final class PagesRepository
{
    /**
     * @var PagesRepository
     */
    private static $instance;

    /**
     * @var array
     */
    private $repository;

    /**
     * PagesRepository constructor.
     */
    private function __construct() {
        $this->repository = [];
    }

    /**
     *
     * Returns the Pages Repository singleton instance.
     *
     * @return PagesRepository
     */
    public static function getInstance() {
        if ( !self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Adds a page to the Pages repository.
     *
     * @param String $page
     */
    public function addPage( String $page ) {
        array_push( $this->repository, $page );
    }

    /**
     * Checks if a page is the pages repository.
     *
     * @param String $page
     * @return bool
     */
    public function hasPage( String $page ) {
        return in_array( $page, $this->repository );
    }
}