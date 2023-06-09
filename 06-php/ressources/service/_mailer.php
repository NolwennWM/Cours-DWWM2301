<?php 
/* 
    Pour simplifier la tache de l'envoi de mail, 
    nous avons installé la "library" nommé "phpmailer"
    grâce à l'installateur de package "composer". 

    (composer require phpmailer/phpmailer)

    phpmailer utilise la programmation orienté objet.
    Pour l'utiliser nous avons besoin de lui indiquer les "namespaces" utilisés :
*/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
/* 
    On require l'autoload de composer,
    celui ci s'occupera de require automatiquement,
    les fichiers dont on aura besoin venant de nos bibliothèques.
*/
require __DIR__ . "/../../vendor/autoload.php";
/**
 * Envoi un mail
 *
 * @param string $from
 * @param string $to
 * @param string $subject
 * @param string $body
 * @return string
 */
function sendMail(string $from, string $to, string $subject, string $body):string
{
    /* 
        On crée un nouvel objet "PHPMailer"
        en lui donnant un argument "true" pour activer les "Exceptions"
    */
    $mail = new PHPMailer(true);
    try {
        /* 
            Paramètres du serveur de mail :
            Celles ci sont disponible sur votre serveur de mail

            On active l'utilisation de SMTP
            (Simple Mail Transfer Protocol)
        */
        $mail->isSMTP();
        // L'adresse du serveur de mail :
        $mail->Host = "sandbox.smtp.mailtrap.io";
        // On active l'authentification par SMTP :
        $mail->SMTPAuth = true;
        // On indique le port utilisé :
        $mail->Port = 2525;
        // On indique le nom d'utilisateur :
        $mail->Username = "1e77adf0ab1df0";
        // On indique le mot de passe :
        $mail->Password = "5779de4e98bd51";
        /* 
            SMTPDebug permet d'avoir les détails sur le déroulement de l'envoi des mails :
        */
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        /* 
            SMTPSecure indique quel type de chiffrement sera utilisé pour envoyer les mails.
            Ici je ne l'active pas, car il pose problème avec mon serveur de test
        */
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        /* 
            * Informations du Mail :

            "setFrom" pour indiquer l'expediteur
        */
        $mail->setFrom($from);
        /* 
            "addAddress" permet d'ajouter un destinataire
            (un second paramètre permet d'ajouter un nom à ce destinataire )
        */
        $mail->addAddress($to);
        /* 
            "addReplyTo" pour indiquer que c'est une réponse à...
            "addCC" pour ajouter quelqu'un en copie
            "addBCC" permet d'ajouter quelqu'un en copie cachée.

            "addAttachment($path, ?$name)" pour ajouter une pièce jointe

            "isHTML" permet d'indiquer que le format du mail sera du HTML
        */
        $mail->isHTML(true);
        // le sujet du mail :
        $mail->Subject = $subject;
        // le corps de l'email :
        $mail->Body = $body;
        /* 
            On peut aussi utiliser "AltBody" si on souhaite prévoir un body différent, 
            Pour les clients de mail ne gérant pas HTML.

            On envoi le mail:
        */
        $mail->send();
        return "message envoyé";
    }catch(Exception $e)
    {
        return "Le message n'a pas pu être envoyé. Mailer Error : {$mail->ErrorInfo}";
    }
}
?>