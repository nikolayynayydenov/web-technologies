<?php

namespace Core;

/**
 * TODO: implement fallback routing
 */
class Router
{
    const SEPARATOR = '@';
    const PARAM_REGEX = '/^\{.*\}$/';

    protected $routeMatched;
    protected $pathSegments;
    protected $requestPathSegments;

    public function __construct()
    {
        $this->routeMatched = false;

        $this->requestPathSegments = explode(
            '/',
            explode('?', $_SERVER['REQUEST_URI'])[0]
        );
    }

    public function get(string $path, string $controller): void
    {
        if ($this->routeMatched) {
            return;
        }

        $this->handleRequest($path, $controller, 'GET');
    }

    public function post(string $path, string $controller): void
    {
        if ($this->routeMatched) {
            return;
        }

        $this->handleRequest($path, $controller, 'POST');
    }

    public function put(string $path, string $controller): void
    {
        if ($this->routeMatched) {
            return;
        }

        $this->handleRequest($path, $controller, 'PUT');
    }

    public function patch(string $path, string $controller): void
    {
        if ($this->routeMatched) {
            return;
        }

        $this->handleRequest($path, $controller, 'PATCH');
    }

    public function delete(string $path, string $controller): void
    {
        if ($this->routeMatched) {
            return;
        }

        $this->handleRequest($path, $controller, 'DELETE');
    }

    public function handleRequest(string $path, string $controller, string $httpMethod): void
    {
        // TODO: check if route params contain unusual characters
        $this->setPathSegments($path);

        [$controllerName, $method] = explode(self::SEPARATOR, $controller);

        if ($this->pathMatches() && $this->methodMatches($httpMethod)) {
            $this->routeMatched = true;

            $controllerClassName = "\App\Controllers\\$controllerName";
            (new $controllerClassName())->$method(
                ...$this->extractRouteParams($path)
            );
        }
    }

    public function fallback()
    {
        if (!$this->routeMatched) {
            response('404. The page was not found.', 404);
        }
    }

    protected function setPathSegments(string $path): void
    {
        $this->pathSegments = explode('/', $path);
    }

    protected function methodMatches(string $method): bool
    {
        if (
            array_key_exists('_method', $_POST) &&
            strtolower($method) === strtolower($_POST['_method'])
        ) {
            return true;
        }

        return strtolower($_SERVER['REQUEST_METHOD']) === strtolower($method);
    }

    protected function pathMatches(): bool
    {

        $pathSegmentsCount = count($this->pathSegments);

        if ($pathSegmentsCount !== count($this->requestPathSegments)) {
            return false;
        }

        for ($i = 0; $i < $pathSegmentsCount; $i++) {
            if (
                $this->pathSegments[$i] !== $this->requestPathSegments[$i] &&
                !preg_match(self::PARAM_REGEX, $this->pathSegments[$i])
            ) {
                return false;
            }
        }
        return true;
    }

    protected function extractRouteParams(string $path): array
    {
        $paramKeys = [];
        $result = [];

        foreach ($this->pathSegments as $key => $segment) {
            if (preg_match(self::PARAM_REGEX, $segment)) {
                $paramKeys[] = $key;
            }
        }

        foreach ($paramKeys as $key) {
            $result[] = $this->requestPathSegments[$key];
        }

        return $result;
    }
}
