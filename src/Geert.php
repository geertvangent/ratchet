<?php

namespace MyApp;
 
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
 

class Geert implements MessageComponentInterface {

    public function __construct(){
        $this->clients = new \SplObjectStorage;
    }

public function onOpen(ConnectionInterface $conn) { 
    //store the new connection
    $this->clients->attach($conn);

    //test every connection
    echo "someone connected";
} 

public function onMessage(ConnectionInterface $from, $msg) {
    //send the message to all the other clients except the one who sent.
    foreach($this->clients as $client){
        if($from !== $client){
            $client->send($msg);
        }
    } 
} 

public function onClose(ConnectionInterface $conn) { 

    $this->clients->detach($conn);

    echo "someone has disconnected";
} 

public function onError(ConnectionInterface $conn, \Exception $e) { 

    echo "an error has occurred:  {$e->getMessage()}\n";
    $conn->close();
}
}

