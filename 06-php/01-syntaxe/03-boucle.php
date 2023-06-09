<?php 
#------------------------ While ------------------------
echo "<h1>While</h1> <hr>";

$x = 0;
/* 
    Les boucles permettent de répéter une action.
    while va se répéter tant que le boolean entre parenthèse est "true"
*/
while ($x < 10) 
{
    echo "x = $x <br>";
    $x++;
}
// Syntaxe en ":" "endwhile"
while ($x < 15):
    echo "x = $x <br>";
    $x++;
endwhile;
// Syntaxe sur une seule instruction :
while($x < 20)
    echo "x = ",$x++, "<br>";

#------------------------ Do While ------------------------
echo "<h1>Do While</h1> <hr>";
/* 
    Do while va executer ses instructions une première fois 
    avant de vérifier si il doit se répéter 
*/
do{
    echo "x = $x <br>";
    $x++;
}while($x < 1);
// Syntaxe sur une seule instruction 
do 
    echo "x = ",$x++, "<br>"; 
while($x <2);
#------------------------ For ------------------------
echo "<h1>For</h1> <hr>";
/* 
    La boucle for est particulièrement adapté aux boucles basées sur un chiffre.
    Elle est structuré ainsi :

    for(expr1, expr2, expr3){ instructions à répéter }
    expr1 sera évalué avant de commencer la boucle.
    expr2 sera évalué au début de chaque itération et continuera la boucle si elle obtient "true"
    expr3 sera évalué à chaque fin d'itération.
*/
for($y = 0; $y < 10; $y++)
{
    echo "y = $y <br>";
}
// syntaxe en ":"
for($y = 0; $y < 15; $y++):
    echo "y = $y <br>";
endfor;
// syntaxe pour une unique instruction :
for($y = 0; $y < 20; $y++)
    echo "y = $y <br>";

#----------------------------foreach--------------------
echo "<h1>Foreach</h1> <hr>";
$a = ["spaghetti", "thon", "mayonnaise", "oignon"];
/* 
    foreach permet de parcourir un tableau.
    il fera autant d'itération qu'il y a d'élément dans le tableau.
    avec à chaque nouvelle itération, l'élément suivant du tableau.
    syntaxe :
    foreach(array as variable){ instruction à répéter}
*/
foreach($a as $food)
{
    echo $food, "<br>";
}
// Avec la boucle foreach, il est aussi possible de récupérer la clef.
foreach($a as $key => $food)
{
    echo "$key : $food <br>";
}
// syntaxe avec ":"
foreach($a as $food):
    echo $food, "<br>";
endforeach;
// syntaxe pour une seule instruction:
foreach($a as $food)
    echo $food, "<br>";
#---------------------- Continue et Break  ----------------------
echo "<h1>Continue et Break</h1> <hr>";
/* 
    Continue et Break sont des mots clefs utilisable sur n'importe quel type de boucle.
    continue met fin à l'itération en cours et passe à la suivante.
    break met fin à la boucle.
*/
foreach($a as $food)
{
    if($food == "spaghetti") continue;
    if($food == "mayonnaise") break;
    echo $food, "<br>";
}
?>