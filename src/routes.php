﻿<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

// $app->get('/', function (Request $request, Response $response, array $args) {
//     // Sample log message
//     $this->logger->info("Slim-Skeleton '/' route");

//     // Render index view
//     return $this->renderer->render($response, 'index.phtml', $args);
// });

//API - Todo
//require 'src/routes/todo.php';

//API - document
require '../src/routes/docu.php';

// //API - User
require '../src/routes/user.php';
