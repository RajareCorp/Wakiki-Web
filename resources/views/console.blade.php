<form class="console">
        <div class="tooltip-help">&#x2754
            <span class="tooltiptext">
                [Elements]</br>
                &#x1F534 = Feu</br>
                &#x1F535 = Eau</br>
                &#x1F7E2 = Terre</br>
                &#x1F7E3 = Air</br>
                ______</br>
                [Elements 2]</br>
                &#x1F7EA = Stasis</br>
                &#x1F7E8 = Lumière</br>
                ______</br>
                [Autres]</br>
                <span class="critique">Gras</span> = Critique</br>
                <span class="parade">Points</span> = Parade</br>
                &#x1F6E1 = Armure</br>
                ______</br>
            </span>
        </div>
        <label for="console">Console</label>
        <div class="scroll">
        @if(isset($sorts))
            @foreach($sorts as $sort)
                <div class="relative">
                <span class="imageSort">
                @if(file_exists('images/spells/'.$sort->sort->nom.'.png'))<img src='../images/spells/{{$sort->sort->nom}}.png'/> 
                @else
                <img src='../images/spells/default.png'/> 
                @endif
                </span>
                <input type="text" value="{{$sort->sort->nom}} @if ($sort->sort->isSoinArmure)+@endif{{$sort->sort->degat}}"  id="console"
                class="
                @if($sort->sort->isCrit) critique @endif
                @if($sort->sort->isParade) parade  @endif
                @if($sort->sort->isLumiere) lumiere  @endif
                @if($sort->sort->isStasis) stasis  @endif
                @if($sort->sort->element == 'Feu') feu @endif
                @if($sort->sort->element == 'Eau') eau @endif
                @if($sort->sort->element == 'Terre') terre @endif
                @if($sort->sort->element == 'Air') air @endif
                " disabled><?php echo($sort->sort->effet) ?>
               </div>
            @endforeach
        @endif
        </div>
        @if(isset($active))
            <label>Coup(s) Critique(s) : {{$active->nbCC}}</label>;
            <label class='nomargin'>Parade(s) : {{$active->nbParade}}</label>";
        @endif
</form>