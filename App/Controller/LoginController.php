<?php
namespace Worktest\Controller;

use Worktest\Model\JobsModel;
use Worktest\Core\Request;

class LoginController extends BaseController {
    /**
     * login page
     *
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {
        if($this->isAdmin())
        {
            $this->setMessage('Вы уже авторизованы','info',true);
            $this->redirect('home/index');
        }
        if($request->post('loginsubmit'))
        {
            if($request->post('login')=='admin' && $request->post('password')=='123')
            {
                $_SESSION['admin']=1;
                $this->setMessage('Вы успешно авторизованы','success',true);
                $this->redirect('home/index');
            }
            else
            {
                $this->setMessage('Не правильный логин или пароль','danger');
            }
        }
        return $this->view();
    }
    public function logout(Request $request)
    {
        unset($_SESSION['admin']);
        $this->redirect('home/index');
    }
}