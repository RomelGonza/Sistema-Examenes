<?php
require 'vendor/autoload.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use React\EventLoop\Factory;

class ChatWebSocket implements MessageComponentInterface {
    protected $clients;
    protected $users = [];

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        echo "Nueva conexión! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $data = json_decode($msg);
        
        if ($data->type === 'register') {
            $this->users[$data->userId] = [
                'conn' => $from,
                'role' => $data->role
            ];
            return;
        }
        
        if ($data->type === 'message' && isset($this->users[$data->receiver_id])) {
            $this->users[$data->receiver_id]['conn']->send($msg);
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        foreach ($this->users as $userId => $userData) {
            if ($userData['conn'] === $conn) {
                unset($this->users[$userId]);
                break;
            }
        }
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "Error: {$e->getMessage()}\n";
        $conn->close();
    }
}

$loop = Factory::create();
$webSocket = new ChatWebSocket();
$server = IoServer::factory(
    new HttpServer(
        new WsServer($webSocket)
    ),
    8080
);

echo "Servidor WebSocket ejecutándose en el puerto 8080...\n";
$server->run();
