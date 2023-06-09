"use strict";

const url = "https://api.thedogapi.com/v1/images/upload";
const api_key = "469f2c7f-9aad-4623-8e7a-d72c11a91b18";

const formulaire = document.querySelector('form');
const result = document.querySelector('.result');

formulaire.addEventListener("submit", uploadDog);

function uploadDog(e)
{
    e.preventDefault();
    const formData = new FormData(formulaire);
    console.log("Chargement en cours.");
    result.textContent = "Chargement en cours.";
    /* 
        Fetch peut prendre optionnellement un second argument.
        Celui ci est un objet, permettant d'ajouter des options comme :
            "method" : pour indiquer la méthode d'envoi de la requête
            "headers" : les informations contenues dans l'entête de la requête
            "body" : le corps de la requête
    */
    fetch(url, {
        method: "POST",
        headers: {"x-api-key": api_key},
        body: formData
    }).then(checkResponse);
}
function checkResponse(response)
{
    console.log("Chargement Terminé !");
    result.textContent = "Chargement Terminé !";
    if(response.ok)
    {
        response.json().then(data=>{
            console.log(data);
            result.innerHTML = `<hr><img src="${data.url}" alt="image de chien téléversé" width=400>`;
        });
    }
    else
    {
        console.log(response.statusText);
        result.textContent = response.statusText;
    }
}