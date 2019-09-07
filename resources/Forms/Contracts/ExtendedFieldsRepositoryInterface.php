<?php


namespace Themosis\ThemosisExtended\Forms\Contracts;


use Themosis\Forms\Contracts\FieldsRepositoryInterface;
use Themosis\Forms\Contracts\FieldTypeInterface;
use Themosis\Support\Contracts\SectionInterface;

/**
 * Interface ExtendedFieldsRepositoryInterface
 * @package Themosis\ThemosisExtended\Forms\Contracts
 */
interface ExtendedFieldsRepositoryInterface
{
    /**
     * @param PageInterface $page
     * @return ExtendedFieldsRepositoryInterface
     */
    public function addPage(PageInterface $page): ExtendedFieldsRepositoryInterface;

    /**
     * @param string $name
     * @return bool
     */
    public function hasPage(string $name): bool;

    /**
     * @param string $name
     * @return PageInterface
     */
    public function getPage(string $name): PageInterface;

    /**
     * @return array
     */
    public function pages(): array;
}