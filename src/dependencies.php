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


// Controllers 
$container['SongsController'] = function ($c) {
    
	$controller = new g\controller\SongsController($c['SongsService'] , $c['renderer']);
	return $controller;
};




