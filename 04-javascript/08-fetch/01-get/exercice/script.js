fetch("../hero.json").then(chooseHeroes);
let heroes;
function chooseHeroes(response)
{
    console.log(response);
    if(response.ok)
    {
        response.json().then(showHero);
    }
    else
    {
        console.error(response.status, response.statusText);
    }
}

function showHero(data)
{
    heroes = data.members;
    const select = document.createElement("select");
    for(let i = 0; i < data.members.length; i++)
    {
        const option = document.createElement("option");
        option.textContent = data.members[i].name;
        option.value = i;
        select.appendChild(option);
    }
    document.body.appendChild(select)
    select.addEventListener("change", showIdCard);
}

function showIdCard(e)
{
    const data = heroes[e.target.value];
    console.log(heroes, e.target.value);
    const article = document.createElement("article");
    article.textContent = `${data.name}, ${data.age}, ${data.secretIdentity}, ${data.powers}`;
    document.body.append(article);
}