<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Meta description -->
    <meta name="author" content="Nolwenn WEBER-MARQUISET">
    <meta name="description" content="blog servant de fil rouge à la formation DWWM">
    <meta name="keywords" content="blog, article, dwwm,fil rouge">
    <!-- Titre et icon -->
    <title>Mon super Blog <?php echo $title??""?></title>
    <link rel="shortcut icon" href="./AFCI-LOGO.svg" type="image/svg+xml">
    <!-- CSS et JS (ajout version css) -->
    <!-- <link rel="stylesheet" href="./01-properties/style.css"> -->
    <link rel="stylesheet" href="./stagiaire.css">
    <!-- <script src="./script.js" defer></script> -->
    <!-- fin ajout -->
</head>
<body>
    <!-- En-tête du site -->
    <header class="pageHeader" id="home">
        <div class="logo">
            <a href="./">
                <img src="./AFCI-LOGO.svg" alt="Logo AFCI" loading="lazy" decoding="async" height="150">
            </a>
        </div>
        <h1 class="title"><?php echo $title??
            "Mon Super Blog" ?>
        </h1>
        <form action="https://www.google.fr/search" class="search" method="get" target="_blank">
            <input type="text" name="q" placeholder="votre recherche">
            <!-- &#x1F50D; est le code hexadecimal pour la caractère 🔍 -->
            <input type="submit" value="&#x1F50D;">
        </form>
        <hr>
    </header>