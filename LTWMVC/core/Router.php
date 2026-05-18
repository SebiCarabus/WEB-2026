<?php
declare(strict_types=1);
class Router{
    public function dispatch($requestURL, $requestMethod){
       $url = parse_url($requestURL, PHP_URL_PATH);
        $url = str_replace('/LTWMVC/', '', $url);
        $url = trim($url, '/');

        $route = $url ?: 'login';
        switch($route){
            case "issues":
                if(!isset($_SESSION["user"])||!isset($_SESSION["user_id"])){
                    echo("403: Not authorized");
                } else {
                    $controller = new IssuesController($_REQUEST);
                    if($requestMethod === 'get'){
                        if (isset($_GET['projectId'])) {
                            $_SESSION['projectId'] = (int)$_GET['projectId'];
                            $controller->getIssues();
                        }
                    } else {
                        if(isset($_REQUEST["LOG_OUT"])){
                            $controller->logOut();
                        } else {
                            $controller->addIssues();
                        }
                    }
                }
                break;
            case "projects":
                if(!isset($_SESSION["user"])||!isset($_SESSION["user_id"])){
                    echo("403: Not authorized");
                } else {
                    $controller = new ProjectsController($_REQUEST);
                    if($requestMethod === 'get'){
                        $controller->getUserProjects();
                    } else {
                        $controller->logOut();
                    }
                    
                }
                break;
            case "login":            
                $controller=new UsersController($_POST);
                if($requestMethod === "get"){
                    $controller->displayLoginUser();
                } else {
                    $controller->verifyUser();
                }
                break;
            default: echo("404: Page not found");
            exit();
        }
    }
}