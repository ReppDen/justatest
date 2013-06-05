<?php
namespace App\Controller;

class AwardUser extends \App\Page {

    public function action_index(){
        if(!$this->logged_in('admin'))
            return;

        $stages = $this->pixie->orm->get('stage')->find_all();
        $users = $this->pixie->orm->get('user')->find_all();
        $this->view->stages = $stages;
        $this->view->users = $users;
        $this->view->subview = '/awards_users/add_award';
    }

    public function action_fill_stage() {
        if(!$this->logged_in())
            return;

        if($this->request->method == 'GET'){
            $stage = $this->pixie->orm->get('stage')->where('id',$this->request->post('stage'))->find();
            $year = $this->request->post('year');
            $this->view->stage = $stage;
            $this->view->year = $year;
            $this->view->subview = '/awards_users/fill_award';

        } else {
            // нарушитель! алярма!
            $this->redirect('/awardusers/');
        }

    }

    public function action_save_stage() {

        if(!$this->logged_in('admin'))
            return;

        if($this->request->method == 'POST'){
            // рассчитать баллы
            $points = (float) 0.0;
            $points += (float) $this->request->post('o7_2') * 1.0;
            $points += (float) $this->request->post('o7_3') * 1.0;
            $points += (float) $this->request->post('o7_4') * 1.0;
            $points += (float) $this->request->post('o7_5') * 0.1;
            $points += (float) $this->request->post('o7_6') * 0.5;
            $points += (float) $this->request->post('o7_7') * 0.3;
            $points += (float) $this->request->post('o7_8') * 0.5;
            $points += (float) $this->request->post('o7_9') * 0.1;
            echo $points;

            // создать запись
            $a = $this->pixie->orm->get('award_user');

            // слоижть в запись данные с формы
            $a->date = date("Y-m-d");
            $a->year = date("Y");
            $a->sum = $points;
            $a->users_id = 1; // FIXME $this->pixie->orm->get('user')->where('id',$this->pixie->auth->user()->id)->find()->faculty->id;
            $a->stage_id = $this->request->post('stage_id');

            // сохранить
            $a->save();
            $this->redirect("/awarduser/list_award/".date("Y"));
        } else {
            // нарушитель! алярма!
            $this->redirect('/awarduser/');
        }
    }

    public function action_list_award() {
        if(!$this->logged_in('admin'))
            return;

        $year = $this->request->param("id");
        if ($year == null) {
            $year = date("Y");
        }
        $isAdmin = $this->has_role('admin');
        $this->view->can_delete = $isAdmin;
        $this->view->year = $year;

        if ($isAdmin) {
            $this->view->awards = $this->pixie->orm->get('award_user')->where('year',$year)->find_all();
        } else {
            $f_id = $this->pixie->orm->get('user')->where('id',$this->pixie->auth->user()->id)->find()->faculty->id;
            $this->view->awards = $this->pixie->orm->get('award_user')->where('year', $year)->where("faculties_id", $f_id)->find_all();
        }

        $this->view->subview = '/awards_users/list_award';


    }

    public function action_delete_award() {
        if(!$this->logged_in('admin'))
            return;

        $id = $this->request->param("id");
        if (!$id) {
            return;
        }
        $a = $this->pixie->orm->get('award_user')->where('id',$id)->find();

        $a->delete();

        $this->redirect("/awarduser/list_award");

    }



}