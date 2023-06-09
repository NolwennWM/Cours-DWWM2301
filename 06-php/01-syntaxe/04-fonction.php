<?php 
echo "<h1>Déclaration des fonctions</h1><hr>";

/* 
    Pour déclarer une fonction, on utilisera le mot clef "function"
    suivi du nom de la fonction (le nom suis les même règles que les variables)
    suivi de parenthèses qui accueilleront les possibles arguments
    Et enfin les accolades qui contiendront le corps de la fonction.
*/
function salut()
{
    echo "Salut tout le monde ! <br>";
}
// La fonction peut être appelé avant ou après sa déclaration.
salut();
// Si une fonction est déclaré dans une condition, elle ne pourra être appelé qu'après sa déclaration

if (true)
{
    function salut2()
    {
        echo "Salut moi-même ! <br>";
    }
    salut2();
}
// Si vous faites cela, soyez sûr que votre fonction a bien été déclaré:
salut2();

/* 
    Une fonction peut se contenter de réaliser des actions, 
    Mais elle peut aussi retourner une information qui sera utilisée ailleur.
    Pour cela on utilisera le mot clef "return" suivi de la valeur à renvoyer.
    On peut aussi utiliser "return" avec rien d'autre, simplement pour mettre fin à la fonction.
*/
function aleaString()
{
    $r = rand(0, 100);
    // Si r est plus petit que 50, on ne retourne rien.
    if ($r < 50) return;
    // Sinon je retourne le chiffre sous forme de string.
    return (string)$r;
}
// On peut utiliser la valeur de retour directement dans une autre fonction :
echo aleaString(), "<br>";
// Ou l'attribuer à une variable :
$alea = aleaString();
echo $alea, "<br>";

#------------------------- Arguments ------------------------
echo "<h1>Arguments</h1><hr>";

/* 
    Entre les parenthèses de notre fonction, nous pouvons avoir de 0 à 
    l'infini arguments.
    Ces arguments seront représenté par des variables séparés de virgules.
    Quand on appelle une fonction, on mettra entre ses parenthèses, autant de valeurs qu'il y a d'argument.
    Ces valeurs seront transmises aux variables de la fonction.
*/
function bonjour($nom)
{
    echo "Bonjour $nom ! <br>";
}
bonjour("Maurice");
/* 
    Si on ne met pas assez d'arguments, il enclenchera une fatal error.
    Si il y en a trop, ils seront ignorés.
*/
// bonjour();
bonjour("Pierre", "Paul");

// il est aussi possible d'avoir une fonction avec un nombre infini d'argument.
function bonjour2(...$noms)
{
    // avec le rest operator (...), la variable devient égale à un tableau contenant tous les arguments.
    foreach($noms as $n)
    {
        echo "Salut $n ! <br>";
    }
}
bonjour2("Pierre", "Paul", "Jack");

// On peut rendre des arguments optionnels en leur donnant une valeur par défaut :
function bonjour3($nom1, $nom2 = "personne d'autre")
{
    echo "Bonjour $nom1 et $nom2 ! <br>";
}
bonjour3("Maurice");
bonjour3("Maurice", "Pierre");
/* 
    Par défaut, si on passe une variable à une fonction,
    C'est seulement la valeur de la variable qui est transmise.
    Toute modification de cette valeur, n'influera pas sur la variable d'origine.

    Mais si l'on vient placer devant notre argument un "&"
    Alors nous passons l'argument par référence.
    Il ne contient plus la valeur, mais le chemin vers la variable.
    Toute modification faite à notre argument, se répercutera sur notre variable.
*/
function titre(&$nom)
{
    $nom .= " le grand";
}
$maurice = "Maurice";
titre($maurice);
echo "Voici $maurice ! <br>";

// --------------------------- recurcivité --------------------
echo "<h1>Fonction récurcive</h1><hr>";

/* 
    Une fonction récurcive est une fonction qui s'appelle elle même.
    De ce fait, il faut faire attention et prévoir une façon de sortir 
    de la récurcivité.
*/
function decompte($n)
{
    // Action à réaliser
    echo $n, "<br>";
    // Condition de sortie
    if ($n <= 0) return;
    // récurcivité
    decompte(--$n);
}
decompte(5);
// ----------------- Typage et Description --------------------
echo "<h1>Typage et Description</h1><hr>";

/* 
    Sur les dernières versions de PHP, il est possible, conseillé bien que non obligatoire,
    de typer ses arguments et valeur de retour, ainsi que de décrire ses fonctions.

    Faire ceci ne va pas changer le fonctionnnement de votre code 
    mais permettra de s'y retrouver plus facilement si vous y revenez plus tard ou si vous le partager.
*/
/**
 * Cette fonction retourne la présentation du personnage
 * 
 * Les arguments doivent être le nom de l'utilisateur, l'âge et un boolean
 * indiquant si il travail ou non.
 *
 * @param string $nom
 * @param integer $age
 * @param boolean $travail
 * @return string
 */
function presentation(string $nom, int $age, bool $travail): string
{
    /* 
        Le typage des arguments se fait en indiquant le type avant le nom de celui ci.
        le typage de la valeur de retour, s'indique en ajoutant après la parenthèse ":" suivi du type voulu.
    */
    return "Je m'appelle $nom et j'ai $age ans. Je "
        . ($travail?"travaille":"ne travaille pas");
}
echo presentation("Maurice",54, false);

// ----------------- Portée des variables et static ---------------
echo "<h1>Portée des variables et static</h1><hr>";
// Une variable déclaré hors d'une fonction, ne sera pas accessible dans celle ci.
$z = 5;

function showZ()
{
    // $z est déclaré au niveau global et non dans la fonction
    // echo $z;
    // Le mot clef "global" permet l'utilisation d'une variable global.
    global $z;
    echo $z;
}

/* 
    Normalement, une variable dans une fonction est détruite une fois la fonction terminée.
    Le mot clef "static" permet de sauvegarder et de ne pas réinitialiser une variable.
*/
function compte()
{
    $a = 0;
    static $b = 0;
    echo "a: $a <br> b: $b <br>";
    $a++;
    $b++;
}
compte();
compte();
compte();
// ----------------- fonctions anonyme,fléchée et callback ---------
echo "<h1>Fonctions anonyme, fléchée et callback</h1><hr>";
/* 
    à la différence de javascript, les fonctions anonyme, fléchée et les callback sont beaucoup plus rarement utilisé en PHP.
    Une fonction anonyme est une fonction qui ne porte pas de nom.
    Elle est soit rangée dans une variable, soit utilisé en callback d'une autre fonction.

    Un callback est une fonction donnée en argument d'une autre fonction.

    Une fonction fléchée est une version raccourcie de la fonction anonyme.
*/
function dump(array $arr, callable $func): void
{
    foreach($arr as $a)
    {
        $func($a);
        echo "<br>";
    }
}
$arr = ['Sandwich', 'Ramen', 'Pizza'];

// Je donne une fonction anonyme en callback de ma fonction dump;
dump($arr, function($x){ echo $x;});
// Je donne une fonction fléchée en callback de ma fonction dump;
dump($arr, fn($x)=>var_dump($x));

// Je range ma fonction anonyme dans une variable :
$superFonction = function($x){print($x);};
// Je donne ma variable en callback de ma fonction dump;
dump($arr, $superFonction);


?>