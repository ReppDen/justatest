<?php
namespace App\Controller;

class Award extends \App\Page {

    public function action_index(){
        if(!$this->logged_in())
            return;

        $stages = $this->pixie->orm->get('stage')->find_all();
        $this->view->stages = $stages;
        $this->view->subview = '/awards/add_award';
    }

    public function action_fill_stage() {
        if(!$this->logged_in())
            return;

        if($this->request->method == 'POST'){
            $stage = $this->pixie->orm->get('stage')->where('id',$this->request->post('stage'))->find();
            $year = $this->request->post('year');
            $this->view->stage = $stage;
            $this->view->year = $year;
            $this->view->subview = '/awards/fill_award';

        } else {
            // нарушитель! алярма!
            $this->redirect('/award/');
        }

    }

    public function action_save_stage() {

        if(!$this->logged_in())
            return;

        if($this->request->method == 'POST'){
            // рассчитать баллы
            $points = (float) 0.0;
            $points += (float) $this->request->post('o7_1') * 1.2;
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
            $a = $this->pixie->orm->get('award');

            // слоижть в запись данные с формы
            $a->date = date("Y-m-d");
            $a->year = date("Y");
            $a->sum = $points;
            $a->faculties_id = $this->pixie->orm->get('user')->where('id',$this->pixie->auth->user()->id)->find()->faculty->id;
            $a->stage_id = $this->request->post('stage_id');

            // сохранить
            $a->save();
            $this->redirect("/award/list_award/".date("Y"));
        } else {
            // нарушитель! алярма!
            $this->redirect('/award/');
        }
    }

    public function action_list_award() {
        if(!$this->logged_in())
            return;

        // включим обработку соритровки, если есть параметр
        $sort = $this->request->get('sort');

        $direction = 'asc';
        $d = $this->request->get('dir');
        if ($d != null && $d == 'desc') {
            $direction = 'desc';
        }
        $year = $this->request->param("id");
        if ($year == null) {
            $year = date("Y");
        }
        $isAdmin = $this->has_role('admin');
        $this->view->can_delete = $isAdmin;
        $this->view->year = $year;

        if ($isAdmin) {
            switch ($sort) {
                case 'sum':
                    $this->view->awards = $this->pixie->orm->get('award')->where('year',$year)->order_by('sum',$direction)->find_all();
                    break;
                case 'faculty':
                    $this->view->awards = $this->pixie->orm->get('award')->with('faculty')->where('year',$year)->order_by("name",$direction)->find_all();
                    break;
                case 'type':
                    $this->view->awards = $this->pixie->orm->get('award')->with('stage')->where('year',$year)->order_by("name",$direction)->find_all();
                    break;
                default:
                    $this->view->awards = $this->pixie->orm->get('award')->where('year',$year)->order_by('date',$direction)->find_all();
                    break;
            }
        } else {
            $f_id = $this->pixie->orm->get('user')->where('id',$this->pixie->auth->user()->id)->find()->faculty->id;
            $this->view->awards = $this->pixie->orm->get('award')->where('year', $year)->where("faculties_id", $f_id)->order_by($sort_field,$direction)->find_all();
        }

        $this->view->subview = '/awards/list_award';


    }

    public function action_delete_award() {
        if(!$this->logged_in('admin'))
            return;

        $id = $this->request->param("id");
        if (!$id) {
            return;
        }
        $a = $this->pixie->orm->get('award')->where('id',$id)->find();

        $a->delete();

        $this->redirect("/award/list_award");

    }



}