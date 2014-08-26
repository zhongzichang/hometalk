<?php
namespace Zzc\Chat;

use Evenement\EventEmitterInterface;
use Exception;
use Ratchet\ConnectionInterface;
use SplObjectStorage;
use Zzc\Chat\Controller\AuthController;

class Chat implements ChatInterface
{


    protected $clients;
    protected $emitter;
    protected $id = 1;
    protected $routes;

    
    public function getClientBySocket(ConnectionInterface $socket)
    {
        foreach ($this->clients as $next)
            {
                if ($next->getSocket() === $socket)
                    {
                        return $next;
                    }
            }
        return null;
    }

    public function getEmitter()
    {
        return $this->emitter;
    }

    public function setEmitter(EventEmitterInterface $emitter)
    {
        $this->emitter = $emitter;
    }

    public function getClients()
    {
        return $this->clients;
    }

    public function __construct(EventEmitterInterface $emitter)
    {
        $this->emitter = $emitter;
        $this->clients   = new SplObjectStorage();
        $this->routes  = include 'route.php';
    }

    public function onOpen(ConnectionInterface $socket)
    {
        $client = new Client();
        $client->setId($this->id++);
        $client->setSocket($socket);
        $this->clients->attach($client);
        $this->emitter->emit("open", [$client]);
    }

    public function onMessage(
        ConnectionInterface $socket,
        $message
    )
    {

        $client = $this->getClientBySocket($socket);
        $this->emitter->emit("message", [$client, $message]);

        $message = json_decode($message);
        if( array_key_exists($message->type, $this->routes) ){
            $method = $this->routes[$message->type];
            if( is_callable($method) ){
                $result = $method($client, $message->data);
                if( $result ) {
                    $response = json_encode(
                        [
                            'client'=>['id'=>0,'name'=>'System'],
                            'message'=> ['type'=>'result', 'data'=>$result]
                        ]);
                    $client->getSocket()->send( $response );
                }
            }
        }

        switch ($message->type) {
        case "name":
        {
            $client->setName($message->data);
            $this->emitter->emit("name", [
                $client,
                $message->data
            ]);
            break;
        }
        }
    }

    public function onClose(ConnectionInterface $socket)
    {
        $client = $this->getClientBySocket($socket);
        if ($client)
            {
                $this->clients->detach($client);
                $this->emitter->emit("close", [$client]);
            }
    }

    public function onError(
        ConnectionInterface $socket,
        Exception $exception
    )
    {
        $client = $this->getClientBySocket($socket);
        if ($client)
            {
                $client->getSocket()->close();
                $this->emitter->emit("error", [$client, $exception]);
            }
    }

    private function broadcast($sender, $message){
        foreach ($this->clients as $next) {
            if ($next !== $sender) {
                $next->getSocket()->send(json_encode([
                    "client" => [
                        "id"   => $sender->getId(),
                        "name" => $sender->getName()
                    ],
                    "message" => $message
                ]));
            }
        }
    }

}