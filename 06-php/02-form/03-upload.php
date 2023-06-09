<?php 
/* 
    Nous allons voir comment uploader un fichier sur notre serveur.
    Même si nous n'avons pas encore accès à la BDD, il faut retenir que :
        - Nous ne sauvegardons jamais un fichier en BDD.
        - Ce que va accueillir la BDD, est juste le chemin vers le fichier.
    Notre fichier sera rangé dans un dossier de notre serveur.
*/
$error = $target_file = $target_name = $mime_type = $oldName = "";
/* 
    target_dir contient le chemin vers le dossier d'upload.
    Pour des raisons de sécurité, si les fichiers uploadé seront accessible aux utilisateurs,
    Il vaut mieux que ce dossier ne soit pas au milieu de fichier sensibles.
    Le chemin vers ce dossier étant visible de tous.
*/
$target_dir = "./upload/";
/* 
    On liste les types mimes qui seront acceptés par notre formulaire.
    Les types mimes sont plus sécurisé que les extensions qui se changent facilement.
*/
$typesPermis = ["image/png", "image/jpeg", "image/gif", "application/pdf"];

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['upload']))
{
    /* 
        Lorsqu'on upload un fichier, le serveur va le sauvegarder dans un dossier temporaire.
        Une fois le script php terminé, le serveur supprimera le contenu du dossier temporaire.

        On va donc vérifier si ce fichier correspond bien à nos attentes, avant de le sortir de cette zone temporaire.

        La première étape va être de vérifier si le fichier a bien été téléversé.
        Pour cela, on n'utilisera pas "$_POST" mais la superglobal "$_FILES".
        Cette superglobale contient tous les fichiers envoyés par notre formulaire.
        On utilisera comme pour "GET" et "POST" le nom que l'on a donné à notre input.
            On trouvera alors un nouveau tableau associatif contenant plusieurs informations comme :
                "tmp_name" qui est l'adresse temporaire du fichier.
        On utilisera "is_uploaded_file()" pour vérifier son existence.
    */
    if(!is_uploaded_file($_FILES["fichier"]["tmp_name"]))
    {
        $error = "Veuillez selectionner un fichier";
    }
    else
    {
        /* 
            On trouvera le nom d'origine du fichier, dans "name"
            Sur lequel on utilisera "basename()" pour récupérer le dernier composant du nom.

            par exemple si le nom du fichier est "categorie/nourriture/pizza.jpg"
            basename nous rendra uniquement "pizza.jpg"
        */
        $oldName = basename($_FILES["fichier"]["name"]);
        /* 
            La prochaine étape est de préparer un nouveau nom pour le fichier.
            Si deux fichiers du même nom sont téléversé, le précédent sera effacé par le nouveau.

            Il y a plein de techniques pour donner un nom unique à un fichier.
            En voici une, un petit peu excessive.

            Je vais utiliser "uniqid()" qui va générer par défaut 13 caractères aléatoires.
            (Attention, à ne pas utiliser pour de la sécurité)

            Cette fonction peut prendre deux arguments optionnels.
            Le premier est prefix qui viendra se placer devant l'id.
            le second est un boolean qui augmentera l'id à 23 caractères.
        */
        $target_name = uniqid(time()."-", true)."-$oldName";
        /* 
            On concatène le nouveau nom du fichier au chemin vers son dossier :
        */
        $target_file = $target_dir . $target_name;
        /* 
            Je récupère le type mime du fichier depuis sa zone temporaire :
        */
        $mime_type = mime_content_type($_FILES["fichier"]["tmp_name"]);
        /* 
            Je vérifie si son type mime est dans mon tableau de type mime accepté :
        */
        if(!in_array($mime_type, $typesPermis))
        {
            $error = "Ce type de fichier n'est pas accepté.";
        }
        /* 
            Je vérifie que le fichier uploadé n'existe pas déjà dans mon dossier :
        */
        if(file_exists($target_file))
        {
            $error = "Ce fichier existe déjà";
        }
        /* 
            Il faut vérifier la taille du fichier, pour éviter d'avoir des upload de plusieurs giga sur le serveur.
            On trouvera dans notre "$_FILE" la propriété "size" qui indique la taille en octet.

            Si jamais vous faites de l'upload de gros fichiers, et que votre téléversage ne fonctionne pas.
            Vérifiez la configuration de PHP dans "php.ini"
            Il y a une taille maximum d'upload ainsi que de données envoyées en POST.
        */
        if($_FILES["fichier"]["size"] > 5000000)
        {
            $error = "Ce fichier est trop gros";
        }
        if(empty($error))
        {
            /* 
                On utilise la fonction "move_uploaded_file()" pour déplacer notre fichier depuis son dossier temporaire (premier argument).
                Jusqu'à son dossier final (second argument).

                Cette fonction retourne un boolean indiquant si le déplacement s'est bien passé.
            */
            if(move_uploaded_file($_FILES["fichier"]["tmp_name"], $target_file))
            {
                /* 
                    Si tout s'est bien passé on arrivera ici et il ne nous restera plus qu'à sauvegarder le nom et/ou le chemin en BDD.
                */
            }
            else
            {
                $error = "Erreur lors du téléversage";
            }
        }
    } // fin else uploaded file
} //fin if formulaire

$title = "Upload";
require "../ressources/template/_header.php"; 
?>
<!-- 
    enctype="multipart/form-data" permet d'indiquer que des données 
    autre que textuelles seront envoyé par ce formulaire.
    Dans notre cas, un fichier.
 -->
<form action="" method="post" enctype="multipart/form-data">
    <label for="fichier">Choisir un fichier :</label>
    <input type="file" name="fichier" id="fichier">
    <input type="submit" value="Envoyer" name="upload">
    <span class="error"><?php echo $error??""; ?></span>
</form>
<!-- On affiche cette partie que si l'upload s'est bien passé : -->
<?php if(isset($_POST["upload"]) && empty($error)): ?>
    <p>
        Votre fichier a bien été téléversé sous le nom "<?php echo $target_name ?>". <br>
        Vous pouvez le télécharger <br>
        <a href="<?php echo $target_file ?>" download="<?php echo $oldname?>">ici</a>
    </p>
<?php 
endif;
require "../ressources/template/_footer.php";
?>