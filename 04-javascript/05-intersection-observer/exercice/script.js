"use strict";
/**
 * ---------------- EXO 1 --------------------
 * 1. Rendre tous les paragraphes du main, invisible.
 * 2. Ajouter Une observation sur chaque paragraphes.
 * 3. Lorsque l'élément est au moins à moitié dans le viewport, le rendre visible.
 * 4. Désactiver la détection de l'élément une fois l'action terminé.
 * (Bonus). Faire venir le paragraphe depuis le côté.
 * ---------------- EXO 2 ----------------------
 * 1. Lorsque le dernier paragraphe est à 200px en dessous du viewport.
 *      Créer 10 paragraphes et les ajouter à la suite du main.
 * 2. Désactiver la détection du précédent dernier paragraphe.
 * 3. Ajouter l'animation de l'exercice 1 aux nouveaux paragraphes.
 * 4. Ajouter la détection du dernier paragraphe au nouveau dernier paragraphe.
 */

var paragraphe = document.getElementsByTagName("p");
var observer2 = new IntersectionObserver(function(entries){
    // console.log("coucou");
    for(var i = 0; i<entries.length;i++)
    {
        if(entries[i].isIntersecting)
        {
            entries[i].target.classList.add("visible");
            observer2.unobserve(entries[i].target);
        }
        entries[i].target.addEventListener("transitionend", (e)=>{
            e.target.style.transform = "translateX(0)";
        })
    }
}, {threshold: 0.5});

for(var i = 0; i <paragraphe.length; i++)
{
    observer2.observe(paragraphe[i]);
}

// exo 2 :

const lastP = document.querySelector("main p:last-child");
const obsLast = new IntersectionObserver(addMore, {rootMargin: "200px"});
const m = document.querySelector("main");

obsLast.observe(lastP);

function addMore(entries)
{
    let ent = entries[0];
    if(ent.isIntersecting)
    {
        let p;
        for(let i = 0; i<10; i++)
        {
            p = document.createElement("p");
            p.textContent = "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Esse impedit neque non sit repudiandae unde consequatur nihil magni. Laudantium eligendi sit ipsa fugiat maxime! Libero adipisci dolor porro quod molestias!"
            m.appendChild(p);
            observer2.observe(p);
        }
        obsLast.unobserve(lastP);
        obsLast.observe(p);
    }
}