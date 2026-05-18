<?php
declare(strict_types=1);
class IssuesController extends Controller{
    private function verifyAuthorization(){
        if(!isset($_SESSION["user"]) || !isset($_SESSION["user_id"])){
            header("Location: /LTWMVC/login");
            exit;
        } else {
            if($this->model->isUserInvolvedInProject($_SESSION["user_id"]) === false){
                 header("Location: /LTWMVC/projects");
            }
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
    public function getIssues(){
        $selectedProjectId=$_SESSION['projectId']??1;
        $projectName=$_SESSION['projectName']??"Catalog Online";
        $this->verifyAuthorization();
        $project_info=$this->model->getProjectInfo($selectedProjectId,$_SESSION["user_id"]);
        $issues=$this->model->getIssues($selectedProjectId,$_SESSION['user_id']);
        $contributors=$this->model->getContributors($selectedProjectId);
        $data=[
            'user'=>$_SESSION['user']??"",
            'projectName'=>$projectName,
            'issues'=>$issues,
            'project_info'=>$project_info,
            'contributors' => $contributors
        ];

        $this->renderView($data);
    }

    public function addIssues(){
        $this->verifyAuthorization();
        $selectedProjectId=$_SESSION['projectId']??1;
        $userId=$_SESSION['user_id']??1;
        $this->model->addIssue($selectedProjectId,$userId);
        header("Location: /LTWMVC/issues/");
        exit();
    }
}