<?php


namespace Themosis\ThemosisExtended\Forms;


use Themosis\Forms\Fields\FieldsRepository;
use Themosis\ThemosisExtended\Forms\Contracts\ExtendedFieldsRepositoryInterface;
use Themosis\ThemosisExtended\Forms\Contracts\PageInterface;

/**
 * Class ExtendedFieldRespository
 * @package Themosis\ThemosisExtended\Forms
 */
class ExtendedFieldRepository extends FieldsRepository implements ExtendedFieldsRepositoryInterface
{
    /**
     * All pages with fields.
     *
     * @var PageInterface[]
     */
    protected $pages = [];

    /**
     * @param PageInterface $page
     * @return ExtendedFieldsRepositoryInterface
     */
    public function addPage( PageInterface $page ): ExtendedFieldsRepositoryInterface {
        $this->pages[$page->getId()] = $page;

        return $this;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasPage( string $name ): bool {
        return isset( $this->pages[$name] );
    }

    /**
     * @param string $name
     * @return PageInterface
     */
    public function getPage( string $name ): PageInterface {
        return $this->pages[$name];
    }

    /**
     * @return array
     */
    public function pages(): array {
        return $this->pages;
    }
}