"use strict";

// Selection des éléments avec lesquels interagir.
const btnContact = document.querySelector('.contactBtn');
const modalContact = document.querySelector('.modalContact');
const formContact = document.querySelector('.modalContact form');
const inputEmail = document.querySelector('#email');
const textareaContent = document.querySelector('#content');

// Ajout des écouteurs d'évènements
if(btnContact && modalContact && inputEmail && formContact && textareaContent)
{
    btnContact.addEventListener("click", toggleContactModal);
    modalContact.addEventListener("click", e=>{
        if(e.target === modalContact)toggleContactModal();            
    });
    inputEmail.addEventListener("change", checkEmail);
    textareaContent.addEventListener("change",checkContent);
    formContact.addEventListener("submit", sendForm);
}
/**
 * Affiche ou Cache la modal du formulaire de contact.
 */
function toggleContactModal()
{
    // const document.createElement
    if(!modalContact.style.display)
    {
        modalContact.style.display = "flex";
        setTimeout(()=>modalContact.style.scale = "1", 100);
    }
    else
    {
        modalContact.style.scale = "";
        setTimeout(()=>modalContact.style.display = "", 300);
    }
        
    
}
/**
 * Vérifie si l'email est valide.
 */
function checkEmail()
{
    if(this.value.match(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,}$/))
    {
        this.style.backgroundColor = "";
        this.setCustomValidity("");
    }
    else
    {
        this.style.backgroundColor = "rgb(255,0,0)";
        this.setCustomValidity("Ceci n'est pas un email valide.");
    }
}
/**
 * Vérifie si le contenu est valide.
 */
function checkContent()
{
    if(this.value.length > 10)
    {
        this.style.backgroundColor = ""
        this.setCustomValidity("");
    }
    else
    {
        this.style.backgroundColor = "rgb(255,0,0)"
        this.setCustomValidity("Veuillez entrer au moins 10 caractères");
    }
}
function sendForm(e)
{
    e.preventDefault();
    alert("Votre message a bien été envoyé.");
    toggleContactModal();
    inputEmail.value = "";
    textareaContent.value = "";
}