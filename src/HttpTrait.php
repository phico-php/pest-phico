<?php

declare(strict_types=1);

namespace Phico\Pest;

use Phico\Phico;
use Phico\Http\{Request, Response};
use PHPUnit\Framework\TestCase;

trait HttpTrait
{
    /**
     * Pass a Request instance through the Phico application handle() method
     * @param string $uri The Request uri
     * @param array $options An array of options to pass to the Request
     * @return Response;
     */
    public function get(string $uri, array $options = []): Response
    {
        // boot application
        $app = $this->boot();

        // create Request
        $request = $this->make($uri, $options);

        // call Phico::handle and return response
        return $app->handle($request);
    }
    public function post(
        string $uri,
        array $body = [],
        array $options = []
    ): Response {
        $request = $this->make($uri, $options, $body);
        return response();
    }
    /**
     *
     */
    protected function boot(): Phico
    {
        $app = phico();
        // process the app support files
        include path("boot/container.php");
        include path("boot/events.php");
        include path("boot/routes.php");
        include path("boot/middleware.php");

        return $app;
    }

    protected function make(
        string $uri,
        array $data = [],
        array $options = []
    ): Request {
        return new Request(
            "GET",
            $uri,
            $options["headers"] ?? [],
            $options["input"] ?? [],
            $options["uploads"] ?? [],
            $options["vars"] ?? []
        );
    }
}
