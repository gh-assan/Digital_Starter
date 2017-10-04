<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/songs', "SongsController:listAction");

$app->get('/songs/add', "SongsController:addAction");

$app->post('/songs/add', "SongsController:createAction");

$app->get('/songs/{id:[0-9]+}', "SongsController:getAction");
$app->post('/songs/{id:[0-9]+}', "SongsController:updateAction");


$app->get('/api/songs/latest', "SongsApi:latestAction");


/*
$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

*/

