<?php
namespace App\Controller;

class Login extends \App\Page {

    public function action_index(){

        if(!$this->logged_in())
            return;

        $this->view->message = $this->pixie->auth->user()->email;

        //Include 'hello.php' subview
        $this->view->subview = 'home';

    }

    public function action_admin(){

        if(!$this->logged_in('admin'))
            return;

        $this->view->message = $this->pixie->auth->user()->email;

        //Include 'hello.php' subview
        $this->view->subview = 'admin';

    }

    public function action_login() {
        if($this->request->method == 'POST'){
            $login = $this->request->post('username');
            $password = $this->request->post('password');

            //Attempt to login the user using his
            //username and password
            $logged = $this->pixie->auth
                ->provider('password')
                ->login($login, $password);

            //On successful login redirect the user to
            //our protected page
            if ($logged)
                return $this->redirect('/');
        }
        //Include 'login.php' subview
        $this->view->subview = 'login';
    }

    public function action_logout() {
        $this->pixie->auth->logout();
        $this->redirect('/');
    }
}