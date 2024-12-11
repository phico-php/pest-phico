<?php

declare(strict_types=1);

namespace Phico\Pest;

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
        return response();

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
    }

    // protected function make(
    //     string $uri,
    //     array $data = [],
    //     array $options = []
    // ): Request {
    // }
}
