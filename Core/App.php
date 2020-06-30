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


       $actName = str_replace( '-', ' ', $act );
       $actName = ucwords($actName);
       $actName = str_replace(' ', '', $actName);
      
       // CHAN quyen

      $this ->checkACL($classCT,$actName);
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

    //    echo "<br> ten ham $actName ";

       if (method_exists($objController, $actName)) {
           $objController ->$actName();
       }else{
        die("NOT EXISTS METHOD <b>$classCT::$actName</b>"  );
       }
   }

   public function checkACL($controllerClassName, $actionName){
      
      $ct = str_replace('Controller', '', $controllerClassName);

      $strCheck = $ct . '.' . $actionName;
      $arr_public_action = ['Index.Index', 'Index.Login','Products.ListAll','Products.AddCart','Products.ViewCart','Products.RedProd', 'Products.IncProd','Products.Remove','Products.Filter'];

      if (in_array($strCheck, $arr_public_action)) {
         return true;
      }
      // kiem tra dang nhap

      if (empty($_SESSION['auth'])) {
         header('Location:' . base_path . '?act=login');
         die("ban chua dang nhap");
      }

      $userinfo = $_SESSION['auth'];
            // echo '<pre>';
            //     print_r($_SESSION['auth']);
            // echo '</pre>';

      if (in_array($strCheck, $userinfo['list_pms'])) {
         return true;
      }

      die (' ban chua duoc phan quyen chuc nang nay ' . $strCheck);






   }
 



   
}