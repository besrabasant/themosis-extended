<?php


namespace Themosis\ThemosisExtended\Forms\Support;

use Themosis\ThemosisExtended\Forms\FormGroups;

/**
 * Class FrontendForm
 * @package Themosis\ThemosisExtended\Forms\Support
 */
abstract class FrontendForm extends BaseForm
{
    protected $theme = 'frontend.forms';

    /**
     * @return string
     */
    protected function getFormSubmitFieldGroup() {
        return FormGroups::DEFAULT;
    }
}