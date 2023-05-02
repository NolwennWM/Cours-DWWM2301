"use strict";
const boutons = document.querySelectorAll('.delete');

boutons.forEach(btn => btn.addEventListener("click", deleteArticle));
/**
 * Demande confirmation avant de supprimer l'article lié
 * @param {MouseEvent} e 
 * @returns 
 */
function deleteArticle(e)
{
    e.preventDefault();

    if(!confirm("Êtes vous sûr de vouloir supprimer cet article ?"))return;

    const article = this.closest("article");
    
    if(!article)return;
    article.remove();
}