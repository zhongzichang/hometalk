<?php
namespace Zzc\Chat;

use Evenement\EventEmitterInterface;
use Exception;
use Ratchet\ConnectionInterface;
use SplObjectStorage;
use Zzc\Chat\Controller\AuthController;

class Chat implements ChatInterface
{
    protected $users;
    protected $emitter;
    protected $id = 1;
    protected $routes;
    
    public function getUserBySocket(ConnectionInterface $socket)
    {
        foreach ($this->users as $next)
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

    public function getUsers()
    {
        return $this->users;
    }

    public function __construct(EventEmitterInterface $emitter)
    {
        $this->emitter = $emitter;
        $this->users   = new SplObjectStorage();
        $this->routes  = include 'route.php';
    }

    public function onOpen(ConnectionInterface $socket)
    {
        $user = new User();
        $user->setId($this->id++);
        $user->setSocket($socket);
        $this->users->attach($user);
        $this->emitter->emit("open", [$user]);
    }

    public function onMessage(
        ConnectionInterface $socket,
        $message
    )
    {

        $user = $this->getUserBySocket($socket);
        $message = json_decode($message);

        // test
        //$result = AuthController::login('test','123456');
        //$this->emitter->emit("message",[$user, $result]);
        if( array_key_exists($message->type, $this->routes) ){
            $method = $this->routes[$message->type];
            if( $method ){
                $result = call_user_func($method, $user, $message->data);
                $this->emitter->emit("message",[$user, $result]);
                if( $result ) {
                    $user->getSocket()->send($result);
                }
            }
        }

        switch ($message->type)
            {
            case "name":
            {
                $user->setName($message->data);
                $this->emitter->emit("name", [
                    $user,
                    $message->data
                ]);
                break;
            }
            case "message":
            {
                $this->emitter->emit("message", [
                    $user,
                    $message->data
                ]);
                break;
            }
            }  
        foreach ($this->users as $next)
            {
                if ($next !== $user)
                    {
                        $next->getSocket()->send(json_encode([
                            "user" => [
                                "id"   => $user->getId(),
                                "name" => $user->getName()
                            ],
                            "message" => $message
                        ]));
                    }
            }
    }

    public function onClose(ConnectionInterface $socket)
    {
        $user = $this->getUserBySocket($socket);
        if ($user)
            {
                $this->users->detach($user);
                $this->emitter->emit("close", [$user]);
            }
    }

    public function onError(
        ConnectionInterface $socket,
        Exception $exception
    )
    {
        $user = $this->getUserBySocket($socket);
        if ($user)
            {
                $user->getSocket()->close();
                $this->emitter->emit("error", [$user, $exception]);
            }
    }

}