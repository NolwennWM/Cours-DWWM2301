"use strict";

fetch("tab.json").then(response=>{
    if(response.ok)
    {
        response.json().then(data=>{
            tri(data).then(tab=>{
                console.log(tab);
            })
        })
        .catch(err=>console.error(err));
    }
})
/* 
    Les promesses sont bien pratique mais peuvent provoquer ce qu'on appelle un callback hell, 
    Un enfer de callback, c'est à dire des fonctions dans des fonctions et ainsi de suite, on perd en lisibilité.

    JS a résolue ça grâce aux mots clefs "async" et "await".
    "async" s'utilise devant une fonction qui aura pour rôle d'accueillir les promesses.
    "await" s'utilise devant les fonctions qui retournent une promesse.

    "await" indique à JS qu'il doit attendre la fin de la promesse avant de continuer le code.
*/
exemple();
async function exemple()
{
    let resp = await fetch("tab.json");
    console.log(resp);
    if(resp.ok)
    {
        /* 
            avec "await" le catch n'est plus géré,
            il faudra alors utiliser un "try catch" pour capturer les erreurs.
        */
        try{
            let data = await resp.json();
            let tab = await tri(data);
            console.log(tab);
        }
        catch(err)
        {
            console.error(err);
        }
    }
}
burger();
async function burger()
{
    console.log(await pain2());
    console.log(await sauce2());
    console.log(await viande2());
    console.log(await salade2());
    console.log("Mon burger est terminé");
}

// ------ fonctions du cours précédent : -----------
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
function tri(tab){
    return new Promise((resolve, reject)=>{
        tab.sort((a,b)=>{
            if(typeof(a) !== typeof(b)){
                reject("Tous les éléments du tableau ne sont pas de même type.");
            }
            return a-b;
        })
        resolve("Le tableau a été correctement trié");
    });
}