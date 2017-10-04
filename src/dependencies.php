<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};


// db Connection
$container['dbConn'] = function ($c) {
    $settings = $c->get('settings')['mysql'];

    $pdo = new Simplon\Mysql\PDOConnector(
		$settings['server'], // server
		$settings['user'],      // user
		$settings['password'],      // password
		$settings['database']   // database
	);


    $pdoConn = $pdo->connect('utf8', []); // charset, options
	$dbConn = new Simplon\Mysql\Mysql($pdoConn);

	return $dbConn;

};


// Stores Def
$container['SongsStore'] = function ($c) {
    
	$store = new g\store\SongsStore($c['dbConn']);
	return $store;
};


// Services Def
$container['SongsService'] = function ($c) {
    
	$service = new g\service\SongsService($c['SongsStore']);
	return $service;
};

// transformers
$container['SongTransformer'] = function ($c) {
    
	$transformer = new g\transformer\SongTransformer();
	return $transformer;
};

$container['SongFormTransformer'] = function ($c) {
    
	$transformer = new g\transformer\SongFormTransformer();
	return $transformer;
};


// action handler

$container['SongActionHandler'] = function ($c) {
    
	$handler = new g\handler\ActionHandler();

	$getAction = new g\handler\SongGetAction($c['SongsService'] , $c['renderer']);
	$deleteAction = new g\handler\SongDeleteAction($c['SongsService'] , $c['renderer']);
	$createAction = new g\handler\SongCreateAction($c['SongsService'] , $c['renderer'], $c['SongFormTransformer'],$c['SongForm']);
	$updateAction = new g\handler\SongUpdateAction($c['SongsService'] , $c['renderer'], $c['SongFormTransformer'],$c['SongForm']);



	$handler->add($getAction);	
	$handler->add($deleteAction);	
	$handler->add($createAction);	
	$handler->add($updateAction);	


	return $handler;
};


//Form 
$container['SongForm'] = function ($c) {
    
	$form = new g\form\SongForm();
	return $form;
};





// Controllers 
$container['SongsController'] = function ($c) {
    
	$controller = new g\controller\SongsController($c['SongsService'] , $c['renderer'] , $c['SongActionHandler']);
	return $controller;
};


// API
$container['SongsApi'] = function ($c) {
    
	$api = new g\api\SongsApi($c['SongsService'] , $c['SongTransformer']);
	return $api;
};

