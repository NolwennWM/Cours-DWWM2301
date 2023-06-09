<?php 
/* 
    Le header est l'entête de la requête,
    elle sera lu par le navigateur avant de traiter le fichier.
    Il faut normalement placer la fonction "header()" avant tout affichage de HTML
    Cette dernière permet de modifier l'entête du fichier.

    On pourra par exemple s'en servir pour modifier le code de status de la page.
*/
header("HTTP/1.1 404 Not Found");
/* 
    On peut aussi utiliser la fonction "http_response_code()" 
    Pour récupérer ou modifier le code de status de la page.
*/
// echo http_response_code();
/* 
    On peut aussi utiliser la fonction header pour provoquer des redirections :
    "Location:" suivi du lien (absolu ou relatif) changera le code d'état en 302 et redirigera vers la page indiqué.
*/
if(rand(0, 100) <50)
{
    header("Location: 09-b-header.php");
    exit;
    /* 
        "exit;" (ou "exit();") ou son alias "die;"
        met fin à l'execution du code en cours.
        On peut mettre entre ses parenthèses, un message à afficher.

        C'est une bonne convention de l'utiliser après une redirection, 
        pour être sûr que le code qui suis n'est pas exécuté.

        il peut aussi être utilisé pour débuguer.
    */
}

$title = " Header page 1";
require "../ressources/template/_header.php"
?>
<h1>Vous avez de la chance de pouvoir me voir</h1>
<?php 
require "../ressources/template/_footer.php";
?>