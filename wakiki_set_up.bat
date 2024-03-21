@echo off
setlocal

for /f "tokens=*" %%A in ('where php') do set PHPLocation=%%~dpA
if "%PHPLocation%"=="" (
    echo PHP n'est pas installe sur ce systeme.
	pause
	goto end
) else (
    echo PHP est installe a l'emplacement : %PHPLocation%
)

rem Récupération de l'emplacement de Composer
for /f "tokens=*" %%A in ('where composer') do set ComposerLocation=%%A
if "%ComposerLocation%"=="" (
    echo Composer n'est pas installe sur ce systeme.
    pause
	goto end
) else (
    echo Composer est installe a l'emplacement : %ComposerLocation%
)

rem Verification de la presence du fichier php.ini
if exist "%PHPLocation%\php.ini" (
    echo Le fichier php.ini est present dans : %PHPLocation%
) else (
    echo Le fichier php.ini n'est pas present dans : %PHPLocation%
	rem Copie du fichier php.ini-development en php.ini
    copy "%PHPLocation%php.ini-development" "%PHPLocation%php.ini" > nul
	if exist "%PHPLocation%\php.ini" (
		echo Le fichier php.ini a ete cree a partir de php.ini-development.
	) else (
		echo Le fichier php.ini n'a pas pu etre cree a partir de php.ini-development.
		pause
		goto end
	)
)

copy .env.example .env
php artisan migrate

rem Chemin du fichier cible
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

echo Tout semble en ordre !
pause
:end