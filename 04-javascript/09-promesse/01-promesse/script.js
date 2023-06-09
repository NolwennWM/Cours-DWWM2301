"use strict";
/* 
    Par défaut, toute programmation en Javascript est dite "Synchrone"
    C'est à dire que tous le fonctionnement de la page et de JS s'arrête quand une action à lieu et ne se poursuit que quand elle est terminé.
*/
for(let i = 0; i<=1_000_000_000; i++)
{
    if(i === 1_000_000_000) console.log("Synchrone : Fin de boucle")
}
console.log("Message hors de la boucle Synchrone.");
/* 
    Cependant, en Javascript, nous avons la possibilité de faire en sorte que nos fonctions s'exécutent "Asynchrone"
    C'est à dire qu'il peut continuer d'executer du code pendant qu'une autre partie du code continue à travailler.
    C'est le cas avec "fetch" par exemple.
*/
fetch("test.json").then(res=>{
    for(let i = 0; i<=1_000_000_000; i++)
    {
        if(i === 1_000_000_000) console.log("Asynchrone : Fin de boucle")
    }
});
console.log("Message hors de la boucle Asynchrone.");

/* 
    Une fonction peut ou non retourner quelque chose (un chiffre, un string, un tableau...)
    Fetch retourne bien quelque chose, une promesse (promise)
*/
let request = fetch("test.json");
console.log(request);
/* 
    L'objet "promise" est un objet qui va contenir la promesse d'une valeur future. 
    On a pas encore le résultat, il nous indique juste que l'on va en obtenir un.
    L'objet "promise" contient 3 méthodes,
        "then()" qui prendra une fonction callback qui sera appelée une fois la promesse tenue (réussite);
        "catch()" qui prendra une fonction callback qui sera appelé une fois la promesse rejetée (échec);
        "finally()" qui prendra une fonction callback qui sera appelé une fois la promesse traitée (réussite ou échec)
*/
// fetch nous donne en argument de then le résultat de la requête
request.then(res=>console.log("then", res));
// En argument de la fonction callback de catch, l'erreur
request.catch(err=>console.log("catch", err));
// Et aucun argument pour la fonction callback de finally
request.finally(und=>console.log("finally", und));
/* 
    à noter que then, catch et finally retournent eux même la promesse utilisée, 
    ce qui permet de chaîner les méthodes de cette façon :
    request.then(...).catch(...).finally(...);

    Il est possible de résoudre plusieurs promesses en même temps.
    Pour cela on fera appel à la méthode ".all()" de la classe "Promise"
    méthode à laquelle on donnera toute les promesses que l'on souhaite résoudre.
    Une fois toute résolue, les méthodes then, catch et finally se lanceront.
*/
let r1 = fetch("test.json");
let r2 = fetch("test2.json");
// all prend en paramètre un tableau de promesse
Promise.all([r1, r2]).then(res=>{
    // then nous retourne un tableau avec les résultats des promesses
    console.log(res);
    // Je boucle sur mon tableau de réponse
    res.forEach(r=>{
        // Je traite chaque réponse comme je le fais habituellement.
        if(r.ok)
        {
            r.json().then(data=>console.log(data.prop));
        }
    });
});
/* 
    à noter que cela fonctionne bien car ce sont deux "fetch"
    Mais si on utilise des promesses différentes les une des autres, 
    Il faudra adapter le code en conséquence.

    Avec la même syntaxe que "all()", nous avons "race()" et "any()"
    qui executeront uniquement la promesse la plus rapide à s'effectuer.

    la différence entre "race()" et "any()" se fait au niveau du catch.
    "race()" lancera le "catch()" si la plus rapide des promesse échoue.
    "any()" tentera la promesse suivante, et ainsi de suite pour lancer "catch()" uniquement si toute les promesses échoues.

    Nous pouvons aussi créer nos propres promesses.
    Pour cela on va demander de créer une nouvelle promesse, qui contiendra une fonction callback avec deux arguments :
        new Promise(function(resolve, reject){})

    Ces deux arguments représente les fonctions callback appelées par then et catch.
*/
let random = new Promise((resolve, reject)=>{
    let r = Math.floor(Math.random()*10);
    if(r<5) resolve("Bravo r est plus petit que 5 !");
    else reject("Désolé, r est plus grand ou égale à 5 !");
});
random  .then(res=>console.log("then", res))
        .catch(err=>console.log("catch", err))
        .finally(()=>console.log("finally", "Mon random est terminé"));

// Exemple d'utilisation :
// Par défaut, si une fonction contient des setTimeout, JS n'attend pas la fin du timeout pour executer la suite.
function burger1()
{
    pain1();
    sauce1();
    viande1();
    salade1();
    console.log("Le burger est terminé !");
}
function pain1()
{
    setTimeout(()=>console.log("Le pain est grillé et placé"), 1000);
}
function sauce1()
{
    console.log("la sauce est versée");
}
function viande1()
{
    setTimeout(()=>console.log("La viande est cuite et placée"), 3000);
}
function salade1()
{
    console.log("La salade est placée");
}
// burger1();
// Avec promesse :
function pain2()
{
    return new Promise(resolve=>{
        setTimeout(()=>{
            resolve("Le pain est grillé et placé")
        }, 1000)
    });
}
function sauce2()
{
    return new Promise(resolve=>resolve("La sauce est placée"));
}
function salade2()
{
    return new Promise(resolve=>resolve("La salade est placée"));
}
function viande2()
{
    return new Promise(resolve=>{
        setTimeout(()=>{
            resolve("La viande est cuite et placée")
        }, 3000)
    });
}
function burger2()
{
    pain2().then(pain=>{
        console.log(pain);
        sauce2().then(sauce=>{
            console.log(sauce);
            viande2().then(viande=>{
                console.log(viande);
                salade2().then(salade=>{
                    console.log(salade);
                    console.log("Le burger est terminé");
                });
            });
        });
    });
}
/* 
    On se retrouve avec un callback hell, un enfer de callback 
    C'est à dire des fonctions dans des fonctions dans des fonctions...

    On verra dans le prochain cours comment s'en sortir.
*/