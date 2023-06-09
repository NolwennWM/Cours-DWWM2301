<?php 
session_start();

require "../ressources/service/_mailer.php";
require "../ressources/service/_csrf.php";

$email = $subject = $body = $envoi = "";
$error = [];

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['contact']))
{
    # Validation de l'email :
    if(empty($_POST['email']))
        $error["email"] = "Veuillez entrer un email";
    else
    {
        $email = cleanData($_POST["email"]);
        /* 
            filter_var permet de filtrer une variable.
            Il prendra en premier argument, la variable à filtrer.
            Et en second une constante représentant le filtre à utiliser.
            Selon le filtre utilisé filter_var retournera soit un boolean, 
            soit un string filtré.

            FILTER_VALIDATE_EMAIL permet de vérifier si la variable contient 
            un string ressemblant à un email.
        */
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            $error["email"] = "Veuillez entrer un email valide";
    }

    # vérifier le sujet :
    if(empty($_POST["sujet"]))
        $error["sujet"] = "Veuillez entrer un sujet";
    else
        $subject = cleanData($_POST["sujet"]);

    # vérifier le corps :
    if(empty($_POST["corps"]))
        $error["corps"] = "Veuillez entrer un contenu";
    else
        $body = cleanData($_POST["corps"]);

    # vérifier le captcha
    if(!isset($_POST["captcha"], $_SESSION["captchaStr"]) || $_POST["captcha"] !== $_SESSION["captchaStr"])
        $error["captcha"] = "CAPTCHA Incorrecte !";
    
    // Si tout s'est bien passé, on envoi le mail :
    if(empty($error))
    {
        $envoi = sendMail($email, "cours@nolwenn.fr", $subject, $body);
    }
}

$title = "Email";
require "../ressources/template/_header.php";
// Affiche la confirmation (ou erreur) d'envoi du mail :
if(!empty($envoi)):
?>
<p>
    <?= $envoi ?>
    <!-- équivalent à <?php echo $envoi ?> -->
</p>
<?php endif; ?>
<form action="" method="post">
    <input type="email" name="email" placeholder="Votre email">
    <span class="error"><?php echo $error["email"]??"" ?></span>
    <br>
    <input type="text" name="sujet" placeholder="Sujet de votre message">
    <span class="error"><?php echo $error["sujet"]??"" ?></span>
    <br>
    <textarea name="corps" cols="30" rows="10" placeholder="Votre message"></textarea>
    <span class="error"><?php echo $error["corps"]??"" ?></span>
    <br>
    <div>
        <label for="captcha">Veuillez recoppier le texte ci-dessous pour valider :</label>
        <br>
        <img src="../ressources/service/_captcha.php" alt="CAPTCHA">
        <br>
        <input type="text" id="captcha" name="captcha" pattern="[A-Z0-9]{6}">
    <span class="error"><?php echo $error["captcha"]??"" ?></span>
    </div>
    <input type="submit" value="Envoyer" name="contact">
</form>
<?php 
require "../ressources/template/_footer.php";
?>