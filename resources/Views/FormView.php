<?php


namespace Themosis\ThemosisExtended\Views;


use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Themosis\Forms\Form;

/**
 * Class FormView
 * @package Themosis\ThemosisExtended\Views
 */
class FormView extends BaseAdminView
{
    /**
     * @param Form $form
     * @return Factory|\Illuminate\View\Factory|View
     */
    public function render( $form ) {
        return view( 'admin.form', ['header' => $this->header, 'form' => $form, 'sidebar' => $this->sidebar] );
    }
}