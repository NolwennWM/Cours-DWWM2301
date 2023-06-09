<?php 
/* 
    Quelques conventions :
        1. Quand on place toute notre logique PHP dans le même fichier que notre HTML, on placera souvent celle ci en haut du fichier.
        Avant le HTML.
        2. On aura tendance à déclarer toutes nos variables que l'on va utiliser en haut de notre code,
        pour s'en souvenir et pouvoir les modifiers facilement sans recherche.
*/
# Je déclare une variable pour chaque input de mon formulaire :
$username = $food = $drink = "";
# Ainsi qu'un tableau qui contiendra nos messages d'erreur :
$error = [];
# La liste des boissons et repas selectionnable :
$foodList = ["welsh", "cannelloni", "oyakodon"];
$drinkList = ["jus de tomate", "milkshake", "limonade"];
/* 
    Dans la superglobal $_SERVER, on trouvera à la clef "REQUEST_METHOD",
    en quel method on est arrivé sur la page.
    Par défaut, lorsqu'on se déplace de page en page, on est en GET.

    Lorsque l'on veut regarder le contenu d'un formulaire soumi,
    il nous faudra vérifier deux choses, 
    Si l'on est dans la méthode du formulaire (ici GET),
    Et si celui ci a bien été soumi. (Pour cela on pourra vérifier que $_GET contient bien au moins un des champs de celui ci.)
*/
if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["meal"]))
{
    /* 
        Je vérifie la présence de chacun des champs obligatoire de mon formulaire.
        Ainsi que si ils correspondent à mes attentes.
    */
    if(empty($_GET["username"]))
    {
        $error["username"] = "Veuillez renseigner votre nom.";
    }
    else
    {
        $username = $_GET["username"];
        /* 
            Ici nous avons une faille de sécurité appelé "XSS"
            (Cross Site Scripting), si quelqu'un entre un script en nom d'utilisateur, il sera executé.

            Toute donnée ayant pour but d'être affichée à un moment ou un autre, doit être nettoyée.

            Pour cela on pourra utiliser plusieurs fonctions, qui au lieu d'être répétées, pourront être réuni en une seule :
            
            voir fonction déclaré plus bas : "cleanData()"
        */
        $username = cleanData($_GET["username"]);
        # Ensuite il me faut faire les vérifications dépendant du champ:
            # Ici je vais vérifier la taille minimum et maximum :
        if(strlen($username) < 3 ||strlen($username)>255)
        {
            $error["username"] = "Votre nom d'utilisateur n'a pas une taille adapté.";
        }
    } // fin vérification username
    # On répète ces actions pour les différents champs :
    if(empty($_GET["food"]))
    {
        $error["food"] = "Veuillez choisir un repas.";
    }
    else
    {
        $food = cleanData($_GET["food"]);
        # Je vérifie si le plat est dans la liste de mes plats:
        if(!in_array($food, $foodList))
        {
            $error["food"] = "Ce repas n'est pas dans la liste.";
        }
    }
    // Une dernière fois, pour les boissons :
    if(empty($_GET["drink"]))
    {
        $error["drink"] = "Veuillez choisir une boisson";
    }
    else
    {
        $drink = cleanData($_GET["drink"]);
        if(!in_array($drink, $drinkList))
        {
            $error["drink"] = "Cette boisson n'est pas dans la liste.";
        }
    }
}
/**
 * Nettoie le string donnée en paramètre.
 * à la fois pour la sécurité et le confort de l'utilisateur.
 *
 * @param string $data
 * @return string
 */
function cleanData(string $data): string
{
    # supprime les espaces avant et après le string.
    $data = trim($data);
    # retirer les "\" du string.
    $data = stripslashes($data);
    # Converti les caractères spéciaux en entité HTML
    return htmlspecialchars($data);
    // Exemple : "<" devient "&lt;"
}
$title = " GET ";
require "../ressources/template/_header.php";
?>
<!-- 
    L'attribut action permet d'indiquer vers quelle page, les informations doivent être envoyées.
    Si on le laisse vide ou avec un "#", il se contentera de recharger la même page.
 -->
<form action="" method="GET">
    <input type="text" placeholder="Entrez un nom" name="username">
    <!-- les span.error serviront à afficher les messages d'erreur. -->
    <span class="error"><?php echo $error["username"]??""?></span>
    <br>
    <fieldset>
        <legend>Nourriture favorite</legend>
        <input type="radio" name="food" id="welsh" value="welsh"> 
        <label for="welsh">Welsh (car vive le fromage)</label>
        <br>
        <input type="radio" name="food" id="cannelloni" value="cannelloni"> 
        <label for="cannelloni">Cannelloni (car les ravioli c'est surfait)</label>
        <br>
        <input type="radio" name="food" id="oyakodon" value="oyakodon"> 
        <label for="oyakodon">Oyakodon (car j'aime l'humour noir)</label>
        <span class="error"><?php echo $error["food"]??""?></span>
    </fieldset>
    <label for="boisson">Boisson favorite</label>
    <br>
    <select name="drink" id="boisson">
        <option value="jus de tomate">jus de tomate (je suis un vampire)</option>
        <option value="milkshake">Milkshake (aux fruits de préférence)</option>
        <option value="limonade">Limonade (J'ai besoin de sucre)</option>
    </select>
    <span class="error"><?php echo $error["drink"]??""?></span>
    <br>
    <!-- On ajoute un name au bouton submit pour pouvoir
    le vérifier en PHP -->
    <input type="submit" value="Envoyer" name="meal">
</form>
<!-- cette partie du code ne s'affichera que si il n'y a pas d'erreur et que le formulaire est soumis : -->
<?php if(empty($error) && isset($_GET["meal"])): ?>
    <h1>Meilleurs Repas :</h1>
    <p>
        <?php echo "Pour $username, le meilleur repas est \"$food\" avec \"$drink\"."; ?>
    </p>
<?php 
endif;
require "../ressources/template/_footer.php";
?>