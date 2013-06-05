<?php
namespace App\Controller;

class Admin extends \App\Page {

    public function action_index(){

        if(!$this->logged_in('admin'))
            return;

        $this->view->message = $this->pixie->auth->user()->email;

        //Include 'hello.php' subview
        $this->view->subview = '/admin/admin';
    }

    public function action_logout() {
        $this->pixie->auth->logout();
        $this->redirect('/');
    }

    public function action_calc_fund() {
        if(!$this->logged_in('admin'))
            return;

        $awards = $this->pixie->orm->get('award')->where('year','2013')->find_all();
        foreach ($awards as $a) {
            $fsu = 1;
            $nf = 200;
            $nu = 2000;
            $nshf = 10;
            $nshu = 100;
            $kf = $nf/$nu + $nshf/$nshu;
            $pbf = $a->sum * $kf;
            $pbu = $pbf; // summ
            $s = $fsu/$pbu;
            $fsf = $pbf * $s;
        }

        $this->view->subview = '/admin/calc_fund';

    }
}