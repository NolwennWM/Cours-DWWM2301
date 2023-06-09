<?php 
if(session_status() === PHP_SESSION_NONE) session_start();

/**
 * Redirige l'utilisateur si il n'est pas connecté.
 * 
 * Si $logged est passé à "false" alors redirige l'utilisateur si il est connecté.
 *
 * @param boolean $logged
 * @param string $redirect
 * @return void
 */
function shouldBeLogged(bool $logged = true, string $redirect = "/"): void
{
    if($logged)
    {
        // Si je n'ai pas la propriété expire ou si elle est inferieur au timestamp actuel, je détruit la session.
        if(!isset($_SESSION["expire"]) || time() > $_SESSION["expire"])
        {
            unset($_SESSION);
            session_destroy();
            setcookie("PHPSESSID", "", time()-3600);
        }
        // si l'utilisateur n'est pas connecté, je le redirige.
        if(!isset($_SESSION["logged"]) || $_SESSION["logged"] !== true)
        {
            header("Location: $redirect");
            exit;
        }
    }
    else
    {
        // Si l'utilisateur est connecté, je le redirige
        if(isset($_SESSION["logged"]) && $_SESSION["logged"] === true)
        {
            header("Location: $redirect");
            exit;
        }
    }
}
?>