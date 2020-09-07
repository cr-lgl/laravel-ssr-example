@php
    $ssr = ssr('js/server.js')->enabled()
        ->context(['url' => request()->path()])
        ->fallback('<div id="app"></div>')
        ->render();
@endphp

<!DOCTYPE html>
<html {!! $ssr['vueMeta']['htmlAttrs'] !!}>
    <head {!! $ssr['vueMeta']['headAttrs'] !!}>
        {!! $ssr['vueMeta']['head'] !!}
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body {!! $ssr['vueMeta']['bodyAttrs'] !!}>
        {!! $ssr['vueMeta']['bodyPrepend'] !!}

        {!! $ssr['html'] !!}

        <script defer async src="{{ mix('js/client.js') }}"></script>
        {!! $ssr['vueMeta']['bodyAppend'] !!}
    </body>
</html>
