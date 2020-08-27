<?php
namespace Worktest\Controller;

class BaseController
{
    protected $viewVars = [];
    public function __construct()
    {
        $this->viewVars['flashMessages'] = [];
        $this->setViewVar('isAdmin', $this->isAdmin());
    }
    protected function isAdmin()
    {
        return isset($_SESSION['admin']);
    }
    protected function setViewVar($key, $val)
    {
        $this->viewVars[$key] = $val;
    }
    protected function setMessage($message, $class, $flash = false)
    {
        if ($flash) {
            if (!isset($_SESSION['flashMessages'])) {
                $_SESSION['flashMessages'] = [];
            }

            $_SESSION['flashMessages'][] = ['message' => $message, 'class' => $class];

        } else {
            $this->viewVars['flashMessages'][] = ['message' => $message, 'class' => $class];
        }

    }
    protected function view($viewName = 'index')
    {
        return [
            'viewName' => $viewName,
            'data' => $this->viewVars,
        ];
    }
    protected function redirect($path)
    {
        header('Location: /?path=' . $path);
        exit();
    }

}
