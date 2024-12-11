<?php

use Phico\Http\{Request, Response};
use function Phico\Pest\get;

it('can be accessed on the `$this` closure', function () {
    $response = $this->get("/path/to");
    expect($response)->toBeInstanceOf(Response::class);
});

it("can be accessed as function", function () {
    $response = get("/path/to");
    expect($response)->toBeInstanceOf(Response::class);
});
