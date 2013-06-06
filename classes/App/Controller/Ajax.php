<?php
namespace App\Controller;

class Ajax extends \PHPixie\Controller {

    public function action_index(){
        if(!$this->logged_in('admin'))
            return;
    }


    /**
     * Проверяет, есть ли у указанного факультета расчеты
     */
    public function action_check_award() {
        if(!$this->logged_in('admin'))
            return;

        if ($this->request->method == 'GET'){
            $id = $this->request->get('id');
            $year = $this->request->get('year');
            if ($id != null && $year != null) {
                $a = $this->pixie->orm->get('award')->where('faculties_id',$id)->where('year', $year)->find();
                echo $a->loaded();
            }
        }
    }

    /**
     * удаляет указанный рассчет
     */
    public function action_delete_award() {
        if(!$this->logged_in('admin'))
            return;

        $id = $this->request->param("id");
        if (!$id) {
            return;
        }
        $a = $this->pixie->orm->get('award')->where('id',$id)->find();

        $a->delete();
    }


    protected function logged_in($role = null){
        if($this->pixie->auth->user() == null){
            return false;
        }

        if($role && !$this->pixie->auth->has_role($role)){
            return false;
        }

        return true;
    }


}