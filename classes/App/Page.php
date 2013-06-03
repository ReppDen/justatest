<?php
namespace App;

class Page extends \PHPixie\Controller {


    protected $auth;
    protected $view;

    public function before() {
        $logged = $this->pixie->auth->user() != null;
        $this->view = $this->pixie-> view('main');
        $this->view->logged = $logged;
    }

    public function after() {
        $this->response->body = $this->view->render();
    }

    //This method will redirect the user to the login page
    //if he is not logged in yet, or present him with a message
    //if he lacks the required role.
    protected function logged_in($role = null){
        if($this->pixie->auth->user() == null){
            $this->redirect('/login/login');
            return false;
        }

        if($role && !$this->pixie->auth->has_role($role)){
            $this->response->body = "У вас нет доступа на эту страницу. Вернитесь  <a href='/'>обратно</a> пожалуйста";
            $this->execute=false;
            return false;
        }

        return true;
    }
    protected function has_role($role) {
        return $role && $this->pixie->auth->has_role($role);
    }

}