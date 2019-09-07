<?php


namespace Themosis\ThemosisExtended\Forms;

use Themosis\ThemosisExtended\Support\Contracts\ArrayableContants;

/**
 * Class FormGroups
 * @package Themosis\ThemosisExtended\Forms
 */
class FormGroups implements ArrayableContants
{
    const MAIN = 'main';
    const META_TWO_COLS = 'meta-two-cols';
    const META_THREE_COLS = 'meta-three-cols';
    const META_FOUR_COLS = 'meta-four-cols';
    const SIDEBAR_FIELDS = 'sidebar-fields';
    const SIDEBAR_CTA = 'sidebar-cta';
    const PAGE = 'form-page';

    /**
     * @return array
     */
    public static function toArray(): array {
        return [
            self::MAIN,
            self::META_TWO_COLS,
            self::META_THREE_COLS,
            self::META_FOUR_COLS,
            self::SIDEBAR_FIELDS,
            self::SIDEBAR_CTA,
            self::PAGE,
        ];
    }
}