<?php 
$title = "Session Page 2";
require "../ressources/template/_header.php";

/* 
    Nous pouvons soit démarrer la session sur chaque page qui en a besoin.
    Soit démarrer la session sur une page qui est incluse dans tout notre site (comme le header.)

    Quoi qu'il en soit, il faut faire attention à ne pas start la session deux fois.
    Cela afficherait un message de notification.

    Pour éviter cela, on pourrait vérifier avant de faire notre session_start, quel est le status de la session.
    "session_status()" pourra être comparé au choix à trois constantes :
        - PHP_SESSION_NONE (il n'y a pas de session);
        - PHP_SESSION_DISABLED (les sessions sont désactivé)
        - PHP_SESSION_ACTIVE (il y a une session active)

    Généralement la session prend fin quand le navigateur est fermé,
    mais si on souhaite la faire perdurer plus longtemps,
    On peut lui ajouter en option "cookie_lifetime"
*/
if(session_status() === PHP_SESSION_NONE)
{
    session_start([
        // la durée de vie en seconde. (par défaut 0)
        "cookie_lifetime" => 3600
    ]);
}
/* 
    ATTENTION ! La durée de vie des cookies n'est pas très précise.
    C'est à dire que le navigateur ne vérifie pas à chaque seconde si un cookie doit être supprimé.
    Il va régulièrement faire cette vérification, mais un cookie peut durer un peu plus longtemps que sa durée de vie.

    Enfin pour accèder aux données, il suffit d'utiliser le tableau associatif "$_SESSION"
*/
// echo $_SESSION["username"] 
//     . " aime le " 
//     . $_SESSION["food"] 
//     . " et à " 
//     . $_SESSION["age"]
//     . " ans <br>";
/* 
    Si on arrive sur cette page sans être passé par la première.
    Nous auront des erreurs car la session sera vide.
    Dans le cas d'utilisation de valeur pouvant ne pas exister, 
    Il est important de vérifier leur existance :
        Pour cela on utilisera "isset()"
        Cette fonction retournera un boolean "true" si tout ses paramètres existent, et "false" dans le cas contraire.
*/
if(isset($_SESSION["username"], $_SESSION["food"],$_SESSION["age"]))
{
    echo $_SESSION["username"] 
        . " aime le " 
        . $_SESSION["food"] 
        . " et à " 
        . $_SESSION["age"]
        . " ans <br>";
}
/* 
    Pour supprimer la session totalement ou en partie.
    On pourra utiliser "unset()" sur un élément de la session.
        unset($_SESSION["age"]);
    Ou alors "session_destroy()" pour la supprimer totalement.
*/
session_destroy();
var_dump($_SESSION);
/* 
    session_destroy() supprime la session, mais pas la variable $_SESSION
    Cette dernière existera jusqu'à la fin de l'execution de ce code.
    Pour le supprimer directement, on pourra aussi l'unset.
*/
unset($_SESSION);
/* 
    Bien qu'on ai supprimé la session, il en reste une trace sur l'ordinateur de l'utilisateur.
    En effet, on n'a pas supprimé le cookie.
    Pour supprimer ce cookie, on utilise "setcookie()".
    En lui donnant une durée de vie négative :
*/
setcookie("PHPSESSID", "", time() - 3600);
?>
<hr>
<a href="./07-a-session.php">Page 1</a>
<?php 
require "../ressources/template/_footer.php";
?>