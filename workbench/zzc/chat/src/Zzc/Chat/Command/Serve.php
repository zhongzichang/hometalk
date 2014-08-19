<?php
namespace Zzc\Chat\Command;

use Illuminate\Console\Command;
use Ratchet\ConnectionInterface;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Zzc\Chat\ChatInterface;
use Zzc\Chat\ClientInterface;

class Serve extends Command
{
    protected $name        = "chat:serve";
    protected $description = "Command description.";
    protected $chat;

    protected function getClientName($client)
    {
        $suffix = " (" . $client->getId() . ")";
        if ($name = $client->getName())
            {
                return $name . $suffix;
            }
        return "Client" . $suffix;
    }

    public function __construct(ChatInterface $chat)
    {
        parent::__construct();
        $this->chat = $chat;
        $open = function(ClientInterface $client)
            {
                $name = $this->getClientName($client);
                $this->line("
                <info>" . $name . " connected.</info>
            ");
            };
        $this->chat->getEmitter()->on("open", $open);
        $close = function(ClientInterface $client)
            {
                $name = $this->getClientName($client);
                $this->line("
                <info>" . $name . " disconnected.</info>
            ");
            };
        $this->chat->getEmitter()->on("close", $close);
        $message = function(ClientInterface $client, $message)
            {
                $name = $this->getClientName($client);
                $this->line("
                <info>New message from " . $name . ":</info> 
                <comment>" . $message . "</comment>
                <info>.</info>
            ");
            };
        $this->chat->getEmitter()->on("message", $message);
        $name = function(ClientInterface $client, $message)
            {
                $this->line("
                <info>Client changed their name to:</info> 
                <comment>" . $message . "</comment>
                <info>.</info>
            ");
            };
        $this->chat->getEmitter()->on("name", $name);
        $error = function(ClientInterface $client, $exception)
            {
                $message = $exception->getMessage();
                $this->line("
                <info>Client encountered an exception:</info> 
                <comment>" . $message . "</comment>
                <info>.</info>
            ");
            };
        $this->chat->getEmitter()->on("error", $error);
    }

    public function fire()
    {
        $port = (integer) $this->option("port");
        if (!$port)
            {
                $port = 7778;
            }
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    $this->chat
                )
            ),
            $port
        );
        $this->line("
            <info>Listening on port</info>
            <comment>" . $port . "</comment>
            <info>.</info>
        ");
        $server->run();
    }

    protected function getOptions()
    {
        return [
            [
                "port",
                null,
                InputOption::VALUE_REQUIRED,
                "Port to listen on.",
                null
            ]
        ];
    }
}
