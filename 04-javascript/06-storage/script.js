"use strict";
const dark = document.querySelector('#darkTheme');

dark.addEventListener("input", changeTheme2);

/**
 * Change le thème de la page avec une classe sur le body.
 */
function changeTheme()
{
    document.body.classList.toggle("dark", dark.checked);
}
/**
 * Change le thème en changeant les variables CSS
 */
function changeTheme2()
{
    if(dark.checked)
    {
        document.documentElement.style.setProperty("--fond", "#333");
        document.documentElement.style.setProperty("--text", "antiquewhite");
        // Je sauvegarde le choix de l'utilisateur
        localStorage.setItem("theme", "dark");
    }
    else
    {
        document.documentElement.style.setProperty("--fond", "antiquewhite");
        document.documentElement.style.setProperty("--text", "#333");
        // Je supprime le choix de l'utilisateur
        localStorage.removeItem("theme");
    }
}
// Je coche la case ou non, selon le choix de l'utilisateur
dark.checked = localStorage.getItem("theme") === "dark";
// Je change le thème selon si la case est coché ou non.
changeTheme2();

/* 
    localStorage et sessionStorage permettent de sauvegarder des strings sur le navigateur de l'utilisateur.

    Ils utilisent les même méthodes et propriétés,
    la seule différence étant que sessionStorage se supprime dès que l'on quitte la session (on ferme le site)

    .setItem() permet de sauvegarder le string en second paramètre, à la clef donnée en premier paramètre.
    .getItem() permet de récupérer le string sauvegardé à la clef donnée en paramètre.
    .removeItem() permet de supprimer le string, sauvegardé à la clef donnée en paramètre.
    .clear() supprime TOUTE les données.
    .key() permet de récupérer une clef en passant en paramètre un index.
*/

sessionStorage.setItem("salutation", "Bonjour tout le monde !");
localStorage.setItem("salutation", "Hello World !");

console.log(localStorage.key(1));

sessionStorage.clear();
