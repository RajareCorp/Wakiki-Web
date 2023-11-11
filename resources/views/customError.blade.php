<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Wakiki - By Rajare</title>
        <link rel="icon" href="wakiki_cube_error.ico">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="../css/error.css" rel="stylesheet" />

    </head>
    <body class="antialiased">

    <div class="error-container">
        <div class="text-container">
            <h1 class="text-2xl font-semibold error mb-2">Wakiki a planté... @if (isset($status))Code : {{$status}}@endif</h1>
            <p class="error"> Vous avez du taper comme un fouirox !<br>
                Il semble y avoir un problème.<br>
                Vous pouvez reset vos logs pour reprendre à zéro<br>
                ou bien vous pouvez contacter le développeur pour lui<br>
                signaler le problème ici : <a href="https://discord.gg/KyVd3azBn6">https://discord.gg/KyVd3azBn6</a>
            </p>        
        <form action="/resetLog" method="post" class="reset">
        @csrf
        <input value="" name="reset" type=hidden>
        <button>Reset</button>
        </form>
        </div>
        <img src="images/blerox.png" alt="Erreur" class="img-error">
    </div>

    </body>
</html>