<?php


namespace Themosis\ThemosisExtended\Forms\Support;


use Themosis\ThemosisExtended\Forms\Contracts\PageInterface;
use Themosis\ThemosisExtended\Forms\Fields\Types\FormPage;

/**
 * Class Page
 * @package Themosis\ThemosisExtended\Forms\Support
 */
class Page implements PageInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * Page constructor.
     * @param string $id
     * @param string $title
     */
    public function __construct( string $id, string $title ) {
        $this->id = $id;

        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getID(): string {
        return $this->id;
    }

    /**
     * @param string $id
     * @return PageInterface
     */
    public function setId( string $id ): PageInterface {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string {
        return $this->title;
    }

    /**
     * @param string $title
     * @return PageInterface
     */
    public function setTitle( string $title ): PageInterface {
        $this->title = $title;

        return $this;
    }
}