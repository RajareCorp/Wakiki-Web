<?php
include 'wakiki_Calcul.php';
include 'wakiki_reset.php';
include 'wakiki_players.php';
$logPath = "log.txt";
// ''
if(getLog() !== null) {
    $logPath = getLog();
}

$obj = new entite();
$obj->nom = "";
if(isset($_POST['username'])) {
    $obj->nom = $_POST['username'];
}
$obj->armure = 0;
$obj->degat = 0;
$obj->soin = 0;
$obj->nbCC = 0;
$obj->nbParade = 0;

if(isset($_POST['username'])) {
   $data = GetValues($logPath,[$obj])[0];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <!-- Design by foolishdeveloper.com -->
    <title>Wakiki</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
</head>
<style>
    <?php 
    include "style.css";
    ?>
</style>

<script>
    // <?php 
    // include "script.js";
    // ?>
</script>

<body>
    <div class="background">
        <!-- <div class="shape"></div>
        <div class="shape"></div> -->
    </div>
<?php 
if($logPath !== "log.txt"){;
?>
    <form class="console">
        <div class=tooltip-help>&#x2754
            <span class=tooltiptext>
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
        <?php
        if(isset($_POST['username'])) {
            foreach($data->histoSort as $sort){
                echo '<div class="relative">';
                echo '<input type="text" value="'.$sort->nom.' '.$sort->degat.'"  id="console" class="';
                if($sort->isCrit){echo 'critique ';}
                if($sort->isParade){echo 'parade ';}
                if($sort->isLumiere){echo 'lumiere ';}
                if($sort->isStasis){echo 'stasis ';}
                if($sort->element == "Feu"){echo 'feu';}
                elseif($sort->element == "Eau"){echo 'eau';}
                elseif($sort->element == "Terre"){echo 'terre';}
                elseif($sort->element == "Air"){echo 'air';}
                echo '" disabled>'.$sort->effet;
                echo '</div>';
            }  
        }
        ?>
        </div>
        <?php
        if(isset($_POST['username'])) {
            echo "<label>Coup(s) Critique(s) : ".$data->nbCC."</label>";
            echo "<label class='nomargin'>Parade(s) : ".$data->nbParade."</label>";
        }
        ?>
    </form>

    <form action="wakiki_Calcul.php" method="post" class="form">
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
        <?php
            if(isset($_POST['username'])) {
                echo "<option value='".$_POST['username']."' hidden>".$_POST['username']."</option>";
            }
            getPlayers();
        ?>
        </select>

        <label for="degat">Dégats</label>
        <input type="text" value="<?php
            if(isset($_POST['username'])) {
                echo $data->degat;
            }
        ?>" id="degat" disabled>

        <label for="soin">Soins</label>
        <input type="text" value="<?php
            if(isset($_POST['username'])) {
                echo $data->soin;
            }
        ?>" id="soin" disabled>

        <label for="armure">Armures</label>
        <input type="text" value="<?php
            if(isset($_POST['username'])) {
                echo $data->armure;
            }
        ?>" id="armure" disabled>

        <button>Actualiser</button>
    </form>
    
    <form action="wakiki_reset.php" method="post" class="reset">
        <input value="Reset" name="reset" type=hidden>
        <input value=<?php if(isset($_POST['username'])) {echo "'".$_POST['username']."'";}?> name="username" type=hidden>           

        <?php
            if(isset($_POST['reset'])) {
                ResetLog($logPath);
            }
        ?>
        <button>Reset</button>
    </form>
<?php 
}else{
    echo"<div class='start'>
    </br>
    Wakiki fonctionne grâce au log de votre chat ingame.</br> 
    Pour utiliser l'application vous devez définir en bas à droite</br>
    l'emplacement du fichier : <b>wakfu_chat.log</b></br></br>

    Vous pouvez les trouvez depuis l'ankama launcher :</br>
    Options du jeu -> Répertoire du jeu -> Ouvrir le dossier des logs -> logs
    </br></br>
    </div>";
};
?>
    <div class="param">
        <form action="wakiki_players.php" method="post">
            <label for="newname">Ajouter un joueur</label>
            <input type="text" value="" name="newname" id="newname">
            <?php
                if(isset($_POST['newname'])) {
                    addPlayers($_POST['newname']);
                }
            ?>
            <button class="lil-button">Ajouter</button>      
        </form>

        <form action="wakiki_players.php" method="post">
            <label for="param">Retirer un joueur</label>
            <select name="deluser" id="deluser">
            <?php
                getPlayers();
            ?>
            </select>
            <?php
                if(isset($_POST['deluser'])) {
                    delPlayers($_POST['deluser']);
                }
            ?>
            <button class="lil-button">Supprimer</button>      
        </form>

        <form action="wakiki_players.php" method="post">
            <label for="param">Définir l'emplacement du wakfu_chat.log</label>
            <input type="text" value="" name="setlog" id="setlog">
            <?php
                if(isset($_POST['setlog'])) {
                    setLog($_POST['setlog']);
                }
            ?>
            <button class="lil-button">Valider</button>      
        </form>
    </div>

</body>
</html>
