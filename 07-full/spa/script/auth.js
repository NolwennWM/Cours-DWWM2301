"use strict";

import { getLinks } from "./router.js";
let method;
/**
 * Selectionne la bonne fonction à utiliser selon la méthode
 * @param {string} option 
 */
export default function(option = "GET")
{
    method = option;
    if(method ==="GET")logout();
    else
    {
        const form = document.querySelector('form');
        form.addEventListener("submit", login);
    }
}
/**
 * Gère le formulaire de connexion
 * @param {SubmitEvent} e 
 */
async function login(e)
{
    e.preventDefault();
    const formData = new FormData(this);
    formData.append(this.name, true);

    const json = JSON.stringify(Object.fromEntries(formData));
    const response = await fetch(this.action, {
        method: method,
        body: json,
        credentials: "include"
    });
    const data = await response.json();
    if(response.ok)
    {
        window.history.pushState({}, "", "/");
        const main = document.querySelector("main");
        main.textContent = data.message;

        sessionStorage.setItem("logged", true);
        sessionStorage.setItem("username", data.data.username);
        sessionStorage.setItem("idUser", data.data.idUser);

        const h2 = document.querySelector("header h2");
        h2.textContent = data.data.username;
        getLinks();
    }
    else
    {
        for(const error of data.data.violations)
        {
            const span = document.querySelector(`[name=${error.property}]+span.erreur`);
            if(!span) continue;
            span.textContent = error.message;
        }
    }
}
async function logout()
{
    const response = await fetch("http://api.localhost/auth",{
        method: "GET",
        credentials: "include"
    });
    if(!response.ok)return;
    sessionStorage.clear();

    const main = document.querySelector('main');
    main.textContent = "Utilisateur Déconnecté";

    const h2 = document.querySelector('header h2');
    h2.textContent="Non Connecté";
    getLinks();
}