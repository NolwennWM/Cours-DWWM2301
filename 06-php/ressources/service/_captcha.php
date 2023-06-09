<?php 
if(session_status()===PHP_SESSION_NONE)session_start();

$characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

/**
 * Génère une chaîne de caractère aléatoire.
 * 
 * Elle prend la liste des caractères utilisable en premier argument.
 * Et la taille du string en second.
 *
 * @param string $characters
 * @param integer $strength
 * @return string
 */
function generateString(string $characters, int $strength = 10): string
{
    $randStr = "";
    for($i=0; $i < $strength; $i++)
    {
        $randStr .= $characters[rand(0, strlen($characters)-1)];
    }
    return $randStr;
}
/* 
    Pour utiliser les fonctions suivantes, 
    on doit activer dans "php.ini" l'extension "gd"

    imagecreatetruecolor génère une nouvelle image avec (largeur, hauteur) en paramètre.
    image qui est un objet de classe "GdImage"
*/
$image = imagecreatetruecolor(200, 50);
// active les fonctionnalités d'antialiasing pour améliorer la qualité de l'image.
imageantialias($image, true);

$colors = [];

$red = rand(125, 175);
$green = rand(125, 175);
$blue = rand(125, 175);

for($i = 0; $i < 5; $i++)
{
    /* 
        imagecolorallocate prend un objet GdImage en premier argument.
        puis 3 valeurs numérique représentant les niveaux de couleur rgb
        retourne un INT qui représente un identifiant pour la couleur généré.
    */
    $colors[] = imagecolorallocate($image, $red - 20*$i, $green - 20*$i, $blue - 20*$i);
}
/* 
    On rempli notre objet GdImage avec la première couleur de notre tableau.
    imagefill prend notre objet en premier argument,
    puis les positions X et Y du remplissage
    Et enfin la couleur.
*/
imagefill($image, 0, 0, $colors[0]);

for ($i=0; $i < 10; $i++) 
{ 
    // paramètre une largeur en pixel.
    imagesetthickness($image, rand(2, 10));
    /* 
        Dessine un rectangle pour l'objet GdImage donné en premier argument.
        avec la position de départ x, y, donné en second et troisième argument.
        la position de fin donnée en quatrième et cinquième arguments.
        et la couleur donné en 6ème.
    */
    imagerectangle(
        $image,
        rand(-10, 190),
        rand(-10, 10),
        rand(-10, 190),
        rand(40, 60),
        $colors[rand(1,4)]
    );
}
// Couleurs, polices et longueur du texte de mon captcha :
$textColors = [
    imagecolorallocate($image, 0, 0, 0),
    imagecolorallocate($image, 255, 255, 255)
];
$fonts = [
    __DIR__."/../fonts/Acme-Regular.ttf",
    __DIR__."/../fonts/arial.ttf",
    __DIR__."/../fonts/typewriter.ttf"
];
$strLength = 6;
// texte de mon captcha :
$captchaStr = generateString($characters, $strLength);
# Je sauvegarde mon captcha en session.
$_SESSION["captchaStr"] = $captchaStr;
// echo $captchaStr;
for ($i=0; $i < $strLength; $i++) 
{ 
    // On choisi un espacement entre les lettres et une position de départ initial en px :
    $letterSpace = 170/$strLength;
    $initial = 15;
    /* 
        imagettftext permet d'écrire du texte dans notre image en utilisant une police au format ttf.
        les arguments sont :
        1: l'image en tant qu'objet GdImage
        2: la taille du texte
        3: un angle en degré
        4, 5: les positions x et y
        6: la couleur de la police
        7: la police à utiliser
        8: le texte à écrire
    */
    imagettftext(
        $image,
        24,
        rand(-15, 15),
        $initial + $i*$letterSpace,
        rand(25, 45),
        $textColors[rand(0,1)],
        $fonts[array_rand($fonts)],
        $captchaStr[$i]
    );
}
/* 
    J'indique quel est le type mime du contenu du fichier.
    ici que c'est une image au format png.
*/
header("Content-type: image/png");
/* 
    Je transforme mon objet GdImage en image au format png.
*/
imagepng($image);
?>