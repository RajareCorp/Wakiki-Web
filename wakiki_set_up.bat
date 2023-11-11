@echo off
copy .env.example .env
php artisan migrate
setlocal

rem Chemin du fichier cible (à remplacer par le chemin de votre fichier)
set "cible=%~dp0\wakiki.bat"

rem Nom du raccourci et emplacement du bureau
set "nomRaccourci=Wakiki"
set "bureau=%USERPROFILE%\Desktop"
set "icone=%~dp0\public\wakiki_cube.ico"

rem Créer le raccourci
echo Set oWS = WScript.CreateObject("WScript.Shell") > CreateShortcut.vbs
echo sLinkFile = "%bureau%\%nomRaccourci%.lnk" >> CreateShortcut.vbs
echo Set oLink = oWS.CreateShortcut(sLinkFile) >> CreateShortcut.vbs
echo oLink.TargetPath = "%cible%" >> CreateShortcut.vbs
echo oLink.WorkingDirectory = "%~dp0" >> CreateShortcut.vbs

rem Ajouter le code pour modifier l'icône du raccourci
echo oLink.IconLocation = "%icone%" >> CreateShortcut.vbs

rem Terminer le script vbs
echo oLink.Save >> CreateShortcut.vbs

rem Exécuter le script vbs
cscript //NoLogo CreateShortcut.vbs

rem Nettoyer le fichier vbs temporaire
del CreateShortcut.vbs

endlocal