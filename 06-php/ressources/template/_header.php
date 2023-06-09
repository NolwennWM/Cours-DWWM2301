<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- J'affiche ma variable $title si elle existe, 
    sinon je n'affiche rien. -->
    <title>Cours PHP - <?php echo $title??"" ?></title>
    <!-- 
        Notre chemin relatif classique, ne fonctionne pas. 
    -->
    <!-- <link rel="stylesheet" href="../style/style.css"> -->
    <!-- 
        Pour qu'un chemin relatif fonctionne, il ne faut pas partir du fichier inclu, 
        mais du fichier dans lequel on inclu.
        C'est à dire que dans notre cas, le chemin se fait en partant du fichier "05-include.php"
    -->
    <!-- <link rel="stylesheet" href="../ressources/style/style.css"> -->
    <!-- 
        Mais le plus pratique reste de faire un chemin absolu
        Il fonctionnera peu importe où notre fichier est inclu
    -->
    <link rel="stylesheet" href="/ressources/style/style.css">
</head>
<body>
    <header>
        <h1><?php echo $title??"Cours PHP"  ?></h1>
    </header>
    <main class="<?php echo $mainClass ?? "" ?>">
