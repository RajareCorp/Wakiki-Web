<?php

function addPlayers($name)
{
    $fichier = fopen('player_list.txt', 'a');
    $txt = $name."\n";
    fwrite($fichier, $txt);
    fclose($fichier);
    echo("<meta http-equiv='refresh' content='1'>");
}

function getPlayers()
{
    $fichier = fopen('player_list.txt', 'rb');
    $total = count(file('player_list.txt'));
    for($i = 0; $i < $total; $i++) {
        $player = substr(fgets($fichier),0,-1);
        echo "<option value='".$player."'>".$player."</option>";
    }
}

function delPlayers($key)
{
    $fc = file("player_list.txt");
    $fichier = fopen('player_list.txt', 'w');
    $total = count(file('player_list.txt'));
    foreach($fc as $line)
        {
            if (substr($line,0,-1)!==$key) //look for $key in each line
                fputs($fichier,$line); //place $line back in file
        }
    echo("<meta http-equiv='refresh' content='1'>");
}

function getLog()
{
    $fichier = fopen('log.txt', 'rb');      
    return fgets($fichier);
}
function setLog($path)
{
    $fichier = fopen('log.txt', 'w');
    //Si path ne contient pas wakfu_chat.log :le rajoute
    if (strpos($path, 'wakfu_chat.log') === false)
        $path = $path."\wakfu_chat.log";
    fputs($fichier,$path);
    echo("<meta http-equiv='refresh' content='1'>");
}
?>