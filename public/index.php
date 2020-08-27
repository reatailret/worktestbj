<?php

require __DIR__.'/../autoload.php';


$app = new Worktest\Core\Application();
$response = $app->handle(new Worktest\Core\Request());
$response->send();
