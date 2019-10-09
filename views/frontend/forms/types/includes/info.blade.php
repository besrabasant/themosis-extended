@if(! empty($info = $field->getOption('info')))
    <div class="th-description field__description">
        <small>{!! $info !!}</small>
    </div>
@endif