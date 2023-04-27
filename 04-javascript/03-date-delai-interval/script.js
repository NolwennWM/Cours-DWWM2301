"use strict";
const copyright = document.querySelector('footer span');
const mainTime = document.querySelector('main time');
const mainBtn = document.querySelector('main button');
const progress = document.querySelector('.progress');

/* 
    On crée un nouvel objet "Date" qui contiendra l'heure et la date du moment de sa création.
    Les "classes" permettant de créer un nouvel objet sont conventionnellement écrites avec une majuscule.
    Le mot clef "new" les précédents nous permet d'indiquer que l'on va créer un nouvel objet à partir de celle ci.
*/
const date = new Date();
/* 
    L'objet date contient de nombreuses méthodes (fonctions) permettant 
    la récupération de l'heure, les minutes, l'année... 
*/
copyright.textContent = date.getFullYear();
// On peut aussi avoir la date ou l'heure complète
mainTime.textContent = date.toLocaleTimeString();
/**
 * Créer un nouvel objet date et affiche l'heure dans la balise time
 */
function timer() {
    const t = new Date();
    mainTime.textContent = t.toLocaleTimeString();
}
/* 
    setInterval permet de relancer une fonction à rythme régulier.
    En premier paramètre il prend la fonction à relancer.
    en second le temps en milliseconde entre chaque appel de la fonction.

    Optionnellement on peut récupérer l'identifiant de l'interval qui est retourné par la fonction setInterval.
*/
let intervalId = setInterval(timer, 1000);
console.log(intervalId);
/* 
    On peut utiliser clearInterval pour stopper un interval.
    Il nous faudra donner en paramètre l'id de l'interval à stopper.
*/
mainBtn.addEventListener("click", () => clearInterval(intervalId));

/* 
    setTimeout fonctionne de la même façon que setInterval
    Si ce n'est qu'au lieu de relancer la fonction à rythme régulier.
    La fonction sera lancé une seule fois après un délai.

    là aussi on peut empêcher son execution avec un "clearTimeout"
*/
let timeoutId = setTimeout(() => alert("Coucou en retard !"), 3000);

clearTimeout(timeoutId);

let w = 0;

function load() {
    console.log(w);
    if (w === 100) return;
    w++
    progress.style.width = w + "%";
    setTimeout(load, 100);
    // load();
}
load();