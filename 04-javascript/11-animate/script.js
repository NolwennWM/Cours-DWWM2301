"use strict";

const div = document.querySelector('.anime');

document.querySelector(".b1").addEventListener("click", animation1);
document.querySelector(".b2").addEventListener("click", animation2);
document.querySelector(".b3").addEventListener("click", animation3);
document.querySelector(".b4").addEventListener("click", animation4);
document.querySelector(".b5").addEventListener("click", animation5);

function animation1()
{
    /* 
        La méthode animate de JS prend deux arguments,
        Le premier est la liste des keyframes que l'élément HTML devra parcourir.
        Le second est un objet contenant les options de l'animation.

        Les keyframes peuvent être présentées sous deux formes, 
        la première étant un tableau contenant des objets :
    */
    const keyframes = [
        {left: 0, top: 0},
        {left: "80%", top: "-200px"},
        {left: "20%", top: "500px"}
    ];
    const options = {
        duration: 2000,
        iterations: 3,
        fill: "forwards",
        direction: "alternate"
    };
    div.animate(keyframes, options);
}

function animation2()
{
    // Les keyframes peuvent aussi être un objet dont chaque propriété est un tableau
    const keyframes = {
        backgroundColor: ["blue", "red", "green"],
        opacity: [1, 0, 0.5]
    };
    div.animate(keyframes, {
        duration: 2000,
        direction: "alternate",
        iterations: 2
    });
}
function animation3()
{
    /* 
        On peut récupérer la valeur de retour de animate
        Afin d'obtenir un objet possèdant plusieurs méthodes 
    */
    let anime = div.animate({
    transform: ["skew(0deg, 0deg)","skew(360deg, 360deg)","skew(0deg, 360deg)"]
    },{
    duration: 1000,
    iterations: 1
    });
    console.log(anime);
    //  On peut par exemple utiliser l'évènement "finish" pour attendre la fin de l'animation
    anime.addEventListener("finish", ()=>{
        document.querySelector(".b4").style.opacity = 1;
    });  
}
let a4 = false;
function animation4()
{
    if(a4)
    {
        // On peut annuler une animation et la remettre à 0 avec cancel()
        a4.cancel();
        a4 = false;
    }
    else
    {
        a4 = div.animate({borderRadius: ["0","50%", "5px", "25%"]},
        {duration : 2500, fill:"forwards"});
    }
}
/* 
    La méthode animate n'est qu'un raccourci pour l'utilisation des objets suivants :
    - KeyframeEffect qui prend 3 arguments
        l'élément HTML cible, les keyframes puis les options
*/
const keyframes = new KeyframeEffect(
    div,
    [{transform: "translate(0,0)"}, {transform: "translate(100%, 50%)"}],
    {duration: 3000, fill: "forwards"}
);
/* 
    Et l'objet Animation qui prend deux arguments :
        L'objet keyframeEffect et la timeline à laquelle il est lié.
*/
const anime5 = new Animation(keyframes, document.timeline);
console.log(anime5);

async function animation5()
{
    const b5 = document.querySelector('.b5');
    // la propriété playState indique l'état de l'animation :
    switch(anime5.playState)
    {
        case "idle":
            anime5.play();
            b5.textContent = "Pause";
            await anime5.finished;
            b5.textContent = "Reverse";
            break;
        case "running":
            anime5.pause();
            b5.textContent = "Continue";
            break;
        case "paused":
            anime5.play();
            b5.textContent = "Pause";
            break;
        case "finished":
            anime5.reverse();
            await anime5.finished;
            b5.textContent = "Start";
            // Je remet le sens initial puis annule tout de suite.
            anime5.reverse();
            anime5.cancel();
    }
}