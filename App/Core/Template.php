<?php
namespace Worktest\Core;

class Template
{

    public function render(string $controllerClassName, string $viewName, $data)
    {
        $segments = explode('\\', $controllerClassName);
        $shortClassName = $segments[count($segments) - 1];
        $viewPath = __DIR__ . '/../Views/' . strtolower(substr($shortClassName, 0, strpos($shortClassName, 'Controller'))) . '/' . $viewName . '.php';

        $injectString = "";
        $returnString = "";
        $layoutPath = __DIR__ . '/../Views/layout.php';

        extract($data);
        if (isset($_SESSION['flashMessages'])) {
            if (isset($flashMessages)) {
                $flashMessages = array_merge($_SESSION['flashMessages'], $flashMessages);
            } else {
                $flashMessages = $_SESSION['flashMessages'];
            }
            $_SESSION['flashMessages'] = [];
        }
        if (!file_exists($viewPath)) {
            $injectString = "view not found";
        } else {
            ob_start();
            include $viewPath;
            $injectString = ob_get_contents();
            ob_end_clean();
        }
        ob_start();
        include $layoutPath;
        $returnString = ob_get_contents();
        ob_end_clean();

        $returnString = str_replace('@PAGECONTENT', $injectString, $returnString);
        return $returnString;

    }
}
