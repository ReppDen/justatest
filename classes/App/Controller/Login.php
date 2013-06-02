<?php
namespace App\Controller;

class Login extends \App\Page {

    public function action_index(){

        if(!$this->logged_in())
            return;

        $this->view->user = $this->pixie->auth->user();

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

            $this->view->logged = $logged;
            //On successful login redirect the user to
            //our protected page
            if ($logged) {
                return $this->redirect('/');
            } else {
                $this->view->error = true;
                $this->view->subview = 'login';
                return;
            }

        }
        $this->view->error = false;
        //Include 'login.php' subview
        $this->view->subview = 'login';
    }

    public function action_logout() {
        $this->pixie->auth->logout();
        $this->redirect('/');
    }

    public function action_register() {
        if($this->request->method == 'POST'){
            $login = $this->request->post('username');
            $password = $this->request->post('password');
            $fio = $this->request->post('fio');

            //Attempt to login the user using his
            //username and password
            $hash = $this->pixie->auth->provider('password')->hash_password($password);

            $user = $this->pixie->orm->get('user');
            $user->email = $login;
            $user->password = $hash;
            $user->fio = $fio;
            $user->save();

        }
        //Include 'login.php' subview
        $this->view->subview = 'register';
    }

}