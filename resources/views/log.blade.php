<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <meta http-equiv="refresh" content="3"> -->

        <title>Wakiki - By Rajare</title>
        <link rel="icon" href="wakiki_cube.ico">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="../css/style.css" rel="stylesheet" />

    </head>
    <body class="antialiased">
    <form class="console-log">
        <div class="scroll-log">
            @for ($i = 0; $i < $total; $i++) 
            @php
                $ligne = fgets($log);
            @endphp
                @if(strpos($ligne, "[Information (jeu)]") !== false)
                    <div class="relative">
                    <input type="text" value="{{$ligne}}" disabled>
                    </div>
                @endif
            @endfor
        </div>
    </form>

    <form action="/" method="get" class="reset">
        <button>Détail</button>
    </form>
    <form action="/realtime" method="post" class="reset">
        @csrf
        <input value="{{$logPath}}" name="setlog" type=hidden>
        <button>Realtime</button>
    </form>
        
    <form action="/resetLog" method="post" class="reset">
        @csrf
        <input value="{{$logPath}}" name="reset" type=hidden>
        <button>Reset</button>
    </form>

    </body>
</html>
