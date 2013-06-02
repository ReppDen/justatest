<?php
namespace App\Controller;

class Admin extends \App\Page {

    public function action_index(){

        if(!$this->logged_in('admin'))
            return;

        $this->view->message = $this->pixie->auth->user()->email;

        //Include 'hello.php' subview
        $this->view->subview = 'admin';
    }

    public function action_logout() {
        $this->pixie->auth->logout();
        $this->redirect('/');
    }
}