<?php
namespace Worktest\Core;

class Application
{
    /**
     * 
     *
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request)
    {
        session_start();
        $response = new Response();
        $router = new Router();
        $templateRenderer = new Template();
        $resolvedPath = $router->resolveControllerAndMethod($request);

        if (!$resolvedPath) {
            $response->abort(404);
        }

        try {
            $controller = new $resolvedPath['controller'];
            $viewData = $controller->{$resolvedPath['method']}($request);
            $response->setContent($templateRenderer->render($resolvedPath['controller'],$viewData['viewName'],$viewData['data']));
        } catch (\Throwable $th) {
            
            echo "Ошибка на сайте";
            $response->abort(500);
        }

        return $response;

    }

}
