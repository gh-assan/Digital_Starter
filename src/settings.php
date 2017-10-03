<?php


/*
$pdo = new PDOConnector(
	'localhost', // server
	'root',      // user
	'',      // password
	'DigitalStarters'   // database
);
$pdoConn = $pdo->connect('utf8', []); // charset, options
$dbConn = new Mysql($pdoConn);
*/

return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        // Database settings
        'mysql' => [
            'server' => 'localhost',
            'user' => 'root',
            'password' => '',
            'database' => 'DigitalStarters',
        ],
    ],
];


