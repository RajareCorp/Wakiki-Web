<?php
function ResetLog($log)
{
    $fichier = fopen($log, 'w');
    fclose($fichier);
}
    
?>