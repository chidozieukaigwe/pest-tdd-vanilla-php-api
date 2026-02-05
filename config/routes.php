<?php

use App\Http\Response;
use App\Controller\BooksController;

$routes = [
    
    [
        'GET',
        '/books/{id:\d+}',
        [BooksController::class,'show']
    ]
    
];

return $routes;