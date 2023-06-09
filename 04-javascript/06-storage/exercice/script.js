"use strict";
/* 
    1. Ajouter un menu de selection qui permettra de choisir entre 3 thèmes.
    2. Appliquer le thème selectionné grâce à JS (pas besoin de thème compliqué)
    3. Faire en sorte que le choix de l'utilisateur soit toujours appliqué lorsqu'il change de page. (que ce soit visible dans le menu de selection autant que dans les couleurs du site.)
    4.Bonus. Faire un bouton qui change aléatoirement les couleurs du site et les sauvegarder.
*/
const btn = document.querySelector('#theme');
btn.addEventListener("input", themeChange);

function themeChange()
{
    if(btn.value === "rouge")
    {
        document.documentElement.style.setProperty("--fond", "red");
        localStorage.setItem("color", "rouge");
    }
    if(btn.value === "vert")
    {
        document.documentElement.style.setProperty("--fond", "green");
        localStorage.setItem("color", "vert");
    }
    if(btn.value === "rose")
    {
        document.documentElement.style.setProperty("--fond", "pink");
        localStorage.setItem("color", "rose");
    }
}
const colorStorage = localStorage.getItem("color");
btn.value = colorStorage;
themeChange();

const button = document.querySelector('#button-id');
button.addEventListener("click", function(){
    var letter = "0123456789ABCDEF";
    var color = "#";
    for(var i = 0; i < 6; i++) 
    {
        color += letter[Math.floor(Math.random()*16)];
    }
    document.documentElement.style.setProperty("--fond", color);
    localStorage.setItem("color", color);
});


if(/^#[A-F0-9]{6}/.test(colorStorage))
{
    document.documentElement.style.setProperty("--fond", colorStorage);
}