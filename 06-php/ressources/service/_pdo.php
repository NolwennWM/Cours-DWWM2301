<?php 
/* 
    Dans PHP, il existe plusieurs outils de connexion à la BDD.
    Les deux plus utilisés sont "MySQLi" et "PDO"
    "MySQLi" est adapté uniquement aux BDD avec un pilote "MySQL"
    "PDO" peut accepter n'importe quel pilote.
*/
/**
 * Retourne une instance de connexion PDO à la BDD
 *
 * @return \PDO
 */
function connexionPDO(): \PDO
{
    /* 
        On require notre fichier de configuration.
        Celui ci retourne un tableau que l'on range dans une variable.
    */
    $config = require __DIR__."/../config/_blogConfig.php";
    /* 
        Le premier paramètre de connexion à notre BDD est un "DSN"
        DSN signifie "Data Source Name"
        C'est un string qui contient les informations pour localiser notre BDD.
        Il prendra la forme suivante :
            "pilote":host="hôte de la BDD";port="port de la BDD";dbname="Nom de la BDD";charset="Charset utilisé par la BDD"
        Exemple :
            mysql:host=localhost;port=3306;dbname=blog;charset=utf8mb4
    */
    $dsn = 
        "mysql:host=". $config["host"]
        .";dbname=". $config["database"]
        .";charset=" . $config["charset"];

    try
    {
        /* 
            Je crée une nouvelle instance de "PDO" en lui donnant en argument :
                1: Le DSN
                2: Le nom d'utilisateur
                3: le mot de passe
                4: les options de PDO
            
            le "\" avant "PDO" est ici optionnel, mais peut être utile si vous faites de la POO
        */
        $pdo = new \PDO(
            $dsn,
            $config["user"],
            $config["password"],
            $config["options"]
        );
        return $pdo;
    }
    catch(\PDOException $e)
    {
        /* 
            On lance une nouvelle instance de PDOException
            Avec en premier argument, le message d'erreur
            Et en second, le code d'erreur.
        */
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}
?>