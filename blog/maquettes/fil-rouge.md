# Fil rouge DWWM #

Le but de ce fil rouge est de construire un blog que l'on va améliorer avec les différentes technologies que l'on va rencontrer au fur et à mesure de la formation.

## 01. HTML ##

La première étape est de construire un HTML respectant les règles du W3C.

## 02. CSS ##

Maintenant que nous avons une structure de base pour notre site, il serait bon d'ajouter un peu de couleur et de placer nos éléments comme souhaité.

### 01. Selection et Propriétés ###

Avant de choisir des couleurs définitives pour notre site, donner des couleurs qui ressortent bien à nos éléments principaux peut aider à les placer par la suite.

On verra par la suite des propriétés CSS aidant au placement des éléments HTML. Donc si il reste des défauts dans cette version, ce n'est pas très grave.
On est ici sur un premier jet uniquement.

### 02. Placement et Responsive ###

Le placement des éléments a dû être quelques peu compliqué jusqu'ici. Mais on a vu deux propriétés qui vont grandement nous aider, Flex et Grid.

Il va aussi falloir que notre site soit responsive, c'est à dire qu'il doit s'adapter à toute taille d'écran.
Si on souhaite suivre les conventions actuelles, nous allons devoir penser notre site avant tout pour un format mobile puis l'adapter aux tablettes et ordinateurs.

On peut faire des changements à toute taille d'écran possible, au format **landscape** ou **portrait** mais généralement je me contente de deux **breakpoint**.
Un premier à **500px** et un second à **900px**.

Mes media queries se suivent généralement, c'est à dire qu'à **900px** les règles de ma query à **500px** sont toujours actives. Mais on pourrait très bien décider de faire des règles actives uniquement entre **500px** et **900px**.

### 03. Transition et Animation ###

Notre site commence à avoir une structure tout à fait fonctionnelle, il va maintenant être temps de le rendre un peu plus vivant avec des transitions et animations.

Sauf que notre feuille de style fait déjà plusieurs centaines de lignes. On peut facilement se perdre à force de monter et descendre dans notre fichier.

Utilisons donc la règle d'import pour diviser notre fichier.
Personnellement mon fichier de base ne contiendra que les imports, et je diviserais le reste entre 7 autres fichiers.

J'irais ensuite placer les transitions dans les fichiers correspondant et je ferais un 8ème fichier pour les keyframes.

Cela dit, ce tri est mon choix personnel, et aucune règle ou convention n'entre ici en jeu. L'important est d'avoir une logique de rangement claire afin que n'importe qui puisse s'y retrouver.

## 03. Javascript ##

Maintenant nous allons ajouter un peu plus de dynamisme à notre blog.
Pour cela ajoutons des fichiers JS ayant différents effets en lien avec les actions de notre utilisateur.

### 01. Supprimer nos Articles ###

Il faudrait ajouter un bouton à nos articles permettant de supprimer ceux ci.
Bien sûr on demandera confirmation à l'utilisateur avant de supprimer l'article, cela pour éviter toute erreur involontaire.

(actuellement nous n'avons pas de base de donnée, les articles seront donc supprimé de la page mais une fois actualisé, ils reviendront.)

### 02. Formulaire de Contact ###

Nous allons maintenant remplacer le formulaire de contact par un bouton "Nous contacter".

Celui ci ouvrira une modal contenant le formulaire de contact.
Si on clique hors du formulaire, celui ci se fermera.

Si on rentre un texte ne correspondant pas à un email dans le champ adapté, le formulaire refusera de s'envoyer.

Si on rentre moins de 10 caractères dans notre champ texte, le formulaire refusera aussi de s'envoyer.

Si tout est bon, alors on enverra le formulaire.
(On n'a pas encore fait de back, on se contentera alors d'une alerte indiquant l'envoi du message et de la modale qui se ferme)
