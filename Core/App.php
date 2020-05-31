<?php

class App{
    public function run(){
       $ct  = isset($_GET['ct']) ? $_GET['ct'] : 'index';
       $act = isset($_GET['act']) ? $_GET['act'] : 'index';
    //    echo  $act;

       $classCT = str_replace( '-', ' ', $ct );
       $classCT = ucwords($classCT);
       $classCT = str_replace(' ', '', $classCT);
       $classCT = $classCT . "Controller";

    //    echo $classCT;

       $file_controller = app_path.'/Controller/'. $classCT . '.php';

    //    echo "<br> $file_controller";
       
       if (file_exists($file_controller)) {
           require_once $file_controller;
       }else{
           die("NOT EXISTS <b>'/Controller'. $classCT . '.php'</b>"  );
       }

       //tao doi tuong

       $objController = new $classCT;
       $actName = str_replace( '-', ' ', $act );
       $actName = ucwords($actName);
       $actName = str_replace(' ', '', $actName);
      

    //    echo "<br> ten ham $actName ";


       if (method_exists($objController, $actName)) {
           $objController ->$actName();
       }else{
        die("NOT EXISTS METHOD <b>$classCT::$actName</b>"  );
       }



    }
   
}