<?php

class entite
{
    public $nom;
    public $armure;
    public $degat;
    public $soin;
    public $nbCC = 0;
    public $nbParade = 0;
    public $histoSort = [];
    public $ProtecteurRecule = 0;
    public $AuContact = 0;
    public $Ougigarou;
    public $histoEffet = [];
}

class sort
{
    public $nom;
    public $degat;
    public $element;
    public $isLumiere;
    public $isStasis;
    public $isCrit;
    public $isParade;
    public $effet;
}

function GetValues($log,$entiteList)
{   
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
                $sort = new sort();
                $sort->nom = substr($ligneSimplifier,$positionMotClef+14); //Nom du sort lance

                foreach ($entiteList as $entite) {

                    if($entite->ProtecteurRecule == -1){
                    $sort->effet =  
                            "<div class=tooltip>&#x1F5A4<span class=tooltiptext>Protecteur reculé - malus (-20% Soins réalisés)</span></div>";
                    }
                    if($entite->ProtecteurRecule == 1){
                        $sort->effet =  
                                "<div class=tooltip>&#x1F496<span class=tooltiptext>Protecteur reculé - bonus (+30% Soins réalisés)</span></div>";
                        }
                    if($entite->AuContact == -1){
                        $sort->effet =  
                                "<div class=tooltip>&#x1F464<span class=tooltiptext>Au contact - malus (-10% Dommages infligés)</span></div>";
                        }
                    if($entite->AuContact == 1){
                        $sort->effet =  
                                "<div class=tooltip>&#x1F46A<span class=tooltiptext>Au contact - bonus (+15% Dommages infligés)</span></div>";
                        }
                }
                $compteurCC = 0;
                $positionMotClef = strpos($ligneSimplifier, "(Critiques)"); //detecte les cc
                if($positionMotClef !== false){
                    $sort->nom = substr($sort->nom,0,-14);
                    $compteurCC = 1;
                }

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                        if($compteurCC == 1){
                            $entite->nbCC += 1;
                        }
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "attaque avec son arme.");
            if($positionMotClef !== false){
                $lanceur = substr($ligneSimplifier,23,strpos(substr($ligneSimplifier,23),"attaque")-1); //Nom du lanceur de sort
                $sort = new sort();
                $sort->nom = "Arme";

                $compteurCC = 0;
                $positionMotClef = strpos($ligneSimplifier, "(Critiques)"); //detecte les cc
                if($positionMotClef !== false){
                    $compteurCC = 1;
                }

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                        if($compteurCC == 1){
                            $entite->nbCC += 1;
                        }
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Coup de Grisou)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Coup de Grisou";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Faisceau de Lune)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Faisceau de Lune";
                $sort->element = "Terre";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Halo Chatoyant)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Halo Chatoyant";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Lame Sanglante)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Lame Sanglante";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Piège de Lacération)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Piège de Lacération";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Piège de Brume)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Piège de Brume";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Piège de Silence)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Piège de Silence";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }

            $positionMotClef = strpos($ligneSimplifier, "Hémorragie)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Hémorragie";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Distorsion)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Distorsion";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Rouage)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Rouage";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Flétrissement)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Flétrissement";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Sablier)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Sablier";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Horloge)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Horloge";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Déjà vu)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Déjà vu";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Présages violents)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Présages violents";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Dommages de collision)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Poussées violentes";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Soin de collision)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Collision régénérantes";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Rage)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Rage";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Séisme)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Séisme";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Cicatrisation)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Cicatrisation";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Bouclier de la fin)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Bouclier de la fin";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Maudit)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Maudit";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }

            $positionMotClef = strpos($ligneSimplifier, "Précision vorace)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Précision vorace";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Criblé)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Criblé";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Balise de destruction)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Balise de destruction";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Balise de d'alignement)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Balise de d'alignement";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Balise de contact)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Balise de contact";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            
            $positionMotClef = strpos($ligneSimplifier, "Force sage)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Force sage";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            // $positionMotClef = strpos($ligneSimplifier, "Assimilation)");
            // if($positionMotClef !== false){
            //     $sort = new sort();
            //     $sort->nom = "Assimilation";

            //     foreach ($entiteList as $entite) {
            //         if($entite->nom == $lanceur){ 
            //             array_push($entite->histoSort,$sort);
            //         }
            //     }
            // }
            $positionMotClef = strpos($ligneSimplifier, "Canine)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Canine";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Baroud)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Baroud (Poison)";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            // $positionMotClef = strpos($ligneSimplifier, "Makabrano Zer)");
            // if($positionMotClef !== false){
            //     $sort = new sort();
            //     $sort->nom = "Makabrano Zer";

            //     foreach ($entiteList as $entite) {
            //         if($entite->nom == $lanceur){ 
            //             array_push($entite->histoSort,$sort);
            //         }
            //     }
            // }
            // $positionMotClef = strpos($ligneSimplifier, "Contre-attaque)");
            // if($positionMotClef !== false){
            //     $sort = new sort();
            //     $sort->nom = "Contre-attaque";

            //     foreach ($entiteList as $entite) {
            //         if($entite->nom == $lanceur){ 
            //             array_push($entite->histoSort,$sort);
            //         }
            //     }
            // }
            // $positionMotClef = strpos($ligneSimplifier, "Enflammé)");
            // if($positionMotClef !== false){
            //     $sort = new sort();
            //     $sort->nom = "Enflammé";

            //     foreach ($entiteList as $entite) {
            //         if($entite->nom == $lanceur){ 
            //             array_push($entite->histoSort,$sort);
            //         }
            //     }
            // }
            $positionMotClef = strpos($ligneSimplifier, "Cinétose)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Cinétose";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Pilier)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Pilier";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Cyanose)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Cyanose";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Stratégie robotique)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Stratégie robotique";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Roues chaudes)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Roues chaudes";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Tacticien)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Tacticien";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Protection stasifiée)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Protection stasifiée";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Tir de distance)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Tir de distance";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Tir de d'alignement)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Tir de d'alignement";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Tir de destruction)");
            if($positionMotClef !== false){
                $sort = new sort();
                $sort->nom = "Tir de destruction";

                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        array_push($entite->histoSort,$sort);
                    }
                }
            }
            
            //AUTRE___________________________________________________________________________
            $positionMotClef = strpos($ligneSimplifier, "Consomme Pointe affûtée");
            if($positionMotClef !== false){
                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        end($entite->histoSort)->effet = "
                        <div class=tooltip>&#x1F3AF<span class=tooltiptext>Pointe affûtée</span></div>";
                    }
                }
            }

            $positionMotClef = strpos($ligneSimplifier, "Consomme Escroquerie");
            if($positionMotClef !== false){
                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        end($entite->histoSort)->effet = "
                        <div class=tooltip>&#x1F52A<span class=tooltiptext>Escroquerie (Dégats +)</span></div>";
                    }
                }
            }

            $positionMotClef = strpos($ligneSimplifier, "'Trésors'");
            if($positionMotClef !== false){
                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        end($entite->histoSort)->effet = "
                        <div class=tooltip>&#x1F48E<span class=tooltiptext>Trésors</span></div>";
                    }
                }
            }

            $positionMotClef = strpos($ligneSimplifier, "sort Ougigarou");
            if($positionMotClef !== false){
                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        end($entite->histoSort)->effet = "
                        <div class=tooltip>&#x1F315<span class=tooltiptext>Début Ougigarou</span></div>";
                    }
                }
            }

            $positionMotClef = strpos($ligneSimplifier, "'Ougigarou'");
            if($positionMotClef !== false){
                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        end($entite->histoSort)->effet = "
                        <div class=tooltip>&#x1F319<span class=tooltiptext>Fin Ougigarou</span></div>";
                    }
                }
            }

            $positionMotClef = strpos($ligneSimplifier, "céleste - Compteur");
            if($positionMotClef !== false){
                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        end($entite->histoSort)->effet = "
                        <div class=tooltip>&#x1F30C<span class=tooltiptext>Portail Céleste - Compteur +1</span></div>";
                    }
                }
            }

            $positionMotClef = strpos($ligneSimplifier, "'Don Céleste'");
            if($positionMotClef !== false){
                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        end($entite->histoSort)->effet = "
                        <div class=tooltip>&#x1F386<span class=tooltiptext>Don Céleste (30% Dommages infligés)</span></div>";
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Consomme Coup Précis");
            if($positionMotClef !== false){
                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        end($entite->histoSort)->effet = "
                        <div class=tooltip>&#x1F3B2<span class=tooltiptext>Coup Précis (50% Dommages infligés, 1PW)</span></div>";
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Consomme Abondance");
            if($positionMotClef !== false){
                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        end($entite->histoSort)->effet = "
                        <div class=tooltip>&#x1F387<span class=tooltiptext>Abondance</span></div>";
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Initiative de l'Âme)");
            if($positionMotClef !== false){
                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        end($entite->histoSort)->effet = "
                        <div class=tooltip>&#x23EB<span class=tooltiptext>Initiative de l'Âme (+2PA)</span></div>";
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Plénitude)");
            if($positionMotClef !== false){
                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        end($entite->histoSort)->effet = "
                        <div class=tooltip>&#x1F505<span class=tooltiptext>Plénitude (+25 Abondance)</span></div>";
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Dynamo)");
            if($positionMotClef !== false){
                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        end($entite->histoSort)->effet = "
                        <div class=tooltip>&#x26A1<span class=tooltiptext>Dynamo (+1 PA)</span></div>";
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Consomme Entaille");
            if($positionMotClef !== false){
                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){ 
                        end($entite->histoSort)->effet = "
                        <div class=tooltip>&#x1FA78<span class=tooltiptext>Entaille (25% Dommages infligés)</span></div>";
                    }
                }
            }

            $positionMotClef = strpos($ligneSimplifier, "Protecteur reculé - malus");
            if($positionMotClef !== false){
                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){
                        $entite->ProtecteurRecule = -1;
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Protecteur reculé - bonus");
            if($positionMotClef !== false){
                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){
                        $entite->ProtecteurRecule = 1;
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Au contact - malus");
            if($positionMotClef !== false){
                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){
                        $entite->AuContact = -1;
                    }
                }
            }
            $positionMotClef = strpos($ligneSimplifier, "Au contact - bonus");
            if($positionMotClef !== false){
                foreach ($entiteList as $entite) {
                    if($entite->nom == $lanceur){
                        $entite->AuContact = 1;
                    }
                }
            }

            //ARMURE___________________________________________________________________________
            $positionMotClef = strpos($ligneSimplifier, "Armure");
            if($positionMotClef !== false && $sort != false){
    
                $ligneValue = substr($ligneSimplifier, $debutValue);
                $value = "";
                foreach (str_split($ligneValue) as $chiffre) {
                    if(ctype_digit($chiffre))
                        $value = $value.$chiffre;
                }

                //$entiteName = substr($ligneSimplifier, 23,$debutValue-24); //recupere le nom de l'entite
                foreach ($entiteList as $entite) {
                    if($entite->nom ==  $lanceur){ 
                        $entite->armure += (int)$value;

                        if($sort->degat != ""){
                            if($sort->degat[0] == "+"){
                                $value = (int)$value + (int)substr($sort->degat,1);
                                $sort->degat = "+".(String)$value;
                            }else{
                                $NewSort = new sort();
                                $NewSort->nom = $sort->nom;
                                $NewSort->degat = "+".(String)$value;
                                $sort = $NewSort;

                                foreach ($entiteList as $entite) {
                                    if($entite->nom == $lanceur){ 
                                        array_push($entite->histoSort,$sort);
                                    }
                                }
                            }
                        }else{
                            $sort->degat = "+".$value;
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
                        if($compteurParade == 1){
                            $sort->isParade = true;
                        }
                    }
                }
                //echo $value."</br>";
            }
            //DEGAT___________________________________________________________________________
            $positionMotClef = strpos($ligneSimplifier, "PV");
            if($positionMotClef !== false){
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
                    foreach ($entiteList as $entite) {
                        if(end($entite->histoEffet) !== "RetourDeFlamme" && end($entite->histoEffet) !== "Entaille" && end($entite->histoEffet) !== "Toxine"){
                            if($entite->nom == $lanceur){ 
                                if($compteurParade == 1){
                                    $entite->nbParade += 1;
                                }
                                
                                $entite->degat += (int)$value;
                                
                                if($sort->degat != ""){
                                    if($sort->degat[0] == "-"){
                                        $value = (int)$value + (int)substr($sort->degat,1);
                                        $sort->degat = "-".(String)$value;
                                    }else{
                                        $NewSort = new sort();
                                        $NewSort->nom = $sort->nom;
                                        $NewSort->degat = "-".(String)$value;
                                        $sort = $NewSort;
    
                                        foreach ($entiteList as $entite) {
                                            if($entite->nom == $lanceur){ 
                                                array_push($entite->histoSort,$sort);
                                            }
                                        }
                                    }
                                }else{
                                    $sort->degat = "-".$value;
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

                                //Retour de flamme
                                if(strpos($sort->nom, "Sang pour sang") !== false){
                                    array_push($entite->histoEffet,"RetourDeFlamme");
                                }

                                if(strpos($sort->nom, "Sang brûlant") !== false){
                                    echo strpos($sort->nom, "Sang brûlant");
                                    array_push($entite->histoEffet,"RetourDeFlamme");
                                }

                                if(strpos($sort->nom, "Entaille") !== false){
                                    $entite->degat -= (int)$value; //On annule le compte des dégâts
                                }

                                if(strpos($sort->nom, "Éclair obscur") !== false){
                                    $sort = new sort();
                                    $sort->nom = "Éclaire obscur (Rebond)";
                                        if($entite->nom == $lanceur){ 
                                            array_push($entite->histoSort,$sort);
                                        }
                                }

                            }
                        }else{
                            //print_r($entite->histoEffet);
                            array_pop($entite->histoEffet);
                        }
                    }
                    //echo $ligneValue."</br>";
                }
                $positionMotClef = strpos($ligneValue, "+");
                if($positionMotClef == 1){
                    $value = "";
                    foreach (str_split($ligneValue) as $chiffre) {
                        if(ctype_digit($chiffre))
                            $value = $value.$chiffre;
                    }
                    foreach ($entiteList as $entite) {
                        
                        if($entite->nom == $lanceur){ 

                            $entite->soin += (int)$value;

                            if($sort->degat != ""){
                                if($sort->degat[0] == "+"){
                                    $value = (int)$value + (int)substr($sort->degat,1);
                                    $sort->degat = "+".(String)$value;
                                }else{
                                    $NewSort = new sort();
                                    $NewSort->nom = $sort->nom;
                                    $NewSort->degat = "+".(String)$value;
                                    $sort = $NewSort;

                                    foreach ($entiteList as $entite) {
                                        if($entite->nom == $lanceur){ 
                                            array_push($entite->histoSort,$sort);
                                        }
                                    }
                                }
                            }else{
                                $sort->degat = "+".$value;
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
                        }
                    }
                }
            }

        }
    }
    fclose($fichier);
    return $entiteList;
}
                //echo $ligneSimplifier."</br>";
                //echo $ligne."</br>";
//  $obj = new entite();
//  $obj->nom = "Papatte Rouge";
//  $obj->armure = 0;
//  $obj->degat = 0;
//  $obj->soin = 0;
//  $obj->nbCC = 0;
// print_r(GetValues("C:\Users\\nilso\AppData\Roaming\zaap\wakfu\logs\\wakfu_chat.log",[$obj]));
// echo $obj->histoSort[0];
//wakfu_chat
// echo "Entité : ".$obj->nom."</br>";
// echo "Armure : ".$obj->armure."</br>";
// echo "Dégats : ".$obj->degat."</br>";
// echo "Soin : ".$obj->soin."</br>";
?>