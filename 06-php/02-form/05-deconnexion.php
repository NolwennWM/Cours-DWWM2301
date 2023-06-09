<?php 
/* 
    Le fait de vérifier si un utilisateur est connecté ou déconnecté pour accèder à une page,
    est quelque chose que l'on va répéter assez souvent.

    Pour éviter d'avoir à retaper ce code à chaque fois, 
    nous pouvons créer un fichier externe que nous importerons.
    Ce genre d'outils réutilisable à plusieurs endroits de notre code peut être appelé un "service".
*/
require "../ressources/service/_shouldBeLogged.php";
shouldBeLogged(true, "04-connexion.php");

/* 
    Pour provoquer la déconnexion d'un utilisateur,
    il nous faut détruire la session,
    Ici nous utilisons la session que pour la connexion,
    Je peux donc la détruire entièrement.

    Si on utilise la session pour d'autres choses, attention de détruire seulement les informations de connexion.
*/
session_destroy();
unset($_SESSION);
setcookie("PHPSESSID", "", time()-3600);
// Une fois déconnecté, je redirige l'utilisateur ailleurs.
header("Location: 04-connexion.php");
exit;
?>