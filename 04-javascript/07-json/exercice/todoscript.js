"use strict";
/*
    1. Créer une todo list. à chaque appui sur le bouton ajout,
        créer un nouvel élément dans la liste.
        cet élément doit contenir la valeur de l'input et une croix.
        On en profitera pour vider l'input.
    2. le clique sur un élément de la liste lui ajoutera une classe qui aura pour 
        effet de barrer l'élément.
    3. le clique sur la croix supprimera l'élément concerné.
    4. sauvegarder la liste en localstorage.
    5. afficher la liste sauvegardé au chargement de la page.
    6. éditer la liste lorsque l'on coche ou supprime un élément.
    Bonus : Utiliser le drag and drop pour déplacer nos éléments dans la liste. il faudra penser à sauvegarder les éléments déplacé.
 */
var newTaskInput = document.getElementById("new-task");
var addTaskButton = document.getElementById("add-task");
var taskList = document.getElementById("task-list");
let todos = [];

addTaskButton.addEventListener("click", function(){
    createLi(newTaskInput.value);
    todos.push(newTaskInput.value);
    addToLocalStorage(todos);
    newTaskInput.value = "";
});

function createLi(value)
{
    var newTask = document.createElement("li");
    newTask.innerText = value;
    newTask.classList.add("task");
    newTask.addEventListener("click", function(){
        newTask.classList.toggle("completed");
    });
    var deleteButton = document.createElement("button");
    deleteButton.innerText = "X";
    deleteButton.addEventListener("click", function(){
        taskList.removeChild(newTask);
        // Défaut de cette solution, supprimer le premier élément trouvé si deux ont le même nom.
        todos.splice(todos.indexOf(value), 1);
        addToLocalStorage(todos);
    })
    newTask.appendChild(deleteButton);
    taskList.appendChild(newTask);
}

function addToLocalStorage(todos)
{
    localStorage.setItem("todo", JSON.stringify(todos));
}

function getFromLocalStorage()
{
    const todoStr = localStorage.getItem("todo");
    if(todoStr)
    {
        todos = JSON.parse(todoStr);
        todos.forEach(createLi);
    }
        
}
getFromLocalStorage();