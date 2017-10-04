<?php 

require __DIR__ . '/../vendor/autoload.php';

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register middleware
require __DIR__ . '/../src/middleware.php';

// Register routes
require __DIR__ . '/../src/routes.php';

/*
$sotre = $container['SongsStore'];

var_dump($sotre->read());
*/


$service = $container['SongsService'];

/*
var_dump($service->loadList());
*/


/*
var_dump($service->loadSingle(1));
*/

//var_dump($service->create(new g\model\SongModel("test create 2") ));

//var_dump($service->delete($service->loadSingle(7) ));


//var_dump($service->loadLatest());

$data = [
			"name" => "",
			"publishDate" => '2017-01-41'
        ] ;
$form = $container['SongForm'];

$form->build()->validate($data);

var_dump($form->getErrors());