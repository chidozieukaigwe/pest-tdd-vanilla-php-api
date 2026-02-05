<?php
namespace App\Routing;

use FastRoute;
use App\Http\Request;
use App\Http\Response;
use FastRoute\RouteCollector;
use App\Routing\RouteHandlerResolver;
use function FastRoute\simpleDispatcher;

class Router
{

    public function __construct(private RouteHandlerResolver $routeHandlerResolver)
    {}

    private iterable $routes;

    public function dispatch(Request $request):Response
    {
        
        $dispatcher = simpleDispatcher(function(RouteCollector $r) {
         
            foreach($this->routes as $route) {

               $r->addRoute(...$route);

            }
        });

        // Fetch method and URI from somewhere
        $httpMethod = $request->getMethod();
        $uri = $request->getPath();

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);

      
        switch ($routeInfo[0]) {
            case FastRoute\Dispatcher::NOT_FOUND:
                $response = new Response('Route not found', Response::HTTP_NOT_FOUND);
                break;
            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                $availableMethods = json_encode($allowedMethods, true);
                $response = new Response("Route method not allowed. Available methods for route: $availableMethods", Response::HTTP_METHOD_NOT_ALLOWED);
                break;
            case FastRoute\Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];

                $handler = $this->routeHandlerResolver->resolve($handler);

                $response = $handler(...$vars);
         
                // ... call $handler with $vars
                break;
        }

        return $response;
        
    }
    

    /**
     * Set the value of routes
     *
     * @return  self
     */ 
    public function setRoutes($routes)
    {
        $this->routes = $routes;

        return $this;
    }
}