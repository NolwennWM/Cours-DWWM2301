<?php

use AFCI\Chat;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

require __DIR__."/../vendor/autoload.php";
require __DIR__."/../src/Chat.php";

// On construit un nouveau serveur:
$server = IoServer::factory(
    // Un serveur HTTP qui contient :
    new HttpServer(
        // Un serveur websocket qui contient :
        new WsServer(
            // notre chat
            new Chat()
        )
    )
    ,8000);
// On lance notre serveur :
$server->run();
?>