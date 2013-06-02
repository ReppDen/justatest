<?php
namespace App\Controller;

class Test extends \App\Page {

    public function action_index(){

        $login = "p@p.ru";
        $password = "qwe";

        //Attempt to login the user using his
        //username and password
        $logged = $this->pixie->auth
            ->provider('password')
            ->login($login, $password);

        //On successful login redirect the user to
        //our protected page
        if ($logged) {
            $message = "YEAH!";
        } else {
            $message = "WTF";
        }

//        $hash = $this->pixie->auth->provider('password')->hash_password("qweasd");
//        $isEquals = $this->test($hash, "qweasd");

        $this->view->message = $logged;
        $this->view->subview = 'test';
    }

    public function test($hash, $password) {
        $challenge = $hash;

        $salted = explode(':', $challenge);
        $password = hash("md5", $password.$salted[1]);
        $challenge = $salted[0];
        if ($challenge == $password) {
            return true;
        } else {
            return false;
        }
    }

}