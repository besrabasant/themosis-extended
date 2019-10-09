<?php


namespace Themosis\ThemosisExtended\Forms\Transformers;


use Themosis\Forms\Resources\Transformers\ChoiceFieldTransformer;

/**
 * Class ExtendedChoiceFieldTransformer
 * @package Themosis\ThemosisExtended\Forms\Transformers
 */
class ExtendedChoiceFieldTransformer extends ChoiceFieldTransformer
{
    /**
     * Parse field choices.
     *
     * @param array $choices
     *
     * @return array
     */
    protected function parseChoices( array $choices ) {
        $items = [];

        foreach ( $choices as $key => $value ) {
            if ( is_array( $value ) ) {
                $items[] = ['key' => $key, 'value' => $this->parseChoices( $value ), 'type' => 'group'];
            } else {
                $items[] = ['key' => $key, 'value' => $value, 'type' => 'option'];
            }
        }

        return $items;
    }
}