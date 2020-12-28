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
        $this->checkMethodMatches('GET');

        if ($this->routeMatched) {
            return;
        }
        // TODO: check if route params contain unusual characters
        $this->setPathSegments($path);

        [$controllerName, $method] = explode(self::SEPARATOR, $controller);

        if ($this->pathMatches($path)) {
            $this->routeMatched = true;

            $controllerClassName = "\App\Controllers\\$controllerName";
            (new $controllerClassName())->$method(
                ...$this->extractRouteParams($path)
            );
        }
    }

    protected function setPathSegments(string $path): void
    {
        $this->pathSegments = explode('/', $path);
    }

    protected function checkMethodMatches(string $method): void
    {
        if ($_SERVER['REQUEST_METHOD'] != $method) {
            throw new \Exception('Invalid method');
        }
    }

    protected function pathMatches(string $path): bool
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
