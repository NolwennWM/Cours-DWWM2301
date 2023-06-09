<!-- 
    ----------------------------Exercice D1-----------------------------
    écrire une fonction "frenchDate" qui retournera la date du jour 
    en français, puis l'afficher (exemple : jeudi 25 août 2022);
-->
<?php 
function frenchDateRomain()
{
    $jours = ["lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi", "dimanche"];
    $mois = ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"];
    // Pas besoin de cela :
    $date_aujourdhui = date("Y-m-d");
    // $nom_jour = $jours[date("N")-1];
    $nom_jour = $jours[date("N", strtotime($date_aujourdhui))-1];
    // $nom_mois = $mois[date("n")-1];
    $nom_mois = $mois[date("n", strtotime($date_aujourdhui))-1];
    // $annee = date("Y");
    $annee = date("Y", strtotime($date_aujourdhui));
    // $jour = date("j")
    $date_fr = $nom_jour . " ". date("d", strtotime($date_aujourdhui)) . " " . $nom_mois . " " .$annee;
    // return "$nom_jour $jour $nom_mois $annee";
    return $date_fr;
}
$date = frenchDateRomain();
echo $date, "<br>";

function dateToFrenchAngelina($date, $format)
{
    $english_days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
    $french_days = ["lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi", "dimanche"];
    $english_months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    $french_months = ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"];
    return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date))));
}
echo dateToFrenchAngelina("now", "l j F Y"), "<br>";

// Solution avec activation de l'extension :
/* 
    Cette solution fonctionne uniquement si dans le fichier "php.ini"
    on a activé l'extension suivante :
        "extension=intl"
*/
function frenchDateKevin()
{
    $musk_time = new \DateTime();
    $format = new \IntlDateFormatter(
        "fr_FR",
        \IntlDateFormatter::FULL
    );
    $format->setPattern("EEEE d MMM Y");
    echo $format->format($musk_time), "<br>";
}
frenchDateKevin();

function frenchDateNolwenn()
{
    $fmt = datefmt_create(
        "fr_FR",
        IntlDateFormatter::FULL,
        IntlDateFormatter::NONE
    );
    return datefmt_format($fmt, time());
}
echo frenchDateNolwenn(), "<br>";
?>
<hr>
<!-- 
    ----------------------------Exercice D2-----------------------------
    Utiliser la fonction précédement créé pour afficher la date 
    puis l'heure depuis laquelle l'utilisateur visite le site.
    On utilisera les sessions.
-->
<?php 
    session_start();
    if(!isset($_SESSION["startTime"]))
    {
        $_SESSION["startTime"] = frenchDateNolwenn() . " " . date("H:i:s");
    }
    echo "Présent ici depuis : ". $_SESSION["startTime"];
?>
<hr>
<!-- 
    ----------------------------Exercice D3-----------------------------
    Afficher depuis combien de seconde l'utilisateur est présent sur le site.
-->
<?php 
    if(!isset($_SESSION["loggedSince"]))
    {
        $_SESSION["loggedSince"] = time();
    }
    $time = time() - $_SESSION["loggedSince"];

    echo "Vous êtes ici depuis $time secondes. <br>";
    // Problème dû au décalage horaire:
    // echo "Vous êtes ici depuis ". date("h\h i\m s\s", $time);
?>