"use strict";

const tab1 = [2, 12, 1, 67, 6, 9];
const tab2 = [2, 12, 1, "67", 6, 9];

function tri(tab)
{
    return new Promise((resolve, reject)=>{
        tab.sort((a,b)=>a-b);
        for(let i = 0; i<tab.length-1; i++)
        {
            if(typeof tab[i] !== typeof tab[i+1])
            {
                reject(new Error("On ne peut pas trier des éléments avec des types différents"));
            }
        }
        resolve(tab)
    })
}
tri(tab1)
tri(tab2)
console.log(tab1);

// exercice 2 :

function sleep(feu)
{
    return new Promise(resolve=>setTimeout(resolve, feu));
}
function runTraficLight()
{
        document.querySelector(".feuvert").style.backgroundColor = "green";
        sleep(3000).then(()=>{
            document.querySelector(".feuvert").style.backgroundColor = "transparent";
            document.querySelector(".feuorange").style.backgroundColor = "orange";
            sleep(1000).then(()=>{
                document.querySelector(".feuorange").style.backgroundColor = "transparent";
                document.querySelector(".feurouge").style.backgroundColor = "red";
                sleep(2000).then(()=>{
                    document.querySelector(".feurouge").style.backgroundColor = "transparent";
                    runTraficLight()
                })
            })
        })
}
runTraficLight();