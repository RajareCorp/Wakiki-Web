@if(isset($logPath) and $logPath != "")
    <form action="/Wakiki" method="post" class="form">
        @csrf
        <div class=tooltip-main>&#x2754
                <span class=tooltiptext>
                    &#x1F4D7[Base]&#x1F4D7</br>
                    Nom = Entité à analyser</br>
                    Dégats = Dégats infligés</br>
                    Soins = Soins Réalisés</br>
                    Armures = Armures données</br>
                    ______</br>
                    &#x1F527[Bugs]&#x1F527</br>
                    - Sort en 2 tours</br>
                    - Passif : Prière de sadida</br>
                    ______</br>
                    &#x1F4F0[V1.0.2]&#x1F4F0</br>
                    - Liste joueur &#x1F4DC</br>
                    - Ajout joueur &#x2795</br>
                    - Suppression joueur &#x2796</br>
                    - Logo Effet &#x1F4CA</br>
                    ______</br>

                </span>
            </div>
            <h3>Wakiki</h3>
            <label for="username">Nom</label>
            <select name="username" id="username">
                @if (isset($active))
                    <option value="{{$active->id}}">{{$active->nom}}</option> 
                    @foreach ($players as $player)
                        @if($player->id != $active->id)
                            <option value="{{$player->id}}">{{$player->nom}}</option>
                        @endif
                    @endforeach       
                @else
                    @foreach ($players as $player)
                        <option value="{{$player->id}}">{{$player->nom}}</option>
                    @endforeach
                @endif
 
            </select>

            <label for="degat">Dégats</label>
            <input type="text" value="@if (isset($active)) {{$active->degat}} @endif" id="degat" disabled>

            <label for="soin">Soins</label>
            <input type="text" value="@if (isset($active)) {{$active->soin}} @endif" id="soin" disabled>

            <label for="armure">Armures</label>
            <input type="text" value="@if (isset($active)) {{$active->armure}} @endif" id="armure" disabled>

            <input value="{{$logPath}}" name="setlog" type=hidden>
            <button>Actualiser</button>
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

    <form action="/log" method="get" class="reset">
        <button>Log</button>
    </form>

@endif