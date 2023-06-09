<?php 

/* 
    "refresh:" permet de réactualiser la page au bout de quelques secondes.

    Si on y ajoute "url=" séparé par un ";"
    Nous obtiendrons une redirection au bout de quelques secondes.
*/
header("refresh:5; url=09-a-header.php");
/* 
    On peut préciser à l'entête plein d'autres informations comme :
        - Content-Type : indique le type de contenu (text/html, text/plain, ...)
        - les méthodes acceptés : "POST, GET..."

    On peut aussi ajouter un boolean en second paramètre pour indiquer si le nouveau header doit s'ajouter ou remplacer l'ancien.
*/

$title = " Header page 2";
require "../ressources/template/_header.php"
?>
<h1>Bienvenue sur la page 2... Temporairement.</h1>
<?php 
require "../ressources/template/_footer.php";
?>