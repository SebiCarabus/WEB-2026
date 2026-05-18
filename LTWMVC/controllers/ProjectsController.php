<?php
declare(strict_types=1);

class ProjectsController extends Controller{
    private function verifyAuthorization(){
        if(!isset($_SESSION["user"]) || !isset($_SESSION["user_id"])){
            header("Location: /LTWMVC/login");
            exit;
        }
    }
    public function logOut(){
        //$this->verifyAuthorization();
        if(isset($this->params["LOG_OUT"])){
            $_SESSION=array();
            session_destroy();
            header("Location: /LTWMVC/login");
            exit();
        }
    }
    public function getUserProjects(){
        $this->verifyAuthorization();
        
        $userId=(int)$_SESSION["user_id"];
        $projects=$this->model->getProjectsByUserId($userId);

        $this->renderView([
            'userName' => $_SESSION["user"],
            'projects' => $projects
        ]);
    }
}