<div class="notice notice-{{$type}} alert alert--{{ $type }}">
    @if($title)
        <h3 class="notice__heading">
            {!! $title !!}
        </h3>
    @endif

    <div class="notice__body">
        {!! $message !!}

    </div>
</div>