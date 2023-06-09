<?php 
/* 
    En tant que Developpeur Web, les principales failles de sécurité que l'on devra gérer sont :
        - XSS (cross Site Scripting);
        - CSRF (Cross Site Request Forgery);
        - Injection SQL;
        - Brute Force;
    
    Une des premières règles pour un développeur est :
    ! "Don't trust users!";

    * XSS est la plus simple à gérer,
    on l'a d'ailleurs déjà fait, 
    chaque fois qu'une information entrée par l'utilisateur doit être affiché, elle doit être nettoyée.
    Pour cela on utilise "htmlspecialchars()" ou autre équivalent.

    * Les injections SQL, 
    on en reparlera lors de la connexion à la BDD.

    * CSRF,
    Celle ci consistant à valider un formulaire via une requête envoyée par un site exterieur.
    la meilleur façon de s'en protéger est de vérifier que la requête vient bien du formulaire prévu à cet effet.
    On utilisera pour cela un jeton sauvegardé en session avec une valeur aléatoire.
    On placera un champ input:hidden dans le formulaire avec la même valeur, 
    Et lors de la vérification du formulaire, on verifiera que les deux valeurs correspondent.

    * Brute force :
    Celui ci consistant à faire de multiples et nombreuses tentatives sur un formulaire style "connexion" pour finir par trouver de bonnes valeurs.
    Il existe de nombreuses protections possibles comme :
        - bloquer la connexion pendant un certain temps après un certain nombre d'échec.
        - forcer à changer le mot de passe après un certain nombre d'échec.
        - utiliser une connexion à multiple facteur.
        - utiliser un captcha.

    Nous verrons ici comment fonctionne un captcha, 
    bien que quelque soit la solution choisie, 
    je conseille l'utilisation d'un outil professionnel.
    (captcha google ou autre...)
*/
# Une fois le fichier créé, nous pouvons l'intégrer à nos formulaire.
require "../ressources/service/_csrf.php";
$error = $password = $clearPass = "";

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['hash']))
{
    if(empty($_POST["password"]))
        $error = "Veuillez entrer un mot de passe";
    else
    {
        /* 
            $password n'ayant pas à être affiché, je n'utilise pas htmlspecialchars.
            $clearPass devant être affiché, je l'utilise.

            Pourquoi ne pas l'utiliser dans tous les cas, car htmlspecialchars pourrait modifier certains caractères et donc modifier le mot de passe.
        */
        $password = trim($_POST["password"]);
        $clearPass = htmlspecialchars($password);

        /* 
            password_hash() permet de hacher le mot de passe donnée en premier argument.

            En second argument, on va donner une constante prédéfini dans PHP entre :
                - PASSWORD_DEFAULT
                - PASSWORD_BCRYPT
                - PASSWORD_ARGON2I
                - PASSWORD_ARGON2ID
            Ce sont des constantes qui représentent différents algorythme de hachage.
            Actuellement (PHP 8.2) "PASSWORD_DEFAULT" représente "PASSWORD_BCRYPT"
            Mais si des algorithmes plus performent arrivent à l'avenir, la valeur de "PASSWORD_DEFAULT" pourrait changer.
            
            Optionnellement on peut ajouter un troisième argument pour des options de hachage.

            Un texte haché ne peut être retrouvé.
            Un texte crypté peut être décrypté.

            Un même texte haché deux fois d'affilé, n'aura pas le même hachage.
            Seule la clef de hachage au début est la même.
        */
        $password = password_hash($password, PASSWORD_DEFAULT);
    }
    # Début vérification CSRF
    if(!isCSRFValid())
        $error = "La méthode utilisée n'est pas permise !";
    # Fin vérification CSRF
    # Début vérification Captcha 
    if(!isset($_POST["captcha"], $_SESSION["captchaStr"]) || $_SESSION["captchaStr"] !== $_POST["captcha"])
        $error = "Captcha Incorrecte !";
    # Fin vérification captcha
}
$title = "Sécurité";
require "../ressources/template/_header.php";
?>
<h1>Bienvenue <?php echo $_SESSION["username"]??"" ?></h1>
<form action="" method="post">
    <input type="text" name="password" placeholder="Mot de passe à hacher :" required>
    <br>
    <!-- Début Protection CSRF -->
    <?php setCSRF(); ?>
    <!-- Fin protection CSRF -->
    <!-- Début captcha -->
    <div>
        <label for="captcha">Veuillez recopier le texte ci-dessous :</label>
        <br>
        <img src="../ressources/service/_captcha.php" alt="Captcha">
        <br>
        <input type="text" name="captcha" id="captcha" pattern="[A-Z0-9]{6}">
    </div>
    <!-- Fin captcha -->
    <input type="submit" value="Valider" name="hash">
    <span class="error"><?php echo $error??"" ?></span>
</form>
<?php if(empty($error) && !empty($password)): ?>
    <div>
        Votre mot de passe "<?php echo $clearPass ?>" haché est :
        <?php echo $password ?>
    </div>
<?php 
endif;
require "../ressources/template/_footer.php";
?>