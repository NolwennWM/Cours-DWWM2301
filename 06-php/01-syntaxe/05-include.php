<?php 
/* 
    Nous avons créé trois fichiers partiels, 
    - _header.php
    - _footer.php
    - _nav.php

    Cette façon de nommer des fichiers avec "_" est une convention 
    indiquant que ces fichiers ne doivent pas être ouvert seul.

    Nous allons ensuite les importer ici.
    Pour cela nous utiliseront soit "include" soit "require"
*/
$title = "Include";
$mainClass = "includeNav";
/* 
    La différence en require et include, 
    Se fait en cas d'erreur.
    include provoquera un warning, mais la page continuera de fonctionner.
    require provoquera une fatal error, mettant fin au code.
*/
require "../ressources/template/_header.php";
include "../ressources/template/_nav.php";
?>
<!-- div>p#para$*5>lorem -->
<div>
    <p id="para1">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam sit expedita labore corporis reiciendis debitis quaerat provident nesciunt dolorem dolor, laudantium laborum sint cupiditate ab non, architecto repellendus et quidem.
    </p>
    <p id="para2">
        Repellendus, quae modi! Doloremque reprehenderit, inventore consequuntur ad odit atque quod corporis! Architecto sint aspernatur accusantium atque! Obcaecati odit dolorum beatae corporis? Vero veniam ut quas incidunt officia in adipisci?
    </p>
    <p id="para3">
        Ipsam ad, tempore impedit accusantium, excepturi facere eligendi perspiciatis incidunt earum dicta nobis sapiente itaque, consectetur quasi exercitationem non. Numquam dolorem excepturi optio voluptates earum voluptas deserunt doloribus rerum deleniti.
    </p>
    <p id="para4">
        Magnam dolorum natus assumenda sunt repellat incidunt provident eveniet. Similique dignissimos dolore corporis vero, praesentium facere laudantium? Quo, soluta eius hic non nisi officiis repellendus vel, laudantium, id voluptatibus ullam!
    </p>
    <p id="para5">
        Cumque voluptatibus neque sit natus, veritatis eum aliquid autem cupiditate necessitatibus ex placeat, laboriosam, iusto fugiat quia aut fuga dolor dicta facere. Non alias beatae aspernatur et, vero amet culpa.
    </p>
</div>
<?php
    /* 
        Dans une application complexe, il peut être difficile de vérifier
        qu'un fichier n'est pas déjà été inclu.
        require_once et include_once sont un peu plus lent à l'execution,
        mais vérifiront avant d'inclure si le fichier n'a pas déjà été inclu.
    */
    require "../ressources/template/_footer.php";
    // require "../ressources/template/_footer.php";
    require_once "../ressources/template/_footer.php";
?>