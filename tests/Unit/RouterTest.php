<?php

use App\Http\Request;
use App\Http\Response;
use App\Routing\Router;

it('returns a 200 Response object if a valid route exists', function () {

    //  Arrange 
    $requst = Request::create("GET", '/foo');

    $router = new Router();

    $router->setRoutes([
        ['GET', '/foo', fn() => new Response()]
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