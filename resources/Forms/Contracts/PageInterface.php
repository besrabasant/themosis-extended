<?php


namespace Themosis\ThemosisExtended\Forms\Contracts;

/**
 * Interface PageInterface
 * @package Themosis\ThemosisExtended\Forms\Contracts
 */
interface PageInterface
{
    /**
     * @return string
     */
    public function getID(): string;

    /**
     * @param string $id
     * @return PageInterface
     */
    public function setID( string $id ): PageInterface;

    /**
     * @return string
     */
    public function getTitle(): string;

    /**
     * @param string $title
     * @return PageInterface
     */
    public function setTitle( string $title ): PageInterface;
}