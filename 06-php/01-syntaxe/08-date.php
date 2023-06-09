<?php 
$title = " Les dates";
require "../ressources/template/_header.php";

// Pour récupérer le timestamp, on utilisera "time()"
echo time(), "<br>";

/* 
    Pour afficher une date en PHP, on utilisera la fonction "date()"
    Elle prendra au moins un argument, et possiblement un second.
    Le premier est un string sur lequel on reviendra juste après.
    Et le second optionnel, est un timestamp.
    Si aucun timestamp n'est donné, on utilisera le timestamp courant.
    Sinon on peut lui donner un timestamp passé ou futur.
*/
echo date("");
/* 
    Si on laisse le string vide, rien ne s'affiche.
    Ce string doit contenir le format de la date (ou/et l'heure)
    Pour cela on utilisera certaines lettres qui ont une signification pour la fonction date.

    Attention, les noms des mois et jour sont en anglais.
*/
/* 
    d = numéro du jour du mois avec le 0;
    m = numéro du mois avec le 0
    Y = Année sur 4 chiffres
*/
echo date("d/m/Y"), "<br>";
/* 
    j = numéro du jour du mois sans le 0;
    n = numéro du mois sans le 0
    y = Année sur 2 chiffres
*/
echo date("j/n/y"), "<br>";

/* 
    D = Nom du jour sur 3 lettres
    l = Nom du jour complet
    M = Nom du mois sur 3 lettres
    F = Nom du mois complet
*/
echo date("D = l / M = F"), "<br>";
/* 
    N = Numéro du jour dans la semaine, avec dimanche = 7
    w = Numéro du jour dans la semaine, avec dimanche = 0
*/
echo date("D = N = w"), "<br>";
/* 
    z = numéro du jour dans l'année avec 1er Janvier = 0
    W = numéro de la semaine dans l'année
*/
echo date("z -> W"), "<br>";
/* 
    t = nombre de jour dans le mois
*/
echo date("F -> t"), "<br>";
/* 
    L = Si bissextile retourne 1 sinon 0
*/
echo date("Y -> L"), "<br>";
/* 
    h = L'heure en format 12 avec 0
    i = les minutes avec 0
    s = les secondes avec 0
    a = "am" ou "pm"
*/
echo date("h:i:s a"), "<br>";
/* 
    g = l'heure en format 12 sans 0
    A = "AM" ou "PM"
*/
echo date("g:i:s A"), "<br>";
/* 
    H = l'heure au format 24 avec 0
    v = millisecondes avec 0
    à noter que selon le serveur, "v" peut ne pas fonctionner.
*/
echo date("H:i:s:v"), "<br>";
/* 
    G = L'heure au format 24 sans 0
*/
echo date("G:i:s:v"), "<br>";
/* 
    O = Différence d'heure avec GMT sans ":"
    P = Différence d'heure avec GMT avec ":"
*/
echo date("O = P"), "<br>";
/* 
    I = Retourne 1 si heure d'été sinon 0
    Z = Différence d'heure avec GMT en seconde
*/
echo date("I -> Z"), "<br>";
/* 
    c = Date complète au format ISO 8601
*/
echo date("c"), "<br>";
/* 
    r = Date complète au format RFC 2822
*/
echo date("r"), "<br>";
/* 
    strtotime() tente de lire un string au format d'une date anglaise
    pour le traduire en timestamp
*/
echo strtotime("2013-12-25"), "<br>";

echo date("r", strtotime("1989-04-13 06:01"));
require "../ressources/template/_footer.php";
?>