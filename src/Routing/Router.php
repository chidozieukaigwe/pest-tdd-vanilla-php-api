<?php
namespace App\Routing;

use FastRoute;
use App\Http\Request;
use App\Http\Response;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

class Router
{
    public function dispatch(Request $request):Response
    {
        
        $dispatcher = simpleDispatcher(function(RouteCollector $r) {
            $r->addRoute('GET', '/foo', function () {
                return new Response();
            });
        });

        // Fetch method and URI from somewhere
        $httpMethod = $request->getMethod();
        $uri = $request->getPath();

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);

      
        switch ($routeInfo[0]) {
            case FastRoute\Dispatcher::NOT_FOUND:
                // ... 404 Not Found
                break;
            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                // ... 405 Method Not Allowed
                break;
            case FastRoute\Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $response = $handler();
                // $vars = $routeInfo[2];
                // ... call $handler with $vars
                break;
        }

        return $response;
        
    }
    
}