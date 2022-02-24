Add-Type -Assembly "System.IO.Compression.FileSystem" ;
$currentPath = pwd
if(Test-Path "$($currentPath.Path)\com_teama.zip")
{
    Remove-Item "$($currentPath.Path)\com_teama.zip"
}
.\7za.exe a com_teama.zip .\com_teama\*

if(Test-Path ".\tmpl_teama.zip")
{
    Remove-Item ".\tmpl_teama.zip"
}
.\7za.exe a tmpl_teama.zip .\tmpl_teama\*
