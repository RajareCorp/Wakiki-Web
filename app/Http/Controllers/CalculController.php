<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Sort;
use App\Models\histoEffet;
use App\Models\histoSort;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CalculController extends Controller
{

    static function Calcul($Players,$log){
    
    Sort::truncate();
    histoSort::truncate();
    histoEffet::truncate();
    $fichier = fopen($log, 'rb');
    $total = count(file($log));

    //On parcours le fichier ligne par ligne
    for($i = 0; $i < $total; $i++) {
        $ligne = fgets($fichier);
        //On verifie que c'est bien une ligne de combat
        if(strpos($ligne, "[Information (jeu)]") !== false){
            $ligneSimplifier = substr($ligne, 12, strlen($ligne)); //Permet de retirer les ":"
            $debutValue = strpos($ligneSimplifier, ":")+1; //Debut de la valeur a lire, +1 car on retire l'espace apres les ":"
            
            //DATA SORT___________________________________________________________________________
            $positionMotClef = strpos($ligneSimplifier, "lance le sort");
            if($positionMotClef !== false){
                //echo $ligneSimplifier."</br>";
                $lanceur = substr($ligneSimplifier,23,strpos(substr($ligneSimplifier,23),"lance")-1); //Nom du lanceur de sort
                $sort = new Sort;
                $sort->nom = substr($ligneSimplifier,$positionMotClef+14); //Nom du sort lance

                // 2. Utiliser des tableaux associatifs pour les effets des sorts :
                $effetsSort = [
                    'protecteurRecule' => [
                        -1 => "<div class=tooltip>&#x1F5A4<span class=tooltiptext>Protecteur reculé - malus (-20% Soins réalisés)</span></div>",
                        1  => "<div class=tooltip>&#x1F496<span class=tooltiptext>Protecteur reculé - bonus (+30% Soins réalisés)</span></div>",
                    ],
                    'auContact' => [
                        -1 => "<div class=tooltip>&#x1F464<span class=tooltiptext>Au contact - malus (-10% Dommages infligés)</span></div>",
                        1  => "<div class=tooltip>&#x1F46A<span class=tooltiptext>Au contact - bonus (+15% Dommages infligés)</span></div>",
                    ],
                ];

                foreach ($Players as $entite) {
                    if($lanceur == $entite->nom){
                        foreach (['protecteurRecule', 'auContact'] as $effetType) {
                            if (isset($entite->$effetType)) {
                                $sort->effet = $effetsSort[$effetType][$entite->$effetType];
                            }
                        }
                    }
                }
                $compteurCC = 0;
                $positionMotClef = strpos($ligneSimplifier, "(Critiques)"); //detecte les cc

                if($positionMotClef !== false){
                    $sort->nom = substr($sort->nom,0,-14);
                    $compteurCC = 1;
                }else{
                    $sort->nom = substr($sort->nom,0,-2); //Retire les retours à la ligne
                }


                $sort->save();
                foreach ($Players as $entite) {
                    if($entite->nom == $lanceur){ 
                        $histo = new histoSort;
                        $histo->idSort = $sort->id;
                        $histo->idPlayer = $entite->id;
                        $histo->save();
                        $entite->nbCC += ($compteurCC == 1) ? 1 : 0;
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "attaque avec son arme.");
            if($positionMotClef !== false){
                $lanceur = substr($ligneSimplifier,23,strpos(substr($ligneSimplifier,23),"attaque")-1); //Nom du lanceur de sort
                $sort = new Sort;
                $sort->nom = "Arme";

                $compteurCC = 0;
                $positionMotClef = strpos($ligneSimplifier, "(Critiques)"); //detecte les cc
                if($positionMotClef !== false){
                    $compteurCC = 1;
                }

                $sort->save();
                foreach ($Players as $entite) {
                    if($entite->nom == $lanceur){ 
                        $histo = new histoSort;
                        $histo->idSort = $sort->id;
                        $histo->idPlayer = $entite->id;
                        $histo->save();
                        if($compteurCC == 1){
                            $entite->nbCC += 1;
                        }
                    }
                }

            }


            $sortsInfo = [
                "Coup de Grisou" => [],
                "Faisceau de Lune" => ["element" => "Terre"],
                "Halo Chatoyant" => [],
                "Lame Sanglante" => [],
                "Piège de Lacération" => [],
                "Piège de Brume" => [],
                "Piège de Silence" => [],
                "Hémorragie" => [],
                "Distorsion" => [],
                "Rouage" => [],
                "Flétrissement" => [],
                "Sablier" => [],
                "Horloge" => [],
                "Déjà vu" => [],
                "Présages violents" => [],
                "Poussées violentes" => ["nom" => "Dommages de collision"],
                "Collision régénérantes" => ["nom" => "Soin de collision"],
                "Rage" => [],
                "Séisme" => [],
                "Cicatrisation" => [],
                "Bouclier de la fin" => [],
                "Maudit" => [],
                "Précision vorace" => ["isSoinArmure" => 1],
                "Criblé" => [],
                "Balise de destruction" => [],
                "Balise de d'alignement" => [],
                "Balise de contact" => [],
                "Force sage" => [],
                "Canine" => [],
                "Baroud (Poison)" => [],
                "Cinétose" => [],
                "Placidité" => ["isSoinArmure" => 1],
                "Pacte de sang" => ["isSoinArmure" => 1],
                "Fracasseur" => ["isSoinArmure" => 1],
                "Armure brûlante" => ["isSoinArmure" => 1],
                "Pilier" => ["isSoinArmure" => 1],
                "Refus de la mort" => ["isSoinArmure" => 1],
                "Stratégie robotique" => [],
                "Roues chaudes" => [],
                "Tacticien" => [],
                "Protection stasifiée" => [],
                "Tir de distance" => [],
                "Tir de d'alignement" => [],
                "Tir de destruction" => [],
            ];

            foreach ($sortsInfo as $sortName => $sortAttributes) {
                $positionMotClef = strpos($ligneSimplifier, $sortName . ")");
                
                if ($positionMotClef !== false) {
                    $sort = new Sort;
                    $sort->nom = isset($sortAttributes['nom']) ? $sortAttributes['nom'] : $sortName;

                    // Ajouter des attributs spécifiques au sort, s'ils existent
                    foreach ($sortAttributes as $attribute => $value) {
                        if ($attribute !== 'nom') {
                            $sort->$attribute = $value;
                        }
                    }

                    $sort->save();

                    foreach ($Players as $entite) {
                        if ($entite->nom == $lanceur) {
                            $histo = new histoSort;
                            $histo->idSort = $sort->id;
                            $histo->idPlayer = $entite->id;
                            $histo->save();
                        }
                    }
                }
            }

            $positionMotClef = strpos($ligneSimplifier, "Veines de Wakfu)");
            if($positionMotClef !== false){
                $nom = $sort->nom; //Nom d'origine du sort pour correctement appliqué l'affichage
                $sort = new Sort;
                $sort->nom = "Veines de Wakfu";
                $sort->save();
                foreach ($Players as $entite) {
                    $unEffet = histoEffet::where('idPlayer', $entite->id)->orderBy('id', 'desc')->first();
                    if($unEffet == null){
                        $unEffet = new histoEffet;
                        $unEffet->effet = "null";
                    }
                    elseif($entite->nom == $lanceur && $unEffet->effet == "VeinesDeWakfu"){ 
                        $nomOrigine =$nom; //Nom d'origine du sort pour correctement appliqué l'affichage
                        $histo = new histoSort;
                        $histo->idSort = $sort->id;
                        $histo->idPlayer = $entite->id;
                        $histo->save();
                    }
                }
            }
            
            //AUTRE___________________________________________________________________________
            $positionMotClef = strpos($ligneSimplifier, "Consomme Pointe affûtée");
            if($positionMotClef !== false){
                foreach ($Players as $entite) {
                    if($entite->nom == $lanceur){ 
                        $sort->effet = "
                        <div class=tooltip>&#x1F3AF<span class=tooltiptext>Pointe affûtée</span></div>";
                        $sort->save();
                    }
                }
            }

            $positionMotClef = strpos($ligneSimplifier, "Consomme Escroquerie");
            if($positionMotClef !== false){
                foreach ($Players as $entite) {
                    if($entite->nom == $lanceur){ 
                        $sort->effet = "
                        <div class=tooltip>&#x1F52A<span class=tooltiptext>Escroquerie (Dégats +)</span></div>";
                        $sort->save();
                    }
                }
            }

            $positionMotClef = strpos($ligneSimplifier, "'Trésors'");
            if($positionMotClef !== false){
                foreach ($Players as $entite) {
                    if($entite->nom == $lanceur){ 
                        $sort->effet = "
                        <div class=tooltip>&#x1F48E<span class=tooltiptext>Trésors</span></div>";
                        $sort->save();
                    }
                }
            }

            $positionMotClef = strpos($ligneSimplifier, "sort Ougigarou");
            if($positionMotClef !== false){
                foreach ($Players as $entite) {
                    if($entite->nom == $lanceur){ 
                        $sort->effet = "
                        <div class=tooltip>&#x1F315<span class=tooltiptext>Début Ougigarou</span></div>";
                        $sort->save();
                    }
                }
            }

            $positionMotClef = strpos($ligneSimplifier, "'Ougigarou'");
            if($positionMotClef !== false){
                foreach ($Players as $entite) {
                    if($entite->nom == $lanceur){ 
                        $sort->effet = "
                        <div class=tooltip>&#x1F319<span class=tooltiptext>Fin Ougigarou</span></div>";
                        $sort->save();
                    }
                }
            }

            $positionMotClef = strpos($ligneSimplifier, "céleste - Compteur");
            if($positionMotClef !== false){
                foreach ($Players as $entite) {
                    if($entite->nom == $lanceur){ 
                        $sort->effet = "
                        <div class=tooltip>&#x1F30C<span class=tooltiptext>Portail Céleste - Compteur +1</span></div>";
                        $sort->save();
                    }
                }
            }

            $positionMotClef = strpos($ligneSimplifier, "'Don Céleste'");
            if($positionMotClef !== false){
                foreach ($Players as $entite) {
                    if($entite->nom == $lanceur){ 
                        $sort->effet = "
                        <div class=tooltip>&#x1F386<span class=tooltiptext>Don Céleste (30% Dommages infligés)</span></div>";
                        $sort->save();
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Consomme Coup Précis");
            if($positionMotClef !== false){
                foreach ($Players as $entite) {
                    if($entite->nom == $lanceur){ 
                        $sort->effet = "
                        <div class=tooltip>&#x1F3B2<span class=tooltiptext>Coup Précis (50% Dommages infligés, 1PW)</span></div>";
                        $sort->save();
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Consomme Abondance");
            if($positionMotClef !== false){
                foreach ($Players as $entite) {
                    if($entite->nom == $lanceur){ 
                        $sort->effet = "
                        <div class=tooltip>&#x1F387<span class=tooltiptext>Abondance</span></div>";
                        $sort->save();
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Initiative de l'Âme)");
            if($positionMotClef !== false){
                foreach ($Players as $entite) {
                    if($entite->nom == $lanceur){ 
                        $sort->effet = "
                        <div class=tooltip>&#x23EB<span class=tooltiptext>Initiative de l'Âme (+2PA)</span></div>";
                        $sort->save();
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Plénitude)");
            if($positionMotClef !== false){
                foreach ($Players as $entite) {
                    if($entite->nom == $lanceur){ 
                        $sort->effet = "
                        <div class=tooltip>&#x1F505<span class=tooltiptext>Plénitude (+25 Abondance)</span></div>";
                        $sort->save();
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Dynamo)");
            if($positionMotClef !== false){
                foreach ($Players as $entite) {
                    if($entite->nom == $lanceur){ 
                        $sort->effet = "
                        <div class=tooltip>&#x26A1<span class=tooltiptext>Dynamo (+1 PA)</span></div>";
                        $sort->save();
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Consomme Entaille");
            if($positionMotClef !== false){
                foreach ($Players as $entite) {
                    if($entite->nom == $lanceur){ 
                        $sort->effet = "
                        <div class=tooltip>&#x1FA78<span class=tooltiptext>Entaille (25% Dommages infligés)</span></div>";
                        $sort->save();
                    }
                }
            }

            $positionMotClef = strpos($ligneSimplifier, "Protecteur reculé - malus");
            if($positionMotClef !== false){
                foreach ($Players as $entite) {
                    if($entite->nom == $lanceur){
                        $entite->protecteurRecule = -1;
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Protecteur reculé - bonus");
            if($positionMotClef !== false){
                foreach ($Players as $entite) {
                    if($entite->nom == $lanceur){
                        $entite->protecteurRecule = 1;
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Au contact - malus");
            if($positionMotClef !== false){
                foreach ($Players as $entite) {
                    if($entite->nom == $lanceur){
                        $entite->auContact = -1;
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Au contact - bonus");
            if($positionMotClef !== false){
                foreach ($Players as $entite) {
                    if($entite->nom == $lanceur){
                        $entite->auContact = 1;
                    }
                }
            }

            //ARMURE___________________________________________________________________________
            $positionMotClef = strpos($ligneSimplifier, "Armure");
            $antiSadida = strpos($ligneSimplifier, "(Prière Sadida)");
            if($positionMotClef != false && $antiSadida == false && $sort != false){
                
                $ligneValue = substr($ligneSimplifier, $debutValue);
                $value = "";
                foreach (str_split($ligneValue) as $chiffre) {
                    if(ctype_digit($chiffre))
                        $value = $value.$chiffre;
                }

                //$entiteName = substr($ligneSimplifier, 23,$debutValue-24); //recupere le nom de l'entite
                foreach ($Players as $entite) {
                    if($entite->nom ==  $lanceur){ 
                        $entite->armure += (int)$value;

                        if($sort->degat != ""){

                            $NewSort = new Sort;
                            $NewSort->nom = $sort->nom;
                            $NewSort->degat = (int)$value;
                            $NewSort->element = $sort->element;
                            $NewSort->isSoinArmure = 1;
                            $sort = $NewSort;
                            
                            $sort->save();
                            foreach ($Players as $entite) {
                                if($entite->nom == $lanceur){ 
                                    $histo = new histoSort;
                                    $histo->idSort = $sort->id;
                                    $histo->idPlayer = $entite->id;
                                    $histo->save();
                                }
                            }
    
                        }else{
                            $sort->degat = $value;
                        }


                        $sort->effet = "<div class=tooltip>&#x1F6E1</div>";
                        if(strpos($ligneValue, "Feu") !== false){
                            $sort->element = "Feu";
                        }
                        if(strpos($ligneValue, "Eau") !== false){
                            $sort->element = "Eau";
                        }
                        if(strpos($ligneValue, "Terre") !== false){
                            $sort->element = "Terre";
                        }
                        if(strpos($ligneValue, "Air") !== false){
                            $sort->element = "Air";
                        }
                        if(strpos($ligneValue, "Lumière") !== false){
                            $sort->isLumiere = true;
                        }
                        if(strpos($ligneValue, "Stasis") !== false){
                            $sort->isStasis = true;
                        }
                        if($compteurCC == 1){
                            $sort->isCrit = true;
                        }
                        if(isset($compteurParade) && $compteurParade == 1){
                            $sort->isParade = true;
                        }
                        $sort->save();
                    }
                }
                //echo $value."</br>";
            }
            //DEGAT___________________________________________________________________________
            $positionMotClef = strpos($ligneSimplifier, "PV");
            if($positionMotClef !== false && isset($lanceur)){
                $ligneValue = substr($ligneSimplifier, $debutValue);
                $positionMotClef = strpos($ligneValue, "-");
                if($positionMotClef == 1){
                    $value = "";
                    foreach (str_split($ligneValue) as $chiffre) {
                        if(ctype_digit($chiffre))
                            $value = $value.$chiffre;
                    }
                    $compteurParade = 0;
                    $positionMotClef = strpos($ligneSimplifier, "(Parade !)"); //detecte les parades
                    if($positionMotClef !== false){
                        $compteurParade = 1;
                    }
                    foreach ($Players as $entite) { //TODO
                        $unEffet = histoEffet::where('idPlayer', $entite->id)->orderBy('id', 'desc')->first();
                        if($unEffet == null){
                            $unEffet = new histoEffet;
                            $unEffet->effet = "null";
                        }
                        if($unEffet->effet !== "RetourDeFlamme" && $unEffet->effet !== "Entaille" && $unEffet->effet !== "Toxine"){
                            if($entite->nom == $lanceur){ 
                                if($compteurParade == 1){
                                    $entite->nbParade += 1;
                                }
                                
                                $entite->degat += (int)$value;
                                
                                if($sort->degat != ""){

                                    $NewSort = new Sort;
                                    if(isset($nomOrigine)){
                                        $NewSort->nom = $nomOrigine; //TODO le bon nom
                                    }else{
                                        $NewSort->nom = $sort->nom; //TODO le bon nom
                                    }
                                    $NewSort->degat = (int)$value;
                                    $sort = $NewSort;
                                    $sort->save();
                                    foreach ($Players as $entite) {
                                        if($entite->nom == $lanceur){ 
                                            $histo = new histoSort;
                                            $histo->idSort = $sort->id;
                                            $histo->idPlayer = $entite->id;
                                            $histo->save();
                                        }
                                    }

                                }else{
                                    $sort->degat = $value;
                                    $sort->save();
                                }

                                if(strpos($ligneValue, "Feu") !== false){
                                    $sort->element = "Feu";
                                }
                                if(strpos($ligneValue, "Eau") !== false){
                                    $sort->element = "Eau";
                                }
                                if(strpos($ligneValue, "Terre") !== false){
                                    $sort->element = "Terre";
                                }
                                if(strpos($ligneValue, "Air") !== false){
                                    $sort->element = "Air";
                                }
                                if(strpos($ligneValue, "Lumière") !== false){
                                    $sort->isLumiere = true;
                                }
                                if(strpos($ligneValue, "Stasis") !== false){
                                    $sort->isStasis = true;
                                }
                                if($compteurCC == 1){
                                    $sort->isCrit = true;
                                }
                                if($compteurParade == 1){
                                    $sort->isParade = true;
                                }
                                

                                // Retour de flamme
                                if(strpos($sort->nom, "Sang pour sang") !== false){
                                    $histoEffet = new histoEffet;
                                    $histoEffet->effet = "RetourDeFlamme";
                                    $histoEffet->idPlayer = $entite->id;
                                    $histoEffet->save();
                                }

                                if(strpos($sort->nom, "Veines de Wakfu") !== false){
                                        if($unEffet->effet !== "VeinesDeWakfu" && $sort->element == null){
                                            $entite->degat -= (int)$value; //On annule le compte des dégâts
                                            $histoEffet = new histoEffet;
                                            $histoEffet->effet = "VeinesDeWakfu"; //On ajoute un effet pour qu'il compte la seconde ligne de dégat
                                            $histoEffet->idPlayer = $entite->id;
                                            $histoEffet->save();
                                        }else{
                                            $unEffet->delete();
                                        }

                                }

                                if(strpos($sort->nom, "Sang brûlant") !== false){
                                    $histoEffet = new histoEffet;
                                    $histoEffet->effet = "RetourDeFlamme";
                                    $histoEffet->idPlayer = $entite->id;
                                    $histoEffet->save();
                                }

                                if(strpos($sort->nom, "Entaille") !== false){
                                    $entite->degat -= (int)$value; //On annule le compte des dégâts
                                }

                                $sort->save();

                                if(strpos($sort->nom, "Éclair obscur") !== false){
                                    $sort = new Sort;
                                    $sort->nom = "Éclaire obscur (Rebond)";
                                    $sort->save();
                                    if($entite->nom == $lanceur){ 
                                        $histo = new histoSort;
                                        $histo->idSort = $sort->id;
                                        $histo->idPlayer = $entite->id;
                                        $histo->save();
                                    }
                                    
                                }
                               
                            }
                        }else{
                            //On supprime l'effet et on en joue pas l'action du sort
                            $unEffet->delete();
                        }
                    }
                }
                $positionMotClef = strpos($ligneValue, "+");
                if($positionMotClef == 1){
                    $value = "";
                    foreach (str_split($ligneValue) as $chiffre) {
                        if(ctype_digit($chiffre))
                            $value = $value.$chiffre;
                    }
                    foreach ($Players as $entite) {
                        
                        if($entite->nom == $lanceur){ 

                            $entite->soin += (int)$value;

                            if($sort->degat != ""){
                                $NewSort = new Sort;
                                $NewSort->nom = $sort->nom;
                                $NewSort->degat = $value;
                                $NewSort->isSoinArmure = 1;
                                $sort = $NewSort;
                                $sort->save();
                                foreach ($Players as $entite) {
                                    if($entite->nom == $lanceur){ 
                                        $histo = new histoSort;
                                        $histo->idSort = $sort->id;
                                        $histo->idPlayer = $entite->id;
                                        $histo->save();
                                    }
                                }
                            }else{
                                $sort->degat = $value;
                            }


                            if(strpos($ligneValue, "Feu") !== false){
                                $sort->element = "Feu";
                            }
                            if(strpos($ligneValue, "Eau") !== false){
                                $sort->element = "Eau";
                            }
                            if(strpos($ligneValue, "Terre") !== false){
                                $sort->element = "Terre";
                            }
                            if(strpos($ligneValue, "Air") !== false){
                                $sort->element = "Air";
                            }
                            if(strpos($ligneValue, "Lumière") !== false){
                                $sort->isLumiere = true;
                            }
                            if(strpos($ligneValue, "Stasis") !== false){
                                $sort->isStasis = true;
                            }
                            if($compteurCC == 1){
                                $sort->isCrit = true;
                            }
                            if($compteurParade == 1){
                                $sort->isParade = true;
                            }
                            $sort->save();
                        }
                    }
                }
            }
            foreach ($Players as $entite) {
                $entite->save();
            }
        }
    }
    fclose($fichier);
    return $Players;
    }

}
