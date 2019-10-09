<input class="form-check-input" type="checkbox" name="{{ $__field->getName() }}" {!! $__field->attributes($__field->getAttributes()) !!}>
<label class="form-check-label" {!! $__field->attributes($__field->getOption('label_attr')) !!}>{!! $__field->getOption('label') !!}</label>
@include($__field->getTheme().'.types.includes.info', ['field' => $__field])
@include($__field->getTheme().'.types.includes.errors', ['field' => $__field])