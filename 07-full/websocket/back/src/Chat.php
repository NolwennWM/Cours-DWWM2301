<?php 
namespace AFCI;

use Ratchet\ConnectionInterface;
use Ratchet\WebSocket\MessageComponentInterface;

require __DIR__."/../vendor/autoload.php";

class Chat implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        // Une classe permettant le stockage d'objets.
        $this->clients = new \SplObjectStorage();
    }
    public function onOpen(ConnectionInterface $conn)
    {
        // je range ma nouvelle connexion dans ma liste.
        $this->clients->attach($conn);
        // j'affiche un message confirmant la connexion.
        echo "Nouvelle Connexion ! ({$conn->resourceId})\n";
    }
    public function onMessage(ConnectionInterface $from, $msg)
    {
        // Je compte le nombre de connexion qui vont recevoir le message:
        $numRecv = count($this->clients)-1;
        $pluriel = $numRecv===1?"":"s";

        // J'affiche un message indiquant la connexion expediant le message, le message, et le nombre de destinataire :
        echo sprintf("Connexion %d envoi le message \"%s\" à %d autre%s connexion%s\n", $from->resourceId, $msg, $numRecv, $pluriel, $pluriel);

        foreach($this->clients as $client)
        {
            if($from != $client) $client->send($msg);
        }
    }
    public function onClose(ConnectionInterface $conn)
    {
        // On supprime l'utilisateur de la liste des utilisateurs connectés :
        $this->clients->detach($conn);
        // On affiche un message confirmant la déconnexion.
        echo "Connexion {$conn->resourceId} déconnectée! \n";
    }
    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        // J'affiche le message d'erreur
        echo "Une erreur est survenue! {$e->getMessage()}\n";
        // Je ferme la connexion ayant provoqué l'erreur.
        $conn->close();
    }
}
?>