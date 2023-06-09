"use strict";
/* 
    La balise canvas ne sert à rien... sans JS.
    Mais avec JS, elle peut être utilisé pour faires 
        des animations, des jeux, des outils interactifs...
*/
const canvas = document.querySelector('canvas');
/* 
    On crée un contexte 2D (2D canvas)
    Pour intéragire avec le canvas, on a besoin d'un contexte.
    Ce contexte va servire à indiquer si on travail en 2D ou 3D avec certains outils comme "webgl"
    On utilise pour cela sur notre canvas, la méthode "getContext()"
*/
const ctx = canvas.getContext('2d');
// ----------- redimension Dynamique du Canvas -----------------
function resize()
{
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
}
resize();
window.addEventListener('resize', resize);
// ----------- Fonction d'affichage -----------------
/* 
    La plupart des méthodes du canvas, se lance via le contexte 
    (ici la variable ctx)

    "fillRect" et "strokeRect" permettent de dessiner un rectangle.
    ils prennent les paramètres suivant :
        - x : coordonnée horizontale du coin supérieur gauche
        - y : coordonnée verticale du coin supérieur gauche
        - w : largeur du rectangle
        - h : hauteur du rectangle
    Le premier dessinera un rectangle plein,
    le second, seulement les contours
*/
ctx.fillRect(34, 42, 150, 200);
ctx.strokeRect(78, 91, 300, 100);
/* 
    "fillStyle" et "strokeStyle" sont des propriétés qui permettent de changer respectivement :
    la couleur de remplissage, et celle du trait.
    On peut utiliser, les mots clefs css, l'hexadecimal, rgb...

    Le changement ne s'applique qu'aux dessins qui suivent et non aux précédents.
*/
ctx.fillStyle = 'red';
ctx.strokeStyle = "rgb(189, 213, 87)";
ctx.fillRect(98, 456, 432,87);
ctx.strokeRect(643, 21, 25,876);

/* 
    On peut dessiner des formes plus complexes en indiquant
        "beginPath()" le début d'un chemin
        "moveTo()" en déplaçant notre "crayon" à une position (sans dessiner)
        "lineTo()" en déplaçant notre "crayon" à une autre position (en dessinant)
        "stroke()" en lui indiquant de valider et dessiner notre forme.
*/
ctx.beginPath();
ctx.moveTo(100, 400);
ctx.lineTo(450, 600);
ctx.stroke();

ctx.beginPath();
ctx.moveTo(50, 40);
ctx.lineTo(800, 100);
ctx.lineTo(450, 300);
// "closePath()" va relier le premier point au dernier
ctx.closePath();
ctx.strokeStyle = "chartreuse";
ctx.fillStyle = "aquamarine";
// "lineWidth" indique la largeur des lignes.
ctx.lineWidth = 8;
ctx.stroke();
// "fill()" permet de remplir la forme précédement dessinée.
ctx.fill();

ctx.beginPath()
/* 
    "arc()" permet dessiner des cercles ou arc de cercle avec les propriétés suivantes :
    - x : coordonnée horizontale du centre du cercle
    - y : coordonnée verticale du centre du cercle
    - r : rayon du cercle
    - startAngle : angle en degrés où commencer la courbe
    - endAngle : angle en degrés où finir la courbe

    2 * Math.PI correspond à un cercle complet
*/
ctx.arc(342, 420, 50, 0, 2 * Math.PI);
ctx.stroke();
// "clearRect()" prend les même paramètres que pour un rectangle, mais efface la zone indiqué
ctx.clearRect(50, 60, 230, 120);
/* 
    "getImageData()" sauvegarde les données dessinés dans le rectangle indiqué en argument.
    Ces données sont ensuite utilisables par "putImageData()".
    Ce dernier prendra en paramètre, 
    - la sauvegarde précédement gardé dans une variable.
    - la position x où placer la sauvegarde,
    - la position y où placer la sauvegarde
*/
let snapshot = ctx.getImageData(0, 0, canvas.width, canvas.height);
// Tout supprimer :
ctx.clearRect(0, 0, canvas.width, canvas.height);
ctx.putImageData(snapshot, 0, 0);

// -------------- Animer notre canvas --------------------

let x = 100, y = 100, r= 50, vv = 5, vh = 5;
function cercle()
{
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.putImageData(snapshot, 0, 0);
    // dessiner le cercle
    ctx.beginPath();
    ctx.arc(x, y, r, 0, 2 * Math.PI);
    ctx.stroke();
    ctx.fill();
    // ctx.drawImage(img, x, y, r, r);
    // gérer les collisions
    if(x+r> canvas.width || x-r < 0)
    {
        vh = -vh;
    }
    if(y+r> canvas.height || y-r < 0)
    {
        vv = -vv;
    }
    // déplacer le cercle
    x += vh;
    y += vv;
    // requestAnimationFrame va appeler la fonction donnée en paramètre à un rythme optimal pour une animation
    requestAnimationFrame(cercle);
}
// cercle();

// --------------- Ajouter des images -----------------
// je créer une nouvelle image
let img = new Image();
// Je lui indique sa source
img.src = "../../ressources/images/favicon.ico";
// J'attend qu'elle est chargée
img.onload = ()=>
{
    // j'ajoute l'image à mon canvas
    ctx.drawImage(img, 50, 250, 1000, 100)
    /* 
        "drawImage()" prendra en paramètre :
        - l'image que l'on veut dessiner
        - la position x où placer l'image
        - la position y où placer l'image
        (Optionnellement)
        - la taille x de l'image
        - la taille y de l'image
    */
}
// img.onload = cercle;

// --------------- ajouter du texte -----------------
ctx.lineWidth = 1;
// "font" permet de changer la taille et la police d'écriture.
ctx.font = "80px Monospace";
/* 
    strokeText et fillText permettent d'écrire du texte évidé ou rempli. 
    Ils prennent en paramètre :
    - la chaîne de caractères à écrire
    - la position x où placer le texte
    - la position y où placer le texte
    (Optionnellement)
    - la largeur maximale de la zone de texte
*/
ctx.fillText("Hello World", 50, 500);
ctx.strokeText("Hello World", 100, 400, 100);
// On peut aussi changer l'alignement du texte :
ctx.textAlign = "center";
ctx.fillText("Hello World", 150, 600);

// ------------ forme des traits -------------
ctx.lineWidth = 16;
ctx.strokeStyle = "brown";

/* 
    "lineCap" permet de changer la forme du trait
    Il prendra en valeur, soit "round", soit "square" ou alors "butt";
*/
ctx.beginPath();
ctx.lineCap = "round"
ctx.moveTo(700, 100);
ctx.lineTo(700, 500);
ctx.stroke();

ctx.beginPath();
ctx.lineCap = "square"
ctx.moveTo(750, 100);
ctx.lineTo(750, 500);
ctx.stroke();

ctx.beginPath();
ctx.lineCap = "butt"
ctx.moveTo(800, 100);
ctx.lineTo(800, 500);
ctx.stroke();
