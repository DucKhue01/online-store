<?php
    class ControllerBase{

        public $layout = null;
        protected $dataView = null;
        protected $file_view_path = null;

        public function RenderView($view_name, $data, $layout = null){   
            $this ->dataView = $data;          
            $this -> file_view_path = app_path . '/View/' . str_replace('.', '/', $view_name) . '.phtml';
            if (!empty($layout)) {
                $this -> layout = app_path . '/View/' . str_replace('.', '/', $layout) . '.phtml';
                if (file_exists($this -> layout)) {
                    require_once $this ->layout;
                }else{
                    die("khong ton tai file layout: " . basename($this -> layout)) ;
                }
            }else{
                 $this->showContent();
            }

        }

        public function showContent(){
          if (!empty($this -> file_view_path) && file_exists($this -> file_view_path)) {
                require_once $this -> file_view_path;
          }else{
                die("khong ton tai file VIEW " . str_replace(app_path,'',$this ->file_view_path));
          }
        //   require_once $this -> file_view_path; 

        }
       
        
    }