<?php

use App\Http\Request;
use App\Http\Response;
use App\Routing\Router;
use App\Routing\RouteHandlerResolver;

it('returns a 200 Response object if a valid route exists', function () {

    //  Arrange 
    $requst = Request::create("GET", '/foo');

    $handler = fn() => new Response();

    $routeHandlerResolver = Mockery::mock(RouteHandlerResolver::class);

    $routeHandlerResolver->shouldReceive('resolve')
        ->andReturn($handler);

    $router = new Router($routeHandlerResolver);

    $router->setRoutes([
        ['GET', '/foo', $handler ]
    ]);

    // Act
    $response = $router->dispatch($requst);

    // Assert
    expect($response)
    ->toBeInstanceOf(Response::class)
    ->and($response->getStatusCode())->toBe(200);
    
});

it("returns a 404 Rfesponse objhect if a route does not exist", function () {

})->todo();

it("returns a 405 Response object if a not allowed method is used", function () {

})->todo();