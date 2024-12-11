<?php

declare(strict_types=1);

namespace Phico\Pest;

use Phico\Phico;
use Phico\Http\{Request, Response};


/**
 * Provides mock HTTP methods returning Responses
 */
trait HttpTrait
{
    /**
     * Makes a mock GET request through the app
     * @param string $uri The Request uri
     * @param array $options An array of options to pass to the Request
     * @return Response;
     */
    public function get(string $uri, array $options = []): Response
    {
        return $this->withoutBody("GET", $uri, $options);
    }
    /**
     * Makes a mock POST request through the app
     * @param string $uri The Request uri
     * @param array $options An array of options to pass to the Request
     * @return Response;
     */
    public function post(
        string $uri,
        array $body = [],
        array $options = []
    ): Response {
        return $this->withBody("POST", $uri, $body, $options);
    }
    /**
     * Makes a mock PATCH request through the app
     * @param string $uri The Request uri
     * @param array $options An array of options to pass to the Request
     * @return Response;
     */
    public function patch(
        string $uri,
        array $body = [],
        array $options = []
    ): Response {
        return $this->withBody("PATCH", $uri, $body, $options);
    }
    /**
     * Makes a mock PUT request through the app
     * @param string $uri The Request uri
     * @param array $options An array of options to pass to the Request
     * @return Response;
     */
    public function put(
        string $uri,
        array $body = [],
        array $options = []
    ): Response {
        return $this->withBody("PUT", $uri, $body, $options);
    }
    /**
     * Makes a mock DELETE request through the app
     * @param string $uri The Request uri
     * @param array $options An array of options to pass to the Request
     * @return Response;
     */
    public function delete(
        string $uri,
        array $body = [],
        array $options = []
    ): Response {
        return $this->withBody("DELETE", $uri, $body, $options);
    }
    /**
     * Makes a mock Request without a body payload and sends it through the app
     * @param string $method The request method
     * @param string $uri The request uri
     * @param array $options An array of options to pass to the Request
     * @return Response;
     */
    protected function withoutBody(
        string $method,
        string $uri,
        array $options = []
    ): Response {
        // create Request
        $request = $this->make($method, $uri, $options);
        // return Response
        return $this->handle($request);
    }
    /**
     * Makes a mock Request with a body payload and sends it through the app
     * @param string $method The request method
     * @param string $uri The Request uri
     * @param array $body An array of options to pass to the Request
     * @param array $options An array of options to pass to the Request
     * @return Response;
     */
    protected function withBody(
        string $method,
        string $uri,
        array $body = [],
        array $options = []
    ): Response {
        // merge body into options
        $options["body"] = array_merge($options["body"] ?? [], $body);
        // create Request
        $request = $this->make($method, $uri, $options);
        // return Response
        return $this->handle($request);
    }
    /**
     * Returns a booted Phico instance
     * @return Phico
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
    /**
     * Pushes a Request through Phico returning the Response
     * @param \Phico\Http\Request $request
     * @return \Phico\Http\Response
     */
    protected function handle(Request $request): Response
    {
        // boot application
        $app = $this->boot();
        // call Phico::handle and return response
        return $app->handle($request);
    }
    /**
     * Returns a populated Phico Request instance
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return \Phico\Http\Request
     */
    protected function make(
        string $method,
        string $uri,
        array $options = []
    ): Request {
        return new Request(
            $method,
            $uri,
            $options["headers"] ?? [],
            $options["body"] ?? [],
            $options["uploads"] ?? [],
            $options["vars"] ?? []
        );
    }
}
