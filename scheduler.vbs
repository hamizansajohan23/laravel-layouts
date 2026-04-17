Set WshShell = CreateObject("WScript.Shell")
WshShell.Run "cmd /c cd /d ""c:\laragon\www\laravel-layouts"" && php artisan schedule:run", 0, False
Set WshShell = Nothing
