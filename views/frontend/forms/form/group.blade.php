@php
    /** @var \Themosis\Forms\Contracts\FieldTypeInterface  $__field */
    /** @var string  $field_type */
    /** @var string  $formgroupClasses */

        $field_type = $__field->getType();
        $formgroupClasses = \classNames([
                    'form-group' => ($field_type !== 'checkbox'),
                    'form-check' => ($field_type === 'checkbox'),
                    "form-group--{$field_type}" => ($field_type !== 'checkbox'),
                ]);
@endphp

<div class="{{ $formgroupClasses }}">
    {!! $__field->render() !!}
</div>