<div class="param">
    @if(isset($logPath) and $logPath != "")
    <form action="/addPlayers" method="post">
        @csrf
        <label for="name">Ajouter un joueur</label>
        <input type="text" value="" name="name" id="name">
        <input type="text" value="{{$logPath}}" name="setlog" id="setlog" required hidden>
        <button class="lil-button">Ajouter</button>
    </form>

    <form action="/delPlayers" method="post">
        @csrf
        <label for="param">Retirer un joueur</label>
        <input type="text" value="{{$logPath}}" name="setlog" id="setlog" required hidden>
        <select name="deluser" id="deluser">
        @if (isset($players))
            @foreach ($players as $player)
                <option value="{{$player->id}}">{{$player->nom}}</option>
            @endforeach    
        @endif
        </select>
        <button class="lil-button">Supprimer</button>      
    </form>
    @endif

    <form action="/setLog" method="post">
        @csrf
        <label for="param">Définir l'emplacement du wakfu_chat.log</label>
        <input type="text" value="" name="setlog" id="setlog" required>
        <button class="lil-button">Valider</button>      
    </form>

    @if(!isset($logPath) or $logPath == '')
    <div class='start'>
        </br>
        Wakiki fonctionne grâce au log de votre chat ingame.</br> 
        Pour utiliser l'application vous devez définir en bas à droite</br>
        l'emplacement du fichier : <b>wakfu_chat.log</b></br></br>

        Vous pouvez les trouvez depuis l'ankama launcher :</br>
        Options du jeu -> Répertoire du jeu -> Ouvrir le dossier des logs -> logs
        </br></br>
    </div>
    @endif
</div>