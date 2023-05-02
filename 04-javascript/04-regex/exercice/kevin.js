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

const inputs = document.querySelectorAll('input:not([type="submit"]):not(#passBis)'),
pass = document.querySelector("#pass"),
bisPass = document.querySelector("#passBis"),
progress = document.querySelector(".progress"),
patterns = {
    tel: /^(\+33|0)\d([\s\.\-]?\d{2}){4}$/,
    email: /^([a-z\d\.-]+)@([a-z\d-]+)\.([a-z]{2,8})(\.[a-z]{2,8})?$/,
    username: /^[A-Za-z\-_]+$/,
    password: /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/,
};

inputs.forEach(input=>
{
    input.addEventListener("change", (e)=>{
        validate(e.target, patterns[e.target.attributes.name.value])
    })
});
const validate = (target, regex)=>
{
    const valid = regex.test(target.value);
    if(valid)
    {
        target.style.borderColor = "";
        target.style.backgroundColor = "";
    }
    else
    {
        target.focus();
        target.style.borderColor = "red";
        target.style.backgroundColor = "rgba(255, 0, 0, 0.5)";
    }
}

function bisCheck()
{
    if(bisPass.value != pass.value)
    {
        bisPass.style.borderColor = "red";
        bisPass.style.backgroundColor = "rgba(255, 0, 0, 0.5)";
    }
    else
    {
        bisPass.style.borderColor = "";
        bisPass.style.backgroundColor = "";
    }
}
function passCheck()
{
    var regex = [
        "[A-Z]", "[a-z]", "[0-9]", "[!@#$%^&*]", ".{8,}"
    ];
    // var regex = new Array();
    // regex.push("[A-Z]");
    // regex.push("[a-z]");
    // regex.push("[0-9]");
    // regex.push("[!@#$%^&*]");
    // regex.push(".{8,}");
    let p = 0;
    for(var i = 0; i < regex.length; i++)
    {
        if(new RegExp(regex[i]).test(pass.value))
        {
            p++
        }
    }
    switch(p)
    {
        case 0:
            progress.style.width = "0";
            progress.style.backgroundColor = "";
            break;
        case 1:
            progress.style.width = "20%";
            progress.style.backgroundColor = "red";
            break;
        case 2:
            progress.style.width = "40%";
            progress.style.backgroundColor = "orangered";
            break;
        case 3:
            progress.style.width = "60%";
            progress.style.backgroundColor = "orange";
            break;
        case 4:
            progress.style.width = "80%";
            progress.style.backgroundColor = "yellow";
            break;
        case 5:
            progress.style.width = "100%";
            progress.style.backgroundColor = "green";
            break;
    }
}
pass.addEventListener("input", passCheck);
bisPass.addEventListener("change", bisCheck);