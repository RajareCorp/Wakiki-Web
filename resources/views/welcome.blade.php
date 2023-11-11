<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @include('head')

    </head>
    <body class="antialiased">
        @include('param')
        @include('tooltip-main')
        @include('console')

    </body>
</html>
