<div id="wrap" style="display: flex; padding-top: 30px;">
    <ul style="width: 100px; margin-top: 50px;">
        @foreach($files as $file)
            @php
                $fileName = $file->getBaseName('.md');
                $page_args = ['page' => 'themosis_extended_documentation'];

                if($fileName !== 'index') {
                    $page_args['topic'] = $fileName;
                }

                if($fileName == 'index') {
                        $fileName = 'Home';
                }
            @endphp
            <li><a style="font-size: 16px; font-weight: normal;" href="{{ add_query_arg($page_args,admin_url('admin.php')) }}">{!! \Illuminate\Support\Str::studly($fileName) !!}</a></li>
        @endforeach
    </ul>

    <div style="flex: 1; padding-left: 30px;">
        {!! $content !!}
    </div>
</div>
