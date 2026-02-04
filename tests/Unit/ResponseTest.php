<?php 

use App\Http\Response;

test('a Response object can be created', function () {

    //  ACT
    $response = new Response('{"foo":"bar"}', 200);

    // ASSERT
    expect($response->getStatusCode())->tobeInt()->toBe(200)
    ->and($response->getBody())->toMatchJson([
        "foo" => "bar"
    ]);

});