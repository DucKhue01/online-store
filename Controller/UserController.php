<?php

    require_once app_path. '/Model/UserModel.php';

    class UserController extends ControllerBase{
        public function ListAll(){
          

           $objUserModel  = new UserModel();

           $list_user = $objUserModel -> getAll();

            // echo '<pre>';
            //     print_r($list_user);
            // echo '</pre>';    
            $this ->RenderView('user.list-all',$list_user,'layout-back');

        }
    }