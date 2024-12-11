<?php

use function Phico\Pest\get;

it('can be accessed on the `$this` closure', function () {
    $this->get("/path/to");
});

it("can be accessed as function", function () {
    get("/path/to");
});
