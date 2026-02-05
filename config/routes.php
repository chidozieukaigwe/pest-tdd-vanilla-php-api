<?php

use App\Http\Response;

$routes = [
    
    [
        'GET',
        '/books/{id:\d+}',
        fn() => new Response()
    ]
    
];

return $routes;