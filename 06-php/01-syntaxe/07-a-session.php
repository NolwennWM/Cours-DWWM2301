<?php 
$title = "Session Page 1";
require "../ressources/template/_header.php";
/* 
    Les sessions permettent de sauvegarder des informations temporaire.
    (Comme le localStorage/sessionStorage en JS)
    La différence est dans le fait que les sessions sont sauvegardé côté serveur.
    Chaque session se voit attribué un ID. 
    Et cet ID est sauvegardé dans un cookie.
    Les cookies étant partagé entre le serveur et l'utilisateur à chaque requête au serveur. 
    On peut vérifier quel ID il contient et retrouver la session correspondante.

    Les sessions n'existent pas avant l'utilisation de la fonction :
    "session_start()"
    Celle ci tentera de trouver une session existante, et dans le cas contraire, en créera une.
*/
session_start();
/* 
    Par défaut, le nom du cookie est "PHPSESSID"
    On peut modifier ce nom en utilisant avant de "start", la fonction :
        "session_name(string $name)"
    
    Si on en avait besoin, on pourrait récupérer l'id de la session avec :
        - La superglobal $_COOKIE
        - La fonction "session_id()"
*/
var_dump($_COOKIE, session_id());
/* 
    Enfin, pour sauvegarder des données en session, 
    On utilisera la superglobal $_SESSION qui est un tableau associatif.
    À noter que cette superglobal est accessible uniquement si la session a été démarré.
*/
$_SESSION["food"] = "Paprika";
$_SESSION["age"] = 54;
$_SESSION["username"] = "Maurice";
/* 
    Autre différence avec les storages de JS
    en JS on ne pouvait stocker que des strings.
    En PHP on peut stocker absolument n'importe quoi.
*/
?>
<hr>
<a href="./07-b-session.php">Page 2</a>
<?php 
require "../ressources/template/_footer.php";
?>