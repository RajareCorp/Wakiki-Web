<form action="" method="post" class="realtimeForm">
    @csrf
    <h3>Wakiki</h3>
    <div class = "player">        
        <input type="text" value="Nom du joueur" disabled>

        <input type="text" value="Dégat" disabled>

        <input type="text" value="Soin" disabled>

        <input type="text" value="Armure" disabled>

        <input type="text" value="nbCC" style="width:3%" disabled>
        <input type="text" value="nbParade"style=" width: 3%" disabled>

        <div class="relative">
            <input type="text" style="width: 100%" value="Dernier sort"  id="console" disabled>
        </div>
    </div>
    <hr>
    @foreach ($players as $player)
    <div class = "player">        
        <input type="text" value="{{$player->nom}}" disabled>

        <input type="text" value="{{$player->degat}}" style="background-color:red" disabled>

        <input type="text" value="{{$player->soin}}" style="background-color:darkcyan" disabled>

        <input type="text" value="{{$player->armure}}" style="background-color:darkgreen" disabled>

        <input type="text" value="{{$player->nbCC}}" style="background-color:darkred; width:3%" disabled>
        <input type="text" value="{{$player->nbParade}}"style="background-color:darkgray; width: 3%" disabled>

        <div class="relative">
            @if(isset($histoLastSort[$player->id]))
                <span class="imageSort">
                @if(file_exists('images/spells/'.$histoLastSort[$player->id]->nom.'.png'))<img src='../images/spells/{{$histoLastSort[$player->id]->nom}}.png'/> 
                @else
                <img src='../images/spells/default.png'/> 
                @endif
                </span>
                <input type="text" style="width: 100%" value="{{$histoLastSort[$player->id]->nom}} @if ($histoLastSort[$player->id]->isSoinArmure)+@endif{{$histoLastSort[$player->id]->degat}}"  id="console"
                class="
                @if($histoLastSort[$player->id]->isCrit) critique @endif
                @if($histoLastSort[$player->id]->isParade) parade  @endif
                @if($histoLastSort[$player->id]->isLumiere) lumiere  @endif
                @if($histoLastSort[$player->id]->isStasis) stasis  @endif
                @if($histoLastSort[$player->id]->element == 'Feu') feu @endif
                @if($histoLastSort[$player->id]->element == 'Eau') eau @endif
                @if($histoLastSort[$player->id]->element == 'Terre') terre @endif
                @if($histoLastSort[$player->id]->element == 'Air') air @endif
                " disabled><?php echo($histoLastSort[$player->id]->effet) ?>
            @endif
        </div>

    </div>
    @endforeach
</form>

<div style="display:flex;">
    <form action="/" method="get" class="button-align">
        <input value="{{$logPath}}" name="setlog" type=hidden>
        <button>Détail</button>
    </form>

    <form action="/log" method="get" class="button-align">
        <button>Log</button>
    </form>

    <form action="/resetLog" method="post" class="button-align">
        @csrf
        <input value="{{$logPath}}" name="reset" type=hidden>
        <button>Reset</button>
    </form>  
</div>
