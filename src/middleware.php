<?php
// Application middleware
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

// e.g: $app->add(new \Slim\Csrf\Guard);
$app->add(function (ServerRequestInterface $request, ResponseInterface $response, callable $next) {
	// Use the PSR 7 $request object
	
// 	var_dump($request->getMethod());
// 	var_dump('POST: ' . $request->isPost());
// 	var_dump('GET: ' . $request->isGet());
// 	die;
	//Logging Here
	//Sampler logs
	// $route = $request->getAttribute('route');
	// var_dump($request->getMethod());
	
	$this->logger->addInfo($request->getMethod() . " : " . $request->getUri()->getPath() . " - " . json_encode($request->getParsedBody()));


    // $this->logger->addInfo("This is an INFO Log");
    // $this->logger->addError("This is an ERROR Log");
    // $this->logger->addWarning("This is a WARNING log!!!");
    
	//var_dump($request->getQueryParams());die;	
	
	return $next($request, $response);
});

/*
$app->add(new \Slim\Middleware\JwtAuthentication([
    "secret" => "thequickbrownfoxjumpsoverthelazydog97545389", //TODO: Use https://github.com/vlucas/phpdotenv
    "secure" => true,
    "relaxed" => ["localhost"],
	//"logger" => $logger,
		
	"rules" => [
		new \Slim\Middleware\JwtAuthentication\RequestPathRule([
			"path" => "/",
			"passthrough" => ["/user/login","/todo","/todos"],
		]),
	],		
		
    "callback" => function ($request, $response, $arguments) use ($container) {
        $container["jwtToken"] = $arguments["decoded"];
    },
    
    "error" => function ($request, $response, $arguments) {
    	$data["status"] = false;
    	$data["message"] = $arguments["message"];
    	return $response->withJson($data,200);
    }    
    
]));
*/