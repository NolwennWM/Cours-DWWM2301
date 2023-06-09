<?php 
$title = "Go To";
require "../ressources/template/_header.php";

/* 
    Go to permet de sauter une partie du code pour aller à la suivante. (ou précédente)

    ATTENTION, On ne peut pas:
        - entrer dans une fonction, une boucle ou une condition.
        - sortir d'une fonction.

    Go To fonctionne en deux parties, la première est une balise qui servira d'ancre à notre goto.
    Cette balise est représenté par un mot suivi de ":"
    Et le second, le mot clef "goto" suivi du nom d'une ancre.
*/
for ($i=0; $i < 100; $i++) { 
    echo "Ceci est le message $i !<br>";
    if($i === 5)
    {
        // goto indique qu'il nous envoi à la balise "fin"
        goto fin;
    }
}
echo "les chaussettes de l'archi duchesse... <br>";
// balise que j'ai nommé "fin"
fin:
echo "Ceci est la fin !";

/* 
    Cela dit, goto est décrié, car il rend la lecture du code un peu plus complexe.
    Au lieu d'être lu simplement de haut en bas, il peut nous renvoyer à tout un tas d'endroit.
*/

require "../ressources/template/_footer.php";
?>