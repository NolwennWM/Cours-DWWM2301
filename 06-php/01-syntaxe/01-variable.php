<h1>Introduction</h1>
<hr>
<!-- 
    Le code php commence par <?php 
    ?> et ceci est sa balise de fin
    Il est commun de voir HTML et PHP se mélanger.

    Le nom actuel de PHP est "PHP Hypertext Preprocessor"
    Le nom d'origine de PHP est "Personnal Home Page"
-->
<?php 
    // Commentaire sur une seule ligne.
    # Un autre commentaire sur une seule ligne
    /* 
        Et le commentaire 
        sur plusieurs lignes
    */
    // ! Chaque instruction de PHP se termine par un ";"
    # Les données écritent en PHP ne sont pas visible sur notre page.
    "Coucou";
    # Pour afficher des données, on utilisera une des fonctions suivantes :
    echo "Coucou";
    // echo n'a pas besoin de parenthèse et peut prendre plusieurs valeurs :
    echo "Hello", "World";
    // Une fois interprété, les informations affichés seront traité comme du HTML par le navigateur :
    print "<br> PHP !!!";
    /* 
        print peut aussi ne pas prendre de parenthèse.
        Mais il ne prend qu'un seul argument, 
        est légèrement plus lent que echo
        et retourne une valeur de 1
    */
    var_dump("Bonjour", "Le Monde !", true);
    /* 
        var_dump est le meilleur ami du debug, 
        il affichera des informations supplémentaires.
        il prend autant de paramètre que voulu.
    */
    var_export("orange");
    /* 
        var_export affiche ce qui lui est donnée avec la syntaxe PHP.
    */
    // phpinfo();
    # phpinfo() fait apparaître toute les informations sur le serveur et sa configuration
    echo getenv("SERVER_PORT");
    # getenv() permet de récupérer les variables d'environnement visible avec phpinfo();

# -----------------------Variables --------------------------
echo "<h1>Déclaration des variables</h1> <hr>";

$banane;
/* 
    On déclare une variable en PHP avec un "$" puis une lettre ou un "_"
    puis ensuite les chiffres sont acceptés
    Essayez de nommer vos variables avec des noms logiques.
    Les variables sont sensible à la casse "$banane" et "$Banane" sont différentes.
*/
// echo "banane :", $banane;
/* 
    Un warning apparaît car ma variable est certes déclaré, mais non définie.
    Pour la définir je vais devoir lui attribuer une valeur avec le signe "=";
*/
$banane = "Jaune";
echo "banane : ", $banane, "<br>";
/* 
    PHP gère aussi les constantes, mais leur définition varie selon si vous êtes sur une ancienne version de PHP ou sur une des dernières:
    Ancienne version :
*/
define("AVOCAT", "vert");
echo "avocat : ", AVOCAT, "<br>";
// Nouvelle version :
const COCO = "marron";
echo "coco : ", COCO, "<br>";
// Ce n'est pas obligatoire, mais par convention on met les constantes en majuscule.

# get_defined_var() retournera toute les variables actuellement définie:
var_dump(get_defined_vars());
# De même pour les constantes :
// var_dump(get_defined_constants());

// Variables dynamique :
$chaussette = "rouge";
// Ici on définie une variable, dont le nom dépend d'une variable.
$$chaussette = "bleu";
echo "<br>",$rouge, "<br>";
// Si je veux détruire une variable, j'utiliserais :
unset($banane);

#--------------------- Types -----------------------------
echo "<h1>Types des variables</h1> <hr>";
$num = 5;
$dec = 0.5;
$str = "Coucou";
$arr = []; // ou $arr = array();
$boo = true;
$nul = NULL;
$obj = (object)[];

// integer, un nombre entier
echo gettype($num), "<br>";
// double (ou float), un nombre decimal
echo gettype($dec), "<br>";
// string, une chaîne de caractères
echo gettype($str), "<br>";
// array, un tableau
echo gettype($arr), "<br>";
// boolean, true ou false
echo gettype($boo), "<br>";
// NULL, une valeur vide
echo gettype($nul), "<br>";
// object, un objet
echo gettype($obj), "<br>";

/* 
    il existe aussi les "ressources" que nous ne verront pas,
    les objets seront abordés quand nous verrons la POO.
*/

# ----------------------- STRING -------------------
echo "<h1>String</h1> <hr>";
// Un string peut être représenté par un de ces 2 caractères :
echo "Bonjour", 'Coucou', "<br>";
// Les backticks `` en PHP auront un tout autre rôle.
// En PHP, on peut faire des sauts à la ligne dans un string, mais ils ne seront pas prit en compte à l'affichage :
echo "Ceci est un message
    si long qu'il est 
    sur plusieurs lignes. <br>";

$nom = "Maurice";
$age = 54;
/* 
    Il suffit d'insérer une variable dans un string pour interpoller.
    L'interpolation ne fonctionne qu'avec les guillemets.
*/
echo "$nom a $age ans. <br>";
echo '$nom a $age ans. <br>';

// La concatenation utilise le caractère ".";
echo $nom . " a " . $age . " ans. <br>";
// équivalent à $nom = $nom . " DUPONT";
$nom .= " DUPONT"; 
echo $nom, "<br>";

// Quelques fonctions :

# Donne la longueur du string en paramètre.
echo strlen($nom), "<br>";
# Donne le nombre de mot dans le string en paramètre.
echo str_word_count($nom), "<br>";
# Inverse le string en paramètre.
echo strrev($nom), "<br>";
# Donne la position du second paramètre dans le premier.
echo strpos($nom, "i"), "<br>";
// [] après un string permet de selectionner un caractère.
echo $nom[8], "<br>";
$nom[8] = "L";
echo $nom, "<br>";
# Remplace le premier paramètre, par le second dans le troisième.
echo str_replace("ce", "cette", $nom), "<br>";

#---------------------- Nombres ---------------------------
echo "<h1>Nombres</h1> <hr>";

// Il est possible de préfixer les nombres pour indiquer leur base :

# 0b pour du binaire
$bin = 0b10000;
echo "\$bin = $bin <br>";

# 0 pour octale
$oct = 020;
echo "\$oct = $oct <br>";

# rien pour le decimal
$dec = 16;
echo "\$dec = $dec <br>";

# 0x pour l'hexadecimal
$hex = 0x10;
echo "\$hex = $hex <br>";

// Les nombres sont soit des INTEGER (nombre entier) soit des FLOAT/ DOUBLE (nombre decimal)
var_dump("3.14 is int?", is_int(3.14));
echo "<br>";
var_dump("3.14 is float?", is_float(3.14));
/* 
    is_int() retourne un boolean indiquant si le paramètre est un integer
    is_float() retourne un boolean indiquant si le paramètre est un float

    Les constantes suivantes indiques les valeurs maximums et minimum 
    que PHP puisse gérer.
*/  
echo "<br>", PHP_INT_MAX, "<br>", PHP_INT_MIN;
echo "<br>", PHP_FLOAT_MAX, "<br>", PHP_FLOAT_MIN;
/* 
    is_nan() permet de vérifier si une variable vaut NAN;
    is_numeric() permet de vérifier si un string contient que des chiffres.

    On peut transformer un string ou un float en int de cette façon :
*/
echo "<br>", (int)"42 chaussettes", "<br>", (int)3.14, "<br>";

// Evidemment, l'utilisation d'opérateur mathématique est possible :
echo "1+1=", 1+1, "<br>";
echo "1-1=", 1-1, "<br>";
echo "2*2=", 2*2, "<br>";
echo "8/2=", 8/2, "<br>";
// Le modulo (reste de la division)
echo "11%3=", 11%3, "<br>";
// La puissance
echo "2**4=", 2**4, "<br>";

// Les opérateurs d'assignement sont aussi disponible.
$x = 5;
$x += 7; // $x = $x + 7;
$x -= 3; // $x = $x - 3;
$x *= 2; // $x = $x * 2;
$x /= 3; // $x = $x / 3;
$x %= 2; // $x = $x % 2;
$x **= 3; // $x = $x ** 3;
echo $x, "<br>";

// L'incrémentation et la décrémentation sont de retour :
echo $x++, "-->", $x, "<br>";
echo ++$x, "-->", $x, "<br>";
echo $x--, "-->", $x, "<br>";
echo --$x, "-->", $x, "<br>";

# ----------------------- Tableaux -------------------------
echo "<h1>Tableaux</h1><hr>";
// Les tableaux peuvent être créer de deux façon, l'ancienne :
$a = array("banane", "pizza", "avocat");
// La nouvelle :
$b = ["banane", "pizza", "avocat"];
// echo n'accepte que les strings ou ce qui peut en devenir comme un chiffre.
// echo $a; warning
var_dump($a);
// Pour un tableau un peu plus complexe à lire, on pourra utiliser l'astuce suivante :
echo '<pre>'.print_r($a, 1).'</pre>';

// Pour selectionner un élément du tableau, on utilisera l'index entre crochet :
echo "J'aime la $a[0], la $a[1] et l'$a[2]. <br>";
// Pour connaître la taille d'un tableau.
echo count($a), "<br>";

// Pour ajouter un élément à un tableau :
$a[] = "Fraise";

/* 
    En PHP, il existe ce qu'on appelle des tableaux associatif (associative array).
    Le principe est de remplacer les index numérique par des clef nominative.
*/
$person = ["prenom" => "Maurice", "age"=>42];
// Pour afficher les données, on utilisera donc les noms des clefs et non plus des chiffres.
echo $person["prenom"] . " a " . $person["age"] . " ans. <br>";
// Bien sûr les tableaux peuvent être multidimensionnels.
$person["loisir"] = ["pétanque", "bowling"];
echo '<pre>'.print_r($person, 1).'</pre>';
// On accolera juste les différents crochets pour aller de tableau en tableau :
echo $person["loisir"][0], "<br>";
// On peut utiliser "unset()" pour supprimer un élément d'un tableau :
unset($person["age"]);
// Sur un tableau associatif, cela ne pose pas de problème, mais sur un tableau classique cela peut être problématique :
unset($b[1]);
var_dump($b);
/* 
    On se retrouve avec les index 0 et 2, le manque du 1 peut provoquer une erreur.
    On pourra corriger cela avec array_values() qui nous retournera un tableau avec les index remits aux propre :
*/
$b = array_values($b);
// Une autre solution pour supprimer un élément d'un tableau est :
array_splice($a, 1, 1);
/* 
    array_splice coupe dans le tableau en premier paramètre
    à partir de l'index donné en second paramètre
    un nombre d'élément donné en troisième paramètre.

    On notera qu'on peut aussi se servir de splice pour remplacer des éléments,
    pour cela je lui donnerais un quatrième paramètre :
*/
array_splice($a, 0, 1, ["Endive", "Pamplemousse"]);
echo "<br>";
var_dump($a);
echo "<br>";
// On peut aussi fusionner deux tableaux avec :
$ab = array_merge($a, $b);
var_dump($ab);
echo "<br>";

// On pourra trier un tableau avec les fonctions suivantes :
sort($ab);
var_dump($ab);
/* 
    rsort() tri par ordre décroissant.

    Et pour les tableaux associatif :
        asort() par ordre croissant des valeurs
        ksort() par ordre croissant des clefs
        arsort() par ordre décroissant des valeurs
        krsort() par ordre décroissant des clefs
*/

// ------------------------ BOOLEAN --------------------
echo "<h1>Boolean</h1><hr>";
/* 
    Les booleans ne peuvent être que deux valeurs :
        true
        ou 
        false
    Mais on peut les obtenirs de bien des manières
*/
$t = true;
$f = false;
var_dump($t, $f);

echo "<br> 5<3 : ";
var_dump(5<3);
echo "<br> 5<=3 : ";
var_dump(5<=3);
echo "<br> 5>3 : ";
var_dump(5>3);
echo "<br> 5>=3 : ";
var_dump(5>=3);
// Est ce égale :
echo "<br> 5=='5' : ";
var_dump(5=='5');
// Est ce strictement égale
echo "<br> 5==='5' : ";
var_dump(5==='5');
// Est ce différent :
echo "<br> 5!='5' : ";
var_dump(5!='5');
// Autre syntaxe pour "différent"
echo "<br> 5<>'5' : ";
var_dump(5<>'5');
// Est ce strictement différent :
echo "<br> 5!=='5' : ";
var_dump(5!=='5');

// On peut aussi les combiner avec "ou" et "et" :

echo "<br> 5>3 and 5<2 : ";
var_dump(5>3 and 5<2 );
// "and" peut aussi s'écrire :
echo "<br> 5>3 && 5<2 : ";
var_dump(5>3 && 5<2 );

echo "<br> 5>3 or 5<2 : ";
var_dump(5>3 or 5<2 );
// "or" peut aussi s'écrire :
echo "<br> 5>3 || 5<2 : ";
var_dump(5>3 || 5<2 );

// xor est true si un des deux est true mais pas si les deux le sont.
echo "<br> 5>3 xor 5<2 : ";
var_dump(5>3 xor 5<2 );

echo "<br> !\$t, !\$f : ";
var_dump(!$t, !$f);

# --------------------- SUPER GLOBALS -----------------------
echo "<h1>Les variables SuperGlobals.</h1> <hr>";
/* 
    Certaines variables que l'on nomme SuperGlobals sont accessible n'importe où 
    dans votre code php et défini par défaut par celui ci :

    $GLOBALS
    # Stock toute les variables globales définie (par vous ou php)

    $_SERVER
    # Contient les informations liées au serveur, le header, l'url...

    $_REQUEST
    # Contient les superglobals post, get et cookie.

    $_POST
    # Contient les paramètres post (formulaire html par exemple)

    $_GET
    # Contient les paramètres get (url en ligne par exemple)

    $_FILES
    # Contient les informations des fichiers envoyés (formulaire html par exemple)

    $_ENV
    # Contient les variables d'environnement php

    $_COOKIE
    # Contient les cookies

    $_SESSION
    # Contient les variables de session
*/
echo '<pre>'.print_r($_COOKIE, 1).'</pre>';
?>