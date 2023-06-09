"use strict";

/* 
    Le JSON (JavaScript Object Notation)
    Permet de transformer un object ou tableau en string à la syntaxe particulière.
    Cette syntaxe peut être comprit et traduite par de nombreux langages.
    Cela permet donc entre autre choses de transférer des données entre langages différents.

    JS comprend deux principales fonctions pour travailler avec le JSON (on en verra une troisième plus tard)
        * JSON.stringify() qui prend un objet ou tableau et retourne un string.
        * JSON.parse() qui prend un string (sous forme de JSON) et le transforme en objet ou tableau.
*/
const form = document.querySelector('form');
form.addEventListener("submit", saveData);

function saveData(e)
{
    // J'empêche le formulaire d'être soumis
    e.preventDefault();
    // Je transfère les données de mon formulaire à l'objet "FormData";
    const data = new FormData(form);
    // Je déclare un objet vide.
    const user = {}
    console.log(data);
    // Je boucle sur mon objet "FormData" pour obtenir les values et name de mon formulaire.
    data.forEach((value, name)=>{
        console.log(value, name);
        // J'ajoute ces valeurs en tant que propriétés de mon objet "user"
        user[name] = value;
    })
    console.log(user);
    // Je transforme mon objet "user" en string JSON
    const strUser = JSON.stringify(user);
    console.log(strUser);
    // Je sauvegarde mon user en storage.
    localStorage.setItem("user", strUser);
    // j'affiche mon utilisateur :
    showUser(user);
}
/**
 * Affiche dans le h1 les informations de l'utilisateur.
 * @param {Object} u 
 */
function showUser(u)
{
    const h1 = document.querySelector('h1');
    h1.textContent = `Je suis ${u.prenom} et j'ai ${u.age} ans!`;
}
// Je récupère en storage mon user
const userString = localStorage.getItem("user");
if(userString)
{
    console.log(userString);
    // Je transforme mon string JSON en objet
    const user = JSON.parse(userString);
    console.log(user);
    // J'affiche mon utilisateur.
    showUser(user);
}