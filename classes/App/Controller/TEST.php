<?php
namespace App\Controller;

class Test extends \App\Page {

    public function action_index(){
//        $f = $this->pixie->orm->get('faculty')->where('id','1')->find();
//
//        $m = "";
//        $users = $f->users->find_all();
//        foreach ($users as $u) {
//            $m .= $u->email."<br/>";
//        }
//        $this->view->message = $m;
        $f = $this->pixie->orm->get('lol');
        $f->qwe = "qweASD";
        $f.save();
        $this->view->subview = 'test';
    }



}