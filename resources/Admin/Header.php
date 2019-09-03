<?php


namespace Themosis\ThemosisExtended\Admin;


use Themosis\ThemosisExtended\Admin\Transformers\HeaderTransformer;

class Header extends BaseAdminComponent
{
    /**
     * @var string
     */
    protected $title = "";

    /**
     * @var string
     */
    protected $resourceTransformer = HeaderTransformer::class;

    /**
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle( string $title ) {
        $this->title = $title;
    }
}