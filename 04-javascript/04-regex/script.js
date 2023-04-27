"use strict";
/* 
    Les REGEX ou Expressions Régulières, 
    permettent de rechercher la présence ou la non présence,
    de certains caractères dans un string.

    Elles sont souvent utilisées pour vérifier si un string correspond à un email, un mot de passe ou un numéro de téléphone par exemple.

    Elles sont utilisable dans de nombreux langages.

    En JS elles commenceront et finiront par un "/"
*/
const r1 = /ou/;
const r2 = /[ou]/;
/* 
    Les REGEX sont utilisablent avec de nombreuses fonction javascripts.
    dont la première est ".test" qui s'utilises sur une regex et prend un string en paramètre.
    Elle retournera un boolean
*/
// r1 recherche la présence de "ou"
console.log(r1, r1.test("Bonjour"), r1.test("Salut"));
// r2 recherche la présence de "o" ou "u"
console.log(r2, r2.test("Bonjour"), r2.test("Salut"));

const r3 = /^ou/;
// r3 recherche la présence d'un "ou" en début de string
console.log(r3, r3.test("Bonjour"), r3.test("outre"));

const r4 = /ou$/;
// r4 recherche la présence d'un "ou" en fin de string
console.log(r4, r4.test("Bonjour"), r4.test("Mou"));

const r5 = /ou|oi/;
// r5 recherche la présence d'un "ou" ou d'un "oi"
console.log(r5, r5.test("Bonjour"), r5.test("Bonsoir"));

const r6 = /[a-z]/;
// r6 recherche la présence de n'importe quel caractère entre "a" et "z"
console.log(r6, r6.test("Bonjour"), r6.test("06.08.97.86.54"), r6.test("20h31"));

const r7 = /[^a-z]/;
// r7 recherche la non présence de n'importe quel caractère entre "a" et "z"
console.log(r7, r7.test("bonjour"), r7.test("06.08.97.86.54"), r7.test("20h31"));

const r8 = /(ou)?/;
// r8 recherche la présence ou non présence de "ou";
console.log(r8, r8.test("Bonjour"), r8.test("Pizza"));

const r9 = /(ou)+/;
// r9 recherche la présence de "ou", une fois ou plus;
console.log(r9, r9.test("Bonjour"), r9.test("Pizza"));

const r10 = /(ou)*/;
// r10 recherche la présence de "ou", 0 fois ou plus;
console.log(r10, r10.test("Bonjour"), r10.test("Pizza"));

const r11 = /ou{2}/;
// r11 recherche la présence de "o" suivi de "u" deux fois.
console.log(r11, r11.test("Bonjour"), r11.test("Bonjouur"));

const r12 = /(ou){2}/;
// r12 recherche la présence de "ou" deux fois.
console.log(r12, r12.test("Bonjour"), r12.test("Bonjouour"));

const r13 = /(ou){2,4}/;
// r13 recherche la présence de "ou" de 2 à 4 fois.
console.log(r13, r13.test("Bonjour"), r13.test("Bonjououour"));

const r14 = /(ou){2,}/;
// r14 recherche la présence de "ou" au moins 2 fois.
console.log(r14, r14.test("Bonjour"), r14.test("Bonjououour"));

const r15 = /\^Bon/;
/*
    r15 recherche la présence de "^Bon". "\" échape le caractère, 
    C'est à dire qu'il retire le rôle que possède normalement ce caractère. 
*/
console.log(r15, r15.test("Bonjour"), r15.test("^^Bonjour"));

const r16 = /\s/;
/* 
    r16 recherche la présence d'un espace.
    un "\" devant un caractère qui n'a normalement aucun rôle
    peut au contraire lui en donner un.
*/
console.log(r16, r16.test("Bonjour tout le monde !"), r16.test("Bonjour"));

const r17 = /\d/;
// r17 recherche la présence d'un chiffre. (équivalent à [0-9])
console.log(r17, r17.test("Bonjour 8 fois"), r17.test("Bonjour"));

const r18 = /./;
// r18 recherche la présence de n'importe quel caractère.
console.log(r18, r18.test("Bonjour"), r18.test("42"), r18.test("?_?"));

const r19 = /(ou|oi).*\1/;
/* 
    r19 recherche la présence d'un "ou" ou d'un "oi" puis de n'importe quel nombre de caractère et enfin le même résultat que la parenthèse 1.

    Un "\" devant un chiffre indique que l'on veut le même résultat que la parenthèse correspondant au chiffre.
*/
console.log(r19, r19.test("Bonsoir 8 fois"), r19.test("Coucou"), r19.test("Bonjour 8 fois !"));

// ------------------ Match ------------------------
const phrase = "J'aime la pizza, les cannelés, et les okonomiyakis";
/* 
    Match retourne un tableau, contenant ce que la regex trouve.
    à la différence de test, match s'utilise sur un string et prend la regex en paramètre.
*/
console.log(phrase.match(/pizza/));
// Par défaut, une regex s'arrête au premier résultat trouvé.
console.log(phrase.match(/les/));

/* 
    Une regex peut recevoir certains caractères après sont "/" final
    Ceux ci ajouteront certaines règles à la regex.
    On les appelles "flag".

    g signifie global et permet que la regex ne s'arrête pas au premier résultat.
*/
console.log(phrase.match(/les/g));

const phrase2 = "Vive les regex et vive Javascript !";
// Les regex sont sensible à la casse (minuscule, majuscule)
console.log(phrase2.match(/vive/g));
// le flag "i" permet de rendre la regex insensible à la casse.
console.log(phrase2.match(/vive/gi));

// ------------------- replace ----------------------

/* 
    replace s'utilise sur un string et prend en premier paramètre,
    soit un string, soit une regex.
    Il remplacera le résultat par le second paramètre.
*/
console.log(phrase.replace("pizza", "salade"));
console.log(phrase.replace(/pizza/, "salade"));
// On pourra utiliser les regex pour une recherche plus complexe qu'un simple mot.
console.log(phrase.replace(/pizza|okonomiyaki|cannelé/g, "salade"));
// le second paramètre de replace peut prendre "$&" pour non plus remplacer mais ajouter un élément.
console.log(phrase2.replace("Javascript", "$& et CSS"));

// liste de mot à censurer :
const censure = ["regex", "javascript"];
/* 
    new RegExp permet de créer une regex à partir d'un string.
    il prendra en premier paramètre, la regex sous forme de string
    et en second paramètre, les flag sous forme de string aussi.

    ici je fusionne mon tableau de mot à censurer en les séparant d'un "|" pour obtenir ma regex.
        /regex|javascript/gi
*/
const regCensure = new RegExp(censure.join("|"), "gi");

console.log(phrase2.replace(regCensure, "*********"));

// ------------- flag bonus -----------------

const phrase3 = 
`1er : Maurice
2ème : Paul
3ème : Charli`;
// On obtient seulement "1" car notre string commence par "1"
console.log(phrase3.match(/^\d/g));
// On obtient "1", "2" et "3" car avec le flag "m" chaque ligne est géré indépendemment.
console.log(phrase3.match(/^\d/gm));