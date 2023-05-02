const articles = document.querySelectorAll("#articles article");

for(let i = 0; i<articles.length; i++)
{
    let btn = document.createElement("button");
    btn.setAttribute("id", [i]);
    btn.textContent = "Supprimer";
    articles[i].append(btn);
    btn.style.position = "absolute";
    btn.style.backgroundColor = "cadetblue";
    btn.style.borderRadius = "15px";
    btn.style.padding = "5px";
    btn.style.border = "2px solid black";
    btn.style.right = "0";
    btn.style.top = "50%";
    btn.style.opacity = "0.2";
    btn.style.transition = "opacity 1s";
    btn.style.transform = "translate(50%, -50%)";
}
const btns = document.querySelectorAll("article button");

btns.forEach(function(i){
    i.addEventListener("click", function(e){
        let result = confirm("Êtes vous sûr de vouloir supprimer ?")
        if(result == true)
        {
            articles[e.target.id].remove();
        }
    })
    i.addEventListener("mouseleave", disappear)
    i.addEventListener("mouseenter", appear)
})
function disappear(e)
{
    e.target.style.opacity = "0.2";
}
function appear(e)
{
    e.target.style.opacity = "1";
}

const pf = document.querySelector(".right");
const foo = document.querySelector(".bottom");
const contactButton = document.createElement("button");

contactButton.innerHTML = "Nous Contacter";
contactButton.style.fontSize = "2rem";
contactButton.style.left = "48%";
contactButton.style.bottom = "200%";
contactButton.style.justifyContent = "center";
contactButton.style.position = "relative";
contactButton.style.display = "block";

pf.style.visibility = "hidden";

foo.append(contactButton);

contactButton.addEventListener("click",()=>pf.style.visibility = "visible");