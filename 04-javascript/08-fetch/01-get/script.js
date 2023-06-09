"use strict";

/* 
    Asynchronus Javascript and Xml (AJAX)
    C'est le fais d'envoyer des requêtes asynchrones via Javascript.
    Ces requêtes sont envoyés à un serveur qui nous retournera ou pas, une information.

    Par défaut, un code JS est synchrone, 
    C'est à dire, que chaque action attend que la précédente soit effectué avant de se lancer.
    L'asynchrone indique que le code peut continuer à s'executer alors que l'action précédente n'est pas terminé.

    C'est particulièrement utile avec des requêtes, car on n'a pas besoin d'attendre une réponse du serveur pour que notre code continue de fonctionner.

    Voyons deux façons de lancer une requête:
        1. l'original, XMLHttpRequest
        2. la moderne, fetch
*/
const url = "./hero.json";
// Je crée un nouvel objet XMLHttpRequest:
const xhttp = new XMLHttpRequest();
// On donne à notre objet, un écouteur d'évènement, qui sera lancé à chaque changement d'état de la requête:
xhttp.onreadystatechange = handleRequest;
/* 
    la méthode "open" permet d'indiquer les paramètres de la requête.
    En premier, on indique la méthode utilisé (GET, POST...)
    En second, l'url à laquelle envoyer la requête.
    En troisième, si la requête est asynchrone ou non.
*/
xhttp.open("GET", url, true);
// On envoie la requête
xhttp.send();
function handleRequest()
{
    /* 
        Lors de la requête, XMLHttpRequest passe par 4 états, nous nous interesseront qu'à l'état 4 qui indique que la requête est terminée.

        Le code de status, lui indique le status de la requête, 
        Les status sont divisés comme tel :
        1XX : Indique une simple information
        2XX : Indique que tous s'est bien passé
        3XX : Indique qu'il y a eu une redirection
        4XX : Indique qu'il y a eu une erreur côté client
        5XX : Indique qu'il y a eu une erreur côté server
    */
    console.log(xhttp.readyState, xhttp.status);
    // Si la requête est terminée et que tout s'est bien passé
    if(xhttp.readyState == 4 && xhttp.status == 200)
    {
        let success, data;
        /* 
            Try catch permet d'"essayer" un code qui se trouve entre les accolades de "try";
                * Si tout se passe bien, rien de particulier n'arrive.
                * Si il y a une erreur, elle sera capturé (et non affiché),
                    empêchant ainsi le code JS de planter totalement.
                    L'erreur se retrouvera dans l'argument de "catch", et ce qui se trouve entre les accolades de "catch" sera lancé.
            Optionnellement on peut ajouter "finally" qui sera lancé après le try catch peu importe si il y a une erreur ou non.
        */
        try
        {
            // responseText contient la réponse du serveur sous forme de string.
            console.log(xhttp.responseText);
            data = JSON.parse(xhttp.responseText);
            success = true
        }
        catch(e)
        {
            console.error(e.message + " DANS -> " + xhttp.responseText);
            success = false;
        }
        finally
        {
            if(success)
            {
                console.log(data);
                document.body.innerHTML = `<h1>${data.squadName}</h1>`;
            }
        }
    }
}
// ----------------- Fetch  -------------------

/* 
    fetch est automatiquement asynchrone et par défaut en "GET"
    Nous n'avons donc qu'à lui donner l'url.
    Puis il utilisera la méthode "then" pour indiquer quoi faire du résultat de la requête via une fonction callback.
*/
fetch(url).then(handleFetch);

function handleFetch(response)
{
    // On reçoit en argument de notre fonction callback, un objet contenant les informations de la requête.
    console.log(response);
    // La propriété "ok" est un boolean indiquant si la requête s'est bien passé.
    if(response.ok)
    {
        /* 
            fetch est accompagné d'une méthode "json" ayant le même effet que JSON.parse()
            Si ce n'est qu'elle se fera suivre d'un "then" et d'un "catch" pour gérer ce qui se passe une fois le json traduit ou si il y a une erreur.

            then et catch prendront des fonctions callback
        */
        response.json()
            .then(showResult)
            .catch(error=>console.log(error));
    }
    else
    {
        console.error(response.status, response.statusText);
    }
}
function showResult(data)
{
    document.body.innerHTML += `<h2>${data.homeTown}</h2>`;
}