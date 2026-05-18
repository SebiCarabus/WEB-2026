<?php
declare(strict_types=1);
class Controller{
    protected $model;
    protected $view;
    protected $params;
    public function __construct(array $params=[]){
        $this->params=$params;
        $modelName=str_replace('Controller','',$this::class).'Model';
        $viewName=str_replace('Controller','',$this::class);
        if(class_exists($modelName)){
            $this->model=new $modelName();
            $this->view=dirname(__DIR__).SEP."views".SEP.$viewName.".php";
        }
    }

    public function renderView(array $data=[]){
        if($data){
            extract($data);
        }
        if(file_exists($this->view)){
            include $this->view;
        }
    }
}