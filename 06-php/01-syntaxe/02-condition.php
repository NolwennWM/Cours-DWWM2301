<?php
/* 
    rand() donne un nombre aléatoire 
    avec pour minimum le premier paramètre
    et maximum le second paramètre.
*/
$r = rand(0,100);
echo $r, "<br>";

if($r < 50)
{
    echo "\$r est plus petit que 50. <br>";
}
elseif($r > 50)
{
    echo "\$r est plus grand que 50. <br>";
}
else
{
    echo "\$r est égale à 50 <br>";
}

#----------------- autres syntaxes possibles -----------
echo "<h1>Autres syntaxes</h1> <hr>";

/* 
    Il est possible de remplacer les accolades par ":" 
    et dans ce cas là, la fin de la condition sera marqué par un "endif;"
*/
if($r < 50):
    echo "\$r est plus petit que 50. <br>";
elseif($r > 50):
    echo "\$r est plus grand que 50. <br>";
else:
    echo "\$r est égale à 50 <br>";
endif;

/* 
    Il est aussi possible de retirer les ":" et "endif" mais dans ce cas, 
    seule la première instruction qui suis la condition sera prise en compte.
*/
if($r < 50)
    echo "\$r est plus petit que 50. <br>";
elseif($r > 50)
    echo "\$r est plus grand que 50. <br>";
else echo "\$r est égale à 50 <br>";

/* 
    On peut aussi utiliser les ternaires, c'est à dire un "if else" 
    sur une seule ligne :
    condition?true:false;
*/
echo "\$r est plus ". ($r<=50 ? "petit ou égale à":"grand que")." 50<br>";
/* 
    On peut imbriquer les ternaires, 
    mais il ne faut pas perdre en compréhension de notre code
*/
echo "\$r est ". (
    $r<50 ? "plus petit que": 
    ($r>50 ? "plus grand que": "égale à")
    ). " 50.<br>";

/* 
    "??" va selectionner la variable précédente si elle est défini
    Sinon, il selectionnera la valeur suivante.
*/
$message1 = "Bonjour le monde ! <br>";
echo $message1 ?? "rien à dire <br>";
echo $message2 ?? "rien à dire... <br>";

#---------------------- SWITCH ----------------------
echo "<h1>SWITCH</h1> <hr>";
$pays = ["France", "Japon", "Angleterre", "Suisse", "france"];
$r2 = rand(0, count($pays)-1);

echo $pays[$r2], "<br>";
/* 
    le switch va prendre une valeur entre parenthèse.
    Et rechercher si il a un "case" qui correspond.
    Dans ce cas il fera les instructions qui suivent le case, 
    et cela jusqu'à rencontrer un "break"
    On peut aussi ajouter le mot clef "default" qui se déclenchera
    si aucun des cases ne correspond.
*/
switch($pays[$r2])
{
    case "france":
    case "France":
        echo "Bonjour France ! <br>";
        break;
    case "Japon":
        echo "konnichiwa Japon ! <br>";
        break;
    case "Suisse":
        echo "Bonjour Suisse ! <br>";
        break;
    default:
        echo "Pas de bonjour <br>";
}
?>