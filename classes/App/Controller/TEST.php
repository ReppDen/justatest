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
//        $f = $this->pixie->orm->get('lol');
//        $f->qwe = "qweASD";
//        $f.save();
//        $t = $this->pixie->orm->get('user').where('id', $this->pixie->auth->user()->id)->find()->faculty->id;
        $t =  $this->pixie->orm->get('user')->where('id',$this->pixie->auth->user()->id)->find();

        $this->view->t = $this->pixie->orm->get('award')->where('year', '2013')->where("faculties_id", 1)->find_all();
        $this->view->subview = '/test/test';
    }

}