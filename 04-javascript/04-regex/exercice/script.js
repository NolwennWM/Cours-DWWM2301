/**
    1.Le champ nom d'utilisateur doit tourner au rouge si 
    il contient autre chose que des lettres, - ou _;

    2.Le champ téléphone doit passer au rouge si le ce qui est entré
    ne correspond pas à un numéro de téléphone.

    3.Le champ email doit passer au rouge si ce qui est entré ne 
    correspond pas à un email.

    4.Ajouter une barre de progression qui change de couleur
    et se rempli à chaque fois que l'utilisateur sécurise 
    un peu plus sont mdp :
        -lettre minuscule.
        -lettre majuscule.
        -chiffre.
        -caractère spécial.
        -au moins 8 caractère.
        
    5. le champ mdp bis doit tourner au rouge si il ne correspond 
    pas au champ mdp.
    (le changement au rouge peut être personalisé autrement,
    l'important est de montrer à l'utilisateur qu'il se trompe)
 */

const u = document.getElementById("user");
u.addEventListener("input", function(e)
{
    const username = e.target.value;
    const regex = /^[a-zA-Z-]*$/;
    const v1 = regex.test(username);
    if(!v1)
    {
        u.style.backgroundColor = "red";
    }
    else
    {
        u.style.backgroundColor = "";
    }
})
const e = document.getElementById("email");
e.addEventListener("input", function(b)
{
    const email = b.target.value;
    const regex = /^[a-zA-Z0-9.%+-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,}$/;
    const v2 = regex.test(email);
    if(!v2)
    {
        e.style.backgroundColor = "red";
    }
    else
    {
        e.style.backgroundColor = "";
    }
})
const t = document.getElementById("tel");
t.addEventListener("input", function(e)
{
    const telephone = e.target.value;
    const regex = /^(\+33|0)\d([\s\.\-]?\d{2}){4}$/;
    const v3 = regex.test(telephone);
    if(!v3)
    {
        e.style.backgroundColor = "red";
    }
    else
    {
        e.style.backgroundColor = "";
    }
})

const mdpInput = document.getElementById("pass");
const progressBar = document.querySelector(".progress");
let strength = 0;
progressBar.style.width = strength + "%";

mdpInput.addEventListener("input", checkPasswordStrength);

function checkPasswordStrength()
{
    let lowerCase = mdpInput.value.match(/[a-z]/);
    let upperCase = mdpInput.value.match(/[A-Z]/);
    let numbers = mdpInput.value.match(/[0-9]/);
    let specialCharacters = mdpInput.value.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/);
    if(lowerCase)
    {
        strength = 20;
        progressBar.style.backgroundColor = "black";
    }
    if(lowerCase && upperCase)
    {
        strength = 40;
        progressBar.style.backgroundColor = "red";
    }
    if((lowerCase && upperCase) || (lowerCase && numbers) || (lowerCase && specialCharacters) || (upperCase && numbers) || (upperCase && specialCharacters) || (numbers && specialCharacters))
    {
        strength = 60;
        progressBar.style.backgroundColor = "orange";
    }
    if((lowerCase && upperCase && numbers)|| (lowerCase && upperCase && specialCharacters) || (lowerCase && numbers && specialCharacters) || (upperCase && numbers && specialCharacters) )
    {
        strength = 80;
        progressBar.style.backgroundColor = "blue";
    }
    if(lowerCase && upperCase && numbers && specialCharacters )
    {
        strength = 100;
        progressBar.style.backgroundColor = "green";
    }
    progressBar.style.width = strength + "%";
}
const passwordConfirmInput = document.querySelector('#passBis');
const form = document.querySelector('form');

function validateForm(e)
{
    if(mdpInput.value !== passwordConfirmInput.value)
    {
        e.preventDefault();
        passwordConfirmInput.style.backgroundColor = "#FFDDDD";
    }
}
form.addEventListener("submit", validateForm);