<?php

use Ratchet\Server\IoServer; 
use Ratchet\Http\HttpServer; 
use Ratchet\WebSocket\WsServer; 
use MyApp\Geert; 

require './vendor/autoload.php'; 
// require dirname(__DIR__) . '/vendor/autoload.php'; 


$server = IoServer::factory( 
new HttpServer( 
new WsServer( 
new Geert() 
) 
), 

8080 

); 

echo 'Starting server'; 

$server->run();
?>