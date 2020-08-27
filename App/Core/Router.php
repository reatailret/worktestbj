<?php
namespace Worktest\Core;
/**
 * Router implementation
 */
class Router
{
    /**
     * Get controller name and method from uri string.
     *  
     * Name and method searched from GET 'path' param.  ?path=index/home
     *
     * @param Request $request
     * @return array
     */
    public function resolveControllerAndMethod(Request $request)
    {
        $path = $request->get('path', 'home/index');

        $resolvedPath = $path ? explode('/', $path) : [];

        if (count($resolvedPath) < 2) {
            return false;
        }

        $controllerName = 'Worktest\\Controller\\' . ucfirst(strtolower($resolvedPath[0])) . 'Controller';
        $methodName = strtolower($resolvedPath[1]);

        if (!class_exists($controllerName, true) || !method_exists($controllerName, $methodName)) {

            return false;
        }

        return ['controller' => $controllerName, 'method' => $methodName];
    }
}
