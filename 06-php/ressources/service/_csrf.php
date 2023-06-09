<?php 
if(session_status() === PHP_SESSION_NONE) session_start();

/**
 * Paramètre un token en session et ajoute un input:hidden contenant le token.
 * 
 * Optionnellement ajoute un temps de vie au jeton.
 *
 * @param integer $time
 * @return void
 */
function setCSRF(int $time = 0): void
{
    // si $time est plus grand que 0, on ajoute un temps avant expiration :
    if($time > 0)
        $_SESSION["tokenExpire"] = time() + 60 * $time;
    
    /* 
        * On génère un token aléatoire :
        random_bytes va retourner un nombre de caractère aléatoire dépendant de son paramètre.
        Ici on lui demande 50 octets de caractères.
        bin2hex convertit des données binaire en hexadecimal.

        random_bytes peut sortir des caractères qui ne sont pas géré partout, donc les convertir permet d'avoir quelque chose géré en tout cas.
    */
    $token = bin2hex(random_bytes(50));
    $_SESSION["token"] = $token;
    // j'affiche un input:hidden contenant le jeton.
    echo "<input type='hidden' name='token' value='$token'>";
}

/**
 * Vérifie si le jeton est toujours valide.
 *
 * @return boolean
 */
function isCSRFValid(): bool
{
    // Si il n'y a pas de temps d'expiration, ou que le jeton n'est pas expiré :
    if(!isset($_SESSION["tokenExpire"]) || $_SESSION["tokenExpire"] > time())
    {
        // Si le jeton existe et qu'il a été transmit au formulaire, est ce qu'ils sont égaux.
        if(isset($_SESSION["token"], $_POST["token"]) && $_SESSION["token"] === $_POST["token"])
        {
            return true;
        }
    }
    header($_SERVER["SERVER_PROTOCOL"]. " 405 Method Not Allowed");
    return false;
}
/* 
    Ce fichier étant sensé être importé dans tous formulaires sécurisés.
    Je peux me permettre d'y ajouter une fonction que je réutiliserais pour me protéger des attaques XSS :
*/
/**
 * Sanitize a string
 *
 * @param string $data
 * @return string
 */
function cleanData(string $data): string
{
    // return htmlspecialchars(stripslashes(trim($data)));
    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data);
}
?>