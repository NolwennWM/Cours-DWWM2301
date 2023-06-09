<?php 
session_start();
/* 
    Une page de connexion ne devrait être accessible qu'à un utilisateur déconnecté.
    On vérifie donc si l'utilisateur est connecté, 
    et si c'est le cas, on le redirige vers une autre page.
*/
if(isset($_SESSION["logged"]) && $_SESSION["logged"] === true)
{
    header("Location: /");
    exit;
}
$email = $pass = "";
$error = [];

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['login']))
{
    // email :
    if(empty($_POST["email"]))
        $error["email"] = "Veuillez entrer un email";
    else
        $email = trim($_POST["email"]);
    // password :
    if(empty($_POST["password"]))
        $error["password"] = "Veuillez entrer un mot de passe";
    else
        $pass = trim($_POST["password"]);

    if(empty($error))
    {
        /* 
            En cas normal, c'est ici qu'on devrait récupérer les informations de la BDD.
            Dans notre cas, on va récupérer ces informations d'un fichier JSON.

            file_get_contents() permet de récupérer le contenu d'un fichier.

            sagissant de données JSON, nous allons devoir les traduire.
            Pour cela nous utiliserons :

            json_decode(),
            Il prendra en premier argument les données à traduire.
            Optionnellement en second argument il pourra prendre un boolean,
            Ce dernier permet d'obtenir les données sous forme de tableau associatif plutôt que d'objet.

            json_encode(),
            permet de transformer les données PHP en JSON.
        */
        $users = file_get_contents("../ressources/users.json");
        // var_dump($users);
        $users = json_decode($users, true);
        // echo "<hr>";
        // var_dump($users);
        /* 
            je vérifie si j'ai un utilisateur portant l'email entré dans le formulaire.
        */
        $user = $users[$email]??false;
        /* 
            Si on a trouvé un utilisateur avec cet email,
            On va pouvoir vérifier le mot de passe.
        */
        if($user)
        {
            /* 
                Si on regarde les différents mots de passe de nos utilisateurs, on remarquera qu'ils commencent tous de la même manière.
                Cela est dû au fait qu'ils ont tous été hashés avec le même algorithme.

                Ces informations vont suffires à la fonction "password_verify()" 
                pour comparer le mot de passe en clair venant du formulaire,
                au mot de passe hashé venant de nos données.
                Elle nous rendra un boolean, indiquant si le mot de passe correspond ou non.
            */
            if(password_verify($pass, $user["password"]))
            {
                /* 
                    Pour confirmer la connexion, on sauvegardera en session, une valeur comme un boolean. (ici "logged")
                */
                $_SESSION["logged"] = true;
                /* 
                    On pourra aussi sauvegarder les données que l'on souhaite réutiliser ailleurs :
                */
                $_SESSION["username"] = $user["username"];
                /* 
                    Si on souhaite limiter la durée de connexion, 
                    on pourra aussi ajouter une date limite :
                */
                $_SESSION["expire"] = time()+60*60;
                // Enfin on redirige l'utilisateur vers une autre page
                header("Location: /");
                exit;
            }
            else
                $error["login"] = "Email ou mot de passe incorrecte.";
        }
        else
            $error["login"] = "Email ou mot de passe incorrecte.";
        /* 
            ! Parlons sécurité :
            On remarquera que je met le même message d'erreur en cas de :
                Erreur sur l'email,
                Erreur sur le mot de passe.
            Cela est fait pour ne pas indiquer à un possible pirate, que l'email qu'il a rentré est bien dans notre BDD et qu'il a juste à trouver le mot de passe.
            (Pendant le développement, je conseille quand même de différencier les deux)
        */
    }
    
    
}

$title = "Connexion";
require "../ressources/template/_header.php";
?>
<form action="" method="post">
    <label for="email">Email</label>
    <input type="email" name="email" id="email">
    <br>
    <span class="error"><?php echo $error["email"]??""; ?></span>
    <br>
    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password">
    <br>
    <span class="error"><?php echo $error["password"]??""; ?></span>
    <br>
    <input type="submit" value="Connexion" name="login">
    <br>
    <span class="error"><?php echo $error["login"]??""; ?></span>
</form>
<?php 
require "../ressources/template/_footer.php";
?>