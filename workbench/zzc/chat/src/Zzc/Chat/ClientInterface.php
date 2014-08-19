<?php

namespace Zzc\Chat;

use Evenement\EventEmitterInterface;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

interface ClientInterface
{
    public function getSocket();
    public function setSocket(ConnectionInterface $socket);
    public function getId();
    public function setId($id);
    public function getName();
    public function setName($name);
}