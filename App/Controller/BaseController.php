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
    /**
     * check current user is admin or not
     *
     * @return boolean
     */
    protected function isAdmin()
    {
        return isset($_SESSION['admin']);
    }
    /**
     * Set var for view template
     *
     * @param mixed $key
     * @param mixed $val
     * @return void
     */
    protected function setViewVar($key, $val)
    {
        $this->viewVars[$key] = $val;
    }
    /**
     * Set "flash" message
     *
     * @param string $message
     * @param string $class 
     * bootstrap`s alert class
     * @param boolean $flash
     * store in session or not
     * @return void
     */
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
    /**
     * return controller data for renderer
     *
     * @param string $viewName
     * @return void
     */
    protected function view($viewName = 'index')
    {
        return [
            'viewName' => $viewName,
            'data' => $this->viewVars,
        ];
    }
    /**
     * redirect helper
     *
     * @param string $path
     * @return void
     */
    protected function redirect($path)
    {
        header('Location: /?path=' . $path);
        exit();
    }

}
