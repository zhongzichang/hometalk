<?php
namespace Zzc\Chat;

use Ratchet\ConnectionInterface;

class Client implements ClientInterface
{
    protected $socket;
    protected $id;
    protected $name;
    protected $user;

    public function getSocket()
    {
        return $this->socket;
    }

    public function setSocket(ConnectionInterface $socket)
    {
        $this->socket = $socket;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user){
        $this->user = $user;
        return $this;
    }
}