<?php
declare(strict_types=1);
class UsersController extends Controller{
    public function displayLoginUser(){
        $this->renderView();
    }

    public function verifyUser(){
        if(isset($this->params['user']) && isset($this->params['parola'])){
            $isValid = $this->model->verifyPassword($this->params['user'],$this->params['parola']);

            if($isValid){
                $_SESSION['user'] = $this->params['user'];
                $_SESSION['user_id'] = $this->model->getUserId($this->params['user']);
                header("Location: /LTWMVC/projects");
                exit();
            } else {
                $_SESSION['BAD_LOGIN'] = true;
                header("Location: /LTWMVC/login");
                exit();
            }
        }
    }
}