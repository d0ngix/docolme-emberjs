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

//Adding Database connection to Container
$container['db'] = function ($c) {

    /** THIS SHOULD BE SET SOMEWHERE IN THE SERVER ENV VARIABLES - START */
    $_ENV['DB_HOST'] = '127.0.0.1';
    $_ENV['DB_NAME'] = 'docs';
    $_ENV['DB_USER'] = 'root';
    $_ENV['DB_PASS'] = 'd0ngix777';
    /** THIS SHOULD BE SET SOMEWHERE IN THE SERVER ENV VARIABLES - START */

    $dsn = 'mysql:host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_NAME'].';charset=utf8';
    $usr = $_ENV['DB_USER'];
    $pwd = $_ENV['DB_PASS'];

   $pdo = new \Slim\PDO\Database($dsn, $usr, $pwd);
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
   return $pdo;
};