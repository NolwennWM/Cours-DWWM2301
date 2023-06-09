"use strict";

const   indicator = document.querySelector('.scroll-indicator'),
        main = document.querySelector("main"),
        options = {
            /**
            * l'option root permet de changer le scrolling observé.
            *  par défaut c'est celui du document, mais si on a ajouté un scrolling sur
            *  un élément html, on pourrait faire nos observation par rapport à celui ci
            */
        // root: main
        /**
            * rootMargin permet d'étendre ou réduire la zone de détection.
            * avec un nombre positif, la détection sera hors de l'écran.
            * avec un nombre négatif, elle se fera dans une zone réduite de l'écran.
            * Que ce soit pour l'entré ou la sortie de l'élément.
            */
        // rootMargin: "200px"
        /**
            * threshold indique via un chiffre entre 0 et 1, combien de pourcentage
            * de l'élément doit être visible pour lancer l'évènement.
            */
        // threshold: 0.15
   },
        observer = new IntersectionObserver(setIndicator, options);
/* 
    L'intersection observer va nous permettre d'observer certains éléments HTML, 
    et de provoquer des réactions à l'entrée ou la sortie de l'élément lors du scrolling.

    On crée un observer avec le mot clef "new" suivi de son nom "IntersectionObserver"
    Il prendra en paramètre, une fonction callback.
    Puis optionnellement, un objet contenant ses options.

    Il faudra ensuite indiquer avec la méthode ".observe()" quel élément doit être observé.
*/
observer.observe(main);
/**
 * Fonction callback lancé par l'intersection observer défini précédement.
 * @param {Object} entries liste des éléments observés.
 */
function setIndicator(entries)
{
    /* 
        La fonction callback appelé par l'intersection observer,
        nous retourne un tableau contenant la liste des éléments observés.

        chaque élément est représenté par un objet "IntersectionObserverEntry" qui contiendra les propriétés suivantes :
            * target : pareil qu'avec les évènements, la cible qui a été intersecté.
            * isIntersecting : un boolean qui indique si l'élément est dans le viewport ou non.
            * intersectionRatio : un chiffre entre 0 et 1 indiquant le pourcentage visible de l'élément.
            * boundingClientRect : position et taille de notre élément.
            * intersectionRect : position et taille VISIBLE de notre élément.
            * rootBounds : position et taille de l'élément racine (par défaut le viewport)
    */
    console.log(entries);
    // Je travail sur un seul élément observé, autant le récupérer dans une variable plutôt que de retaper [0] à chaque fois.
    let entry = entries[0];
    /* 
        Pour économiser de la puissance de mon navigateur,
        Je met mon évènement au scroll, si mon main est visible,
        et je le retire si mon main est invisible.
    */
    if(entry.isIntersecting)
    {
        window.addEventListener("scroll", indicatorAnimation);
    }
    else
    {
        window.removeEventListener("scroll", indicatorAnimation);
    }

}

function indicatorAnimation()
{
    /* 
        window.scrollY représente combien de pixel on a scroll
        main.offsetTop représente la position par rapport au haut de la page de notre élément.
    */
    if(window.scrollY > main.offsetTop)
    {
        /* 
            main.scrollHeight représente la hauteur de l'élément incluant le padding vertical.
            .toFixed(2) retourne un string correspondant à notre nombre avec "n" chiffres après la virgule.
        */
        const prc = ((window.scrollY- main.offsetTop)/main.scrollHeight).toFixed(2);
        // console.log(prc);
        indicator.style.transform = `scaleX(${prc})`;
    }
    else
    {
        indicator.style.transform = `scaleX(0)`;
    }
}
/**
    On peut arrêter l'obersation d'un élément avec :
    variableObserver.unobserve(élément observé);
    ici ça donnerait :
    observer.unobserve(main);
    
    On peut arrêter toute observation de notre observer avec:
    variableObserver.disconnect()
    ici:
    observer.disconnect();
    
    Chaque observer étant lié à une fonction, si on veut lancer des observations
    au fonctionnement totalement différent, il vaudra mieux créer un nouvel observer.
 */