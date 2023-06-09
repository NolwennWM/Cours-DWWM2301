<?php 
/* 
    La principale différence entre GET et POST est la sécurité.
    Les informations d'un formulaire en GET sont transmise directement dans l'url.
    Les informations d'un formulaire en POST sont envoyées dans le corps de la requête.
    On utilisera plutôt le GET pour des requêtes qui peuvent être partagé, comme une recherche.
    Et ceux en POST pour des informations privées, comme un mot de passe.

    Dans le traitement de notre formulaire, les seules différences seront :
        1. l'attribut "method" du formulaire est passé à "POST"
        2. on vérifie si on arrive en méthode "POST" avant de traiter le formulaire.
        3. On récupère nos informations dans la superglobal "$_POST"

    Comme ce cours serait déjà fini si on s'arrêtait là, améliorons un peu notre formulaire :
        1. On va transformer nos tableaux en tableau associatif.
        2. faire apparaître nos options et radio avec une boucle.
        3. Ajouter une classe "formError" à certaines de nos balises.
        4. Ajouter une case à cocher pour valider le formulaire.
        5. faire que nos utilisateurs n'ai pas à remplir à nouveau les champs en cas d'erreur.
*/
$username = $food = $drink = "";
$error = [];
// Nos tableaux deviennent associatif: 
$foodList = [
    "welsh"=>"Welsh (car vive le fromage)", 
    "cannelloni"=>"Cannelloni (car les ravioli c'est surfait)", 
    "oyakodon"=>"Oyakodon (car j'aime l'humour noir)"
];
$drinkList = [
    "jus de tomate"=>"Jus de Tomate (je suis un vampire)", 
    "milkshake"=>"Milkshake (aux fruits de préférence)", 
    "limonade"=>"Limonade (j'ai besoin de sucre)"
];

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["meal"]))
{
    if(empty($_POST["username"]))
    {
        $error["username"] = "Veuillez renseigner votre nom.";
    }
    else
    {
        $username = cleanData($_POST["username"]);
        
        if(strlen($username) < 3 ||strlen($username)>255)
        {
            $error["username"] = "Votre nom d'utilisateur n'a pas une taille adapté.";
        }
    } // fin vérification username
    if(empty($_POST["food"]))
    {
        $error["food"] = "Veuillez choisir un repas.";
    }
    else
    {
        $food = cleanData($_POST["food"]);
        // Mes tableaux étant devenu associatif, je vérifie si la clef existe
        if(!array_key_exists($food, $foodList))
        {
            $error["food"] = "Ce repas n'est pas dans la liste.";
        }
    }

    if(empty($_POST["drink"]))
    {
        $error["drink"] = "Veuillez choisir une boisson";
    }
    else
    {
        $drink = cleanData($_POST["drink"]);
        if(!array_key_exists($drink, $drinkList))
        {
            $error["drink"] = "Cette boisson n'est pas dans la liste.";
        }
    }
    if(empty($_POST["cgu"]))
    {
        $error["cgu"] = "Veuillez accepter nos conditions d'utilisation";
    }
    elseif($_POST["cgu"] != "cgu")
    {
        $error["cgu"] = "Ne modifiez pas notre formulaire!";
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
    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data);
}
$title = " POST ";
require "../ressources/template/_header.php";
?>

<form action="" method="POST">
    <!-- J'ajoute sur certaines de mes balises une classe "formError" 
        en cas d'erreur sur le champ correspondant : -->
    <input 
        type="text" 
        placeholder="Entrez un nom" 
        name="username"
        value="<?php echo $username ?>"
        class="<?php echo (empty($error["username"])?"":"formError") ?>">
    <span class="error"><?php echo $error["username"]??""?></span>
    <br>
    <fieldset class="<?php echo (empty($error["food"])?"":"formError") ?>">
        <legend>Nourriture favorite</legend>
        <!-- Je parcours la liste de nourriture
        récupérant la clef dans la variable $k et la valeur dans $f -->
        <?php foreach($foodList as $k => $f): ?>
            <!-- Je me sert de la clef pour l'id, la value et le for,
            et de la valeur pour le texte du label -->
            <input 
                type="radio" 
                name="food" 
                id="<?php echo $k ?>"
                <?php echo $food === $k ? "checked":"" ?>
                value="<?php echo $k ?>"> 
            <label for="<?php echo $k ?>"><?php echo $f ?></label>
            <br>
        <?php endforeach; ?>
        <span class="error"><?php echo $error["food"]??""?></span>
    </fieldset>
    <label for="boisson">Boisson favorite</label>
    <br>
    <select 
        name="drink" 
        id="boisson"
        class="<?php echo (empty($error["drink"])?"":"formError") ?>">
        <!-- Je parcours la liste des boissons pour afficher une option par élément du tableau -->
        <?php foreach($drinkList as $k => $d): ?>
            <option 
                <?php echo $drink===$k? "selected":"" ?>
                value="<?php echo $k ?>">
                <?php echo $d ?>
            </option>
        <?php endforeach; ?>
    </select>
    <span class="error"><?php echo $error["drink"]??""?></span>
    <br>
    <!-- Ajout d'une case à cocher (style CGU) -->
    <input type="checkbox" name="cgu" id="cgu" value="cgu">
    <label for="cgu">J'accepte que mes données ne m'appartiennent plus.</label>
    <span class="error"><?php echo $error["cgu"]??"" ?></span>
    <br>
    <!-- fin ajout -->
    <input type="submit" value="Envoyer" name="meal">
</form>

<?php if(empty($error) && isset($_POST["meal"])): ?>
    <h1>Meilleurs Repas :</h1>
    <p>
        <?php echo "Pour $username, le meilleur repas est \"$food\" avec \"$drink\"."; ?>
    </p>
<?php 
endif;
require "../ressources/template/_footer.php";
?>